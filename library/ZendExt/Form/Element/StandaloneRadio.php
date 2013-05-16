<?php
/**
 * Created for implementing radio element in seperate lists.
 */

class ZendExt_Form_Element_StandaloneRadio extends Zend_Form_Element_Radio
{
	//Parent element on which this radiobutton depends
	protected $_parent = null;
    
	//All validation is done at parent ($_parent), so we disable it for individual radiobuttons
	protected $_registerInArrayValidator = false;

	//This element depends on parent ($_parent), so we don't need its value directly
	protected $_ignore = true;

	public function setOptions(array $options)
	{
		//Accept additional parent parameter, which is an array:
		//0 - link to the parent radiobutton element (must instance of Zend_Form_Element_Radio)
		//1 - array of option ids which current element needs to take from its parent
		if (isset($options['parent'][0]) && $options['parent'][0] instanceof Zend_Form_Element_Radio) {
			$parent = $options['parent'][0];
			$binding_multioptions = isset($options['parent'][1])?$options['parent'][1]:null;

			if (!empty($binding_multioptions)) {
				if (!is_array($binding_multioptions)) {
					$binding_multioptions = array($binding_multioptions);
				}

				//Attach selected parent multioptions to the current element
				$parent_multioptions = $parent->getMultiOptions();
				$multioptions = array();
				foreach ($binding_multioptions as $current_option_id) {
					if (isset($parent_multioptions[$current_option_id])) {
						$multioptions[$current_option_id] = $parent_multioptions[$current_option_id];
					}
				}
				$this->addMultiOptions($multioptions);
			}

			$this->_parent = $parent;

			//We've stored all neccessary info, no need in this parameter anymore
			unset($options['parent']);
		}

		//Call original setOptions from Zend_Form_Element_Radio
		parent::setOptions($options);

		return $this;
	}

	public function render(Zend_View_Interface $view = null)
	{
		//Here we replace element name with parent name, but just for rendering
		$current_name = $this->getName();
		$this->setName($this->_parent->getName());

		$output = parent::render($view);

		//Put the real name back
		$this->setName($current_name);

		return $output;
	}

	public function getValue()
	{
		//Element is dependent on parent
		return $this->_parent->getValue();
	}

	public function setValue($value)
	{
		//Element is dependent on parent
		return $this->_parent->setValue($value);
	}

	public function isValid($value, $context = null)
	{
		//Assign same value to all members of the group
		$value = $this->_parent->getValue();
		$context[$this->_name] = $value;

		return parent::isValid($value, $context);
	}
}

?>