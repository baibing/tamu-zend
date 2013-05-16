<?php
class Application_Model_GroupRes {
	protected $_id;
	protected $_schedule_id;
	protected $_date;
	protected $_name;
	protected $_type;
	protected $_visitors_num;
	protected $_audits_num;
	protected $_total_num;
	protected $_lunch_payment;
	protected $_bus_parking;
	protected $_bus_name;
	protected $_first_name;
	protected $_last_name;
	protected $_email;
	protected $_phone;
	protected $_address;
	protected $_city;
	protected $_state;
	protected $_zipcode;

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
	
	public function setSchedule_id($schedule_id) {
		$this -> _schedule_id = (int)$schedule_id;
		return $this;
	}

	public function getSchedule_id() {
		return $this -> _schedule_id;
	}

	public function setDate($date) {
		$this -> _date = $date;
		return $this;
	}
	
	public function getDate() {
		return $this -> _date;
	}

	public function setName($name) {
		$this -> _name = (string)$name;
		return $this;
	}

	public function getName() {
		return $this -> _name;
	}

	public function setType($type) {
		$this -> _type = (string)$type;
		return $this;
	}

	public function getType() {
		return $this -> _type;
	}

	public function setVisitors_num($visitors_num) {
		$this -> _visitors_num = (int)$visitors_num;
		return $this;
	}

	public function getVisitors_num() {
		return $this -> _visitors_num;
	}

	public function setAudits_num($audits_num) {
		$this -> _audits_num = (int)$audits_num;
		return $this;
	}

	public function getAudits_num() {
		return $this -> _audits_num;
	}

	public function setTotal_num($total_num) {
		$this -> _total_num = (int)$total_num;
		return $this;
	}

	public function getTotal_num() {
		return $this -> _total_num;
	}

	public function setLunch_payment($lunch_payment) {
		$this -> _lunch_payment = (string)$lunch_payment;
		return $this;
	}

	public function getLunch_payment() {
		return $this -> _lunch_payment;
	}

	public function setBus_parking($bus_parking) {
		$this -> _bus_parking = (string)$bus_parking;
		return $this;
	}

	public function getBus_parking() {
		return $this -> _bus_parking;
	}

	public function setBus_name($bus_name) {
		$this -> _bus_name = (string)$bus_name;
		return $this;
	}

	public function getBus_name() {
		return $this -> _bus_name;
	}

	public function setFirst_name($first_name) {
		$this -> _first_name = (string)$first_name;
		return $this;
	}

	public function getFirst_name() {
		return $this -> _first_name;
	}

	public function setLast_name($last_name) {
		$this -> _last_name = (string)$last_name;
		return $this;
	}

	public function getLast_name() {
		return $this -> _last_name;
	}

	public function setEmail($email) {
		$this -> _email = (string)$email;
		return $this;
	}

	public function getEmail() {
		return $this -> _email;
	}

	public function setPhone($phone) {
		$this -> _phone = (int)$phone;
		return $this;
	}

	public function getPhone() {
		return $this -> _phone;
	}

	public function setAddress($address) {
		$this -> _address = (string)$address;
		return $this;
	}

	public function getAddress() {
		return $this -> _address;
	}

	public function setCity($city) {
		$this -> _city = (string)$city;
		return $this;
	}

	public function getCity() {
		return $this -> _city;
	}

	public function setState($state) {
		$this -> _state = (string)$state;
		return $this;
	}

	public function getState() {
		return $this -> _state;
	}

	public function setZipcode($zipcode) {
		$this -> _zipcode = (int)$zipcode;
		return $this;
	}

	public function getZipcode() {
		return $this -> _zipcode;
	}

}
