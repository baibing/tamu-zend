<?php

class Application_Model_ScheBlk
{
	protected $_id;
	protected $_date;
	protected $_schedule_id;
	protected $_status;

	public function __construct(array $options = null) {
		if (is_array($options)) {
			$this -> setOptions($options);
		}
	}

	public function __set($name, $value) {
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid group registration property');
		}
		$this -> $method($value);
	}

	public function __get($name) {
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid group registration property');
		}
		return $this -> $method();
	}

	public function setOptions(array $options) {
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (in_array($method, $methods)) {
				$this -> $method($value);
			}
		}
		return $this;
	}

	public function setId($id) {
		$this -> _id = (int)$id;
		return $this;
	}

	public function getId() {
		return $this -> _id;
	}

	public function setDate($date) {
		$this -> _date = (string)$date;
		return $this;
	}

	public function getDate() {
		return $this -> _date;
	}

	public function setSchedule_id($schedule_id) {
		$this -> _schedule_id = (int)$schedule_id;
		return $this;
	}

	public function getSchedule_id() {
		return $this -> _schedule_id;
	}

	public function setStatus($status) {
		$this -> _status = (int)$status;
		return $this;
	}

	public function getStatus() {
		return $this -> _status;
	}

}

