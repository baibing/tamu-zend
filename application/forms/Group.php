<?php

class Application_Form_Group extends Zend_Form
{

	/**
	 * This will reference a ViewScript named groupForm.phtml located in /views/scripts/group
	 * Learn more at http://stackoverflow.com/questions/1277849/zend-framework-forms-decorators-and-validation-should-i-go-back-to-plain-html?rq=1
	 */
	public function loadDefaultDecorators() {
		$this->setDecorators(
			array(
				array(
					'ViewScript',
					array(
						'viewScript' => 'group/groupForm.phtml',
					)
				)
			)
		);
	}

    public function init()
    {
    	$this->setAction("/group/confirm");
		
		$this->setMethod("post");

		/*======================================*/
		/*============ Date Picker =============*/
		/*======================================*/		
		
		// Add the date picker element
		$date = new ZendX_JQuery_Form_Element_DatePicker('date');
		$date->addValidator(new Zend_Validate_Date(
			array(
			'format' => 'yy-mm-dd',
			)))
			->setRequired(TRUE)
			->setDecorators(array('Errors'));
		$this->addElement($date);
		
		/*======================================*/
		/*============= Schedule ===============*/
		/*======================================*/		
		
        // Add a schedule selection element
        $schedule = new Zend_Form_Element_Radio('schedule', array(
			'required' => TRUE
		));
		$schedule->addMultiOptions(array(
			"1" => "Schedule 1",
			"2" => "Schedule 2",
			"3" => "Tour Only"
		));
		$schedule->setDecorators(array('Errors'));
		$this->addElement($schedule);
		
		// Add the prefix path to use self-defined radio class
		$this->addPrefixPath('ZendExt_Form_Element', 'ZendExt/Form/Element/', 'Element');

		// Seperate the schedule element option 1
		$this->addElement('standaloneRadio', 'sche1', array(
			'parent' => array($schedule, 1)
		));
		$sche1 = $this->getElement('sche1');
		$sche1->setDecorators(array('ViewHelper', 'Errors'));
				
		// Seperate the schedule element option 2
		$this->addElement('standaloneRadio', 'sche2', array(
			'parent' => array($schedule, 2)
		));
		$sche2 = $this->getElement('sche2');
		$sche2->setDecorators(array('ViewHelper', 'Errors'));

		// Seperate the schedule element option 3
		$this->addElement('standaloneRadio', 'tour', array(
			'parent' => array($schedule, 3)
		));
		$tour = $this->getElement('tour');
		$tour->setDecorators(array('ViewHelper', 'Errors'));
		
		// Add the sub-radio element under description
		$additionTour = new Zend_Form_Element_Radio('additionTour', array('require' => TRUE));
		$additionTour->addMultiOptions(array(
			"1" => "Residence Life",
			"2" => "Corps of Cadets",
			"3" => "Bonfire Memorial",
			"4" => "Residence Life",
			"5" => "Corps of Cadets",
			"6" => "Bonfire Memorial"
		));
		$additionTour->setDecorators(array('Errors'));
		$this->addElement($additionTour);
		
		// Seperate the additional tour options to Schedule 1
		$addition1 = new ZendExt_Form_Element_StandaloneRadio('addition1', array(
			'parent' => array($additionTour, array(1, 2, 3))
		));
		// $addition1->setSeparator("\t")
				  // ->setDecorators(array('ViewHelper', 'Errors'));
		$this->addElement($addition1);
		
		// Seperate the additional tour options to Schedule 2
		$addition2 = new ZendExt_Form_Element_StandaloneRadio('addition2', array(
			'parent' => array($additionTour, array(4, 5, 6))
		));
		// $addition2->setSeparator("\t")
				  // ->setDecorators(array('ViewHelper', 'Errors'));
		$this->addElement($addition2);
		
		// Add the sub-radio element under description
		$tourTime = new Zend_Form_Element_Radio('tourTime', array(
			'require' => TRUE
		));
		$tourTime->addMultiOptions(array(
			"7" => "8:30 a.m.",
			"8" => "9:30 a.m.",
			"9" => "10:00 a.m.",
			"10" => "11:30 a.m.",
			"11" => "2:30 p.m."
		));
		$this->addElement($tourTime);
		
		// Add the sub-radio element under description
		$tourBy = new Zend_Form_Element_Radio('tourBy', array(
			'require' => TRUE,
		    'decorators' => array('ViewHelper', 'Errors')
        ));
		$tourBy->addMultiOptions(array(
			"walk" => "Walking",
			"bus" => "Driving (Visitors must provide their own bus)"
		));
		$tourBy->setSeparator("\t");
		$this->addElement($tourBy);
		
		/*======================================*/
		/*============ Group Info ==============*/
		/*======================================*/		
		
        // Add an name element
        $this->addElement('text', 'name', array(
            'required'   => TRUE,
            'decorators' => array('ViewHelper', 'Errors')
        ));

        // Add an type element
        $type = new Zend_Form_Element_Select('type', array(
			'required' => TRUE,
			'onchange' => 'CheckGroup(this.value);',
            'decorators' => array('ViewHelper', 'Errors')
		));
		$type->addMultiOptions(array(
			"Select Group Type" => "Select Group Type",
			"9th - 12th Grade" => "9th - 12th Grade",
			"8th Grade" => "8th Grade",
			"7th Grade" => "7th Grade",
			"6th Grade and Below" => "6th Grade and Below",
			"After School Club" => "After School Club",
			"Aggie Affiliated Club or Organization" => "Aggie Affiliated Club or Organization",
			"Business Representatives" => "Business Representatives",
			"Church Youth Group" => "Church Youth Group",
			"Church Adult Group" => "Church Adult Group",
			"College Transfer Students" => "College Transfer Students",
			"Conference/Workshop Attendees" => "Conference/Workshop Attendees",
			"Elected Officials" => "Elected Officials",
			"Former Students" => "Former Students",
			"Governmental Official" => "Governmental Official",
			"Non-profit Organization" => "Non-profit Organization",
			"Prospective Graduate Students" => "Prospective Graduate Students",
			"Senior Citizens Group" => "Senior Citizens Group",
			"Tourist Group" => "Tourist Group",
			"University Department Guests" => "University Department Guests",
			"University Faculty/Staff" => "University Faculty/Staff",
			"Other" => "Other"
		));
		$this->addElement($type);
		
		// Add an other type element
        $this->addElement('text', 'otherGType', array(
            'decorators' => array('ViewHelper', 'Errors')
        ));
 
        // Add an studentSize element
        $studentSize = new Zend_Form_Element_Text('visitors_num', array(
            'required'   => TRUE,
            'decorators' => array('ViewHelper', 'Errors')
        ));
		$validator = new Zend_Validate_Between(
			array(
				'min' => 15,
				'max' => 75,
				'inclusive' => TRUE
			)
		);
		$studentSize->addValidator($validator);
        $this->addElement($studentSize);
 
        // Add an adultSize element
        $this->addElement('text', 'audits_num', array(
            'required'   => TRUE,
            'decorators' => array('ViewHelper', 'Errors')
        ));

        // Add an totalSize element
        $this->addElement('text', 'total_num', array(
            'required'   => TRUE,
            'decorators' => array('ViewHelper', 'Errors')
        ));

        // Add an payment element
        $payment = new Zend_Form_Element_Radio('lunch_payment', array(
			'required' => TRUE,
		    'decorators' => array('ViewHelper', 'Errors')
        ));
		$payment->addMultiOptions(array(
			"Individual" => "Individual",
			"School Payment" => "School Payment"
		));
		$this->addElement($payment);
 
        // Add an parking element
        $parking = new Zend_Form_Element_Radio('bus_parking', array(
			'required' => TRUE,
		    'decorators' => array('ViewHelper', 'Errors')
        ));
		$parking->addMultiOptions(array(
			TRUE => "Yes",
			FALSE => "No"
		));
		$this->addElement($parking);
        
        // Add an busName element
        $this->addElement('text', 'bus_name', array(
            'required'   => TRUE,
            'decorators' => array('ViewHelper', 'Errors')
        ));
		
		/*======================================*/
		/*=========== Group Leader =============*/
		/*======================================*/		

        // Add an firstName element
        $this->addElement('text', 'first_name', array(
            'required'   => TRUE,
            'decorators' => array('ViewHelper', 'Errors')
        ));
 
        // Add an lastName element
        $this->addElement('text', 'last_name', array(
            'required'   => TRUE,
            'decorators' => array('ViewHelper', 'Errors')
        ));

        // Add an email element
        $this->addElement('text', 'email', array(
            'required'   => TRUE,
            'decorators' => array('ViewHelper', 'Errors'),
            'validators' => array(
                'EmailAddress',
            )
        ));
 
        // Add an cellphone element
        $this->addElement('text', 'phone', array(
            'required'   => TRUE,
            'decorators' => array('ViewHelper', 'Errors')
        ));

        // Add an street element
        $this->addElement('text', 'address', array(
            'required'   => TRUE,
            'decorators' => array('ViewHelper', 'Errors')
        ));

        // Add an city element
        $this->addElement('text', 'city', array(
            'required'   => TRUE,
            'decorators' => array('ViewHelper', 'Errors')
        ));

        // Add an state element
        $state = new Zend_Form_Element_Select('state', array(
			'required' => TRUE,
		    'decorators' => array('ViewHelper', 'Errors')
        ));
		$state->addMultiOptions(array(
			"AK" => "AK",
			"AL" => "AL",
			"AR" => "AR",
			"AZ" => "AZ",
			"CA" => "CA",
			"CO" => "CO",
			"CT" => "CT",
			"DC" => "DC",
			"DE" => "DE",
			"FL" => "FL",
			"GA" => "GA",
			"HI" => "HI",
			"IA" => "IA",
			"ID" => "ID",
			"IL" => "IL",
			"IN" => "IN",
			"KS" => "KS",
			"KY" => "KY",
			"LA" => "LA",
			"MA" => "MA",
			"MD" => "MD",
			"ME" => "ME",
			"MI" => "MI",
			"MN" => "MN",
			"MO" => "MO",
			"MS" => "MS",
			"MT" => "MT",
			"NC" => "NC",
			"ND" => "ND",
			"NE" => "NE",
			"NH" => "NH",
			"NJ" => "NJ",
			"NM" => "NM",
			"NV" => "NV",
			"NY" => "NY",
			"OH" => "OH",
			"OK" => "OK",
			"OR" => "OR",
			"PA" => "PA",
			"RI" => "RI",
			"SC" => "SC",
			"SD" => "SD",
			"TN" => "TN",
			"TX" => "TX",
			"UT" => "UT",
			"VA" => "VA",
			"VT" => "VT",
			"WA" => "WA",
			"WI" => "WI",
			"WV" => "WV",
			"WY" => "WY"
		));
		$this->addElement($state);
        $this->populate(array('state' => "TX"));
        
        // Add an zipcode element
        $this->addElement('text', 'zipcode', array(
            'required'   => TRUE,
            'decorators' => array('ViewHelper', 'Errors')
        ));
    }

}

