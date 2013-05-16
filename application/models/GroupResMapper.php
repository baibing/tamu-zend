<?php

// application/models/GroupResMapper.php

class Application_Model_GroupResMapper
{
    protected $_dbTable;
 
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    { 
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_GroupRes');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_GroupRes $group)
    {
        $data = array(
        	'schedule_id' => $group->getSchedule_id(),
        	'date' => $group->getDate(),
            'name'   => $group->getName(),
            'type' => $group->getType(),
            'visitors_num' => $group->getVisitors_num(),
            'audits_num' => $group->getAudits_num(),
            'total_num' => $group->getTotal_num(),
            'lunch_payment' => $group->getLunch_payment(),
            'bus_parking' => $group->getBus_parking(),
            'bus_name' => $group->getBus_name(),
            'first_name'   => $group->getFirst_name(),
            'last_name' => $group->getLast_name(),
            'email' => $group->getEmail(),
            'phone' => $group->getPhone(),
            'address' => $group->getAddress(),
            'city' => $group->getCity(),
            'state' => $group->getState(),
            'zipcode' => $group->getZipcode()
        );

        if (null === ($id = $group->getId())) {
            //unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_GroupRes $group)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $group->setId($row->id)
              ->setFirstName($row->firstName)
              ->setLastName($row->lastName)
              ->setEmail($row->email)
			  ->setPhone($row->phone)
			  ->setStreet($row->street)
			  ->setCity($row->city)
			  ->setState($row->state)
			  ->setZipcode($row->zipcode);
		return $group;
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_GroupRes();
            $entry->setId($row->id)
	              ->setFirstName($row->firstName)
	              ->setLastName($row->lastName)
	              ->setEmail($row->email)
				  ->setPhone($row->phone)
				  ->setStreet($row->street)
				  ->setCity($row->city)
				  ->setState($row->state)
				  ->setZipcode($row->zipcode);
            $entries[] = $entry;
        }
        return $entries;
    }
}

