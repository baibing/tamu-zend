<?php

class Application_Model_ScheBlkMapper
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
            $this->setDbTable('Application_Model_DbTable_ScheBlk');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_ScheBlk $schedule)
    {
        $data = array(
        	'date' => $schedule->getDate(),
        	'schedule_id' => $schedule->getSchedule_id()
        );
		
        $result = $this->getDbTable()->find($schedule->getDate());
        if (0 == count($result)) {
        	$this->getDbTable()->insert($data);
        } else {
        	$scheBlk = $result->current();
			
			$data['id'] = $scheBlk->id;
			if ($data['schedule_id'] != $scheBlk->schedule_id) {
				$data['schedule_id'] += $scheBlk->schedule_id;
			} else {
				throw new Exception("Duplicate Schedule", 1);
			}
			$data['status'] = $scheBlk->status + 1;
			
			if($data['status'] > 2) {
				throw new Exception("The Schedule Day Is Full", 1);
			}
						
			$this->getDbTable()->update($data, array('id = ?' => $data['id']));
		}
    }

    public function findStatus($status)
    {
        $resultSet = $this->getDbTable()->fetchAll(
        	$this->getDbTable()->select()
        		->where('status = ?', $status)
				->where('date >= ?', date('y-m-d'))
			);
        if (0 == count($resultSet)) {
            return;
        }
		$entries = array();
		foreach ($resultSet as $row) {
			$scheBlk = new Application_Model_ScheBlk();
	        $scheBlk->setId($row->id)
	              ->setDate($row->date)
	              ->setSchedule_id($row->schedule_id)
				  ->setStatus($row->status);
			$entries[] = $scheBlk;
		}	
		return $entries;
    }

    public function find($date, Application_Model_ScheBlk $scheBlk)
    {
        $result = $this->getDbTable()->find($date);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $scheBlk->setId($row->id)
              ->setDate($row->date)
              ->setSchedule_id($row->schedule_id)
			  ->setStatus($row->status);
		return $scheBlk;
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_ScheBlk();
            $entry->setId($row->id)
	              ->setDate($row->date)
	              ->setSchedule_id($row->schedule_id)
				  ->setStatus($row->status);
            $entries[] = $entry;
        }
        return $entries;
    }

}

