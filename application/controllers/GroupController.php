<?php

class GroupController extends Zend_Controller_Action {

	public function init() {
		/* Initialize action controller here */
	}

	public function indexAction() {
		// check the blackout information
		$scheBlkMapper = new Application_Model_ScheBlkMapper();
		$blackoutAdmin = $scheBlkMapper -> findStatus($status = 3);
		$blackoutDays = $scheBlkMapper -> findStatus($status = 2);
		$blackoutSchedules = $scheBlkMapper -> findStatus($status = 1);
		
		$days = '"0000-00-00"';
		if ($blackoutAdmin != null) {
			foreach ($blackoutAdmin as $row) {
				$days .= ', ' . '"' . $row -> getDate() . '"';
			}
		}
		if ($blackoutDays != null) {
			foreach ($blackoutDays as $row) {
				$days .= ', ' . '"' . $row -> getDate() . '"';
			}
		}
		$halfDays = '"0000-00-00"';
		$blackoutSches = '0';
		if ($blackoutSchedules != null) {
			foreach ($blackoutSchedules as $row) {
				$halfDays .= ', ' . '"' . $row -> getDate() . '"';
				$blackoutSches .= ', ' . $row -> getSchedule_id();
			}
		}
		
		// echo $days . "@@" . $halfDays . "@@" . $blackoutSches;   // used for debug
		$this -> view -> days = $days;
		$this -> view -> halfDays = $halfDays;
		$this -> view -> blkSches = $blackoutSches;

		// display the form
		$form = new Application_Form_Group();
		
		// support the editInfo function of confirm page
		if ($this -> getRequest() -> isPost()) {
			$form ->isValid($this -> getRequest() -> getPost());
			$this -> view -> date = $this -> getRequest() -> getParam('date');
			$sche_id = $this -> getRequest() -> getParam('schedule_id');
			if ($sche_id <= 3) {
				$this -> view -> schedule = 1;
			} else if ($sche_id <= 6) {
				$this -> view -> schedule = 2;
			} else {
				$this -> view -> schedule = 3;
				$this -> view -> tour_by = $this -> getRequest() -> getParam('tourBy');
			}
			$this -> view -> sche_id = $sche_id;
			$this -> view -> type = $this ->getRequest() -> getParam('type');
			$this -> view -> otherGType = $this -> getRequest() -> getParam('otherGType');
			$this -> view -> lunch_payment = $this -> getRequest() -> getParam('lunch_payment');
			$this -> view -> bus_parking = $this -> getRequest() -> getParam('bus_parking');
		}

		$this -> view -> form = $form;
	}

	// generate the confirmation page
	public function confirmAction() {
		
		// generate the form
		$request = $this -> getRequest();
		$form = new Application_Form_Group();

		if ($this -> getRequest() -> isPost()) {
			// print_r($_POST); echo "<br>";
			if ($form -> isValid($request -> getPost())) {
				$data = $form -> getValues();
				// print_r($data); echo "<br>";
			} else {
				// $this -> redirect('/group');
			}
			
			$options = array();
			
			// get the schedule_id
			if ($data['schedule'] <= 2) {
				$type = "additionTour";
			} else {
				$type = "tourTime";
				$this -> view -> tourBy = $data['tourBy'];
			}
			unset($data['schedule']);
			$options['schedule_id'] = $data[$type];
			unset($data[$type]);
			
			// get the rest attributes
			foreach ($data as $key => $value) {
				if ($value == "") continue;
				$options[$key] = $value;
			}
			// print_r($options); echo "<br>";
			$this -> view -> group = $options;

		}
	}

	public function thankyouAction() {

		if ($this -> getRequest() -> isPost()) {
			//print_r($_POST);
			if ($_POST['type'] == "Other") {
				$_POST['type'] = $_POST['otherGType'];
				unset($_POST['otherGType']);
			}

			$group = new Application_Model_GroupRes($_POST);
			$groupMapper = new Application_Model_GroupResMapper();
			$groupMapper -> save($group);
			
			$schedule = array(
				'date' => $_POST['date'],
				'schedule_id' => $_POST['schedule_id']
			);
			$scheBlk = new Application_Model_ScheBlk($schedule);
			$scheBlkMapper = new Application_Model_ScheBlkMapper();
			$scheBlkMapper -> save($scheBlk);
			
			try {
				//send confirmation email
				$mail = new Zend_Mail();

				$bodyText = '
					<?php date_default_timezone_set(\'America/Chicago\'); ?>
					<html>
					<body>
						<p align=center><h2>Howdy! A new group visit registration</h2><p>
						<br>
						<table>
							<tr>
								<th width=10% align=left><h3>Field</h3></th><th width=20% align=left><h3>Content<h3></th>
							</tr>
							<tr>
								<td>Visit Date</td>
								<td>' . $_POST['date'] . '</td>
							</tr>
							<tr>
								<td>Group Name</td>
								<td>' . $_POST['name'] . '</td>
							</tr>
							<tr>
								<td>Group Type</td>
								<td>' . $_POST['type'] . '</td>
							</tr>
							<tr>
								<td>First Name</td>
								<td>' . $_POST['first_name'] . '</td>
							</tr>
							<tr>
								<td>Last Name</td>
								<td>' . $_POST['last_name'] . '</td>
							</tr>
							<tr>
								<td>Email</td>
								<td>' . $_POST['email'] . '</td>
							</tr>
							<tr>
								<td>Phone</td>
								<td>' . $_POST['phone'] . '</td>
							</tr>
							<tr>
								<td>Street</td>
								<td>' . $_POST['address'] . '</td>
							</tr>
							<tr>
								<td>City, State</td>
								<td>' . $_POST['city'] . ", " . $_POST['state'] . '</td>
							</tr>
							<tr>
								<td>Zip Code</td>
								<td>' . $_POST['zipcode'] . '</td>
							</tr>
							<tr>
								<td>Number of Students</td>
								<td>' . $_POST['visitors_num'] . '</td>
							</tr>
							<tr>
								<td>Number of Adults</td>
								<td>' . $_POST['audits_num'] . '</td>
							</tr>
							<tr>
								<td>Size of Party</td>
								<td>' . $_POST['total_num'] . '</td>
							</tr>
							<tr>
								<td>Bus Parking</td>
								<td>' . ($_POST['bus_parking'])? 'Yes':'No' . '</td>
							</tr>
							<tr>';
							if ($_POST['bus_parking']) {
								$bodyText .= '<td>Bus Name</td>
											  <td>' . $_POST['bus_name'] . '</td>';
							} else {
								$bodyText .= '<td>Tour By </td>
											  <td>' . $_POST['tourBy'] . '</td>';
							}
						$bodyText .= '
							</tr>
							<tr>
								<td>Visit Type</td>
								<td>' . $_POST['visitType'] . '</td>
							</tr>
							<tr>';
							if ($_POST['visitType'] == 'Tour Only') {
								$bodyText .= '<td>Tour Time</td>
											  <td>' . $_POST['tourTime'] . '</td>';
							} else {
								$bodyText .= '<td>Lunch Payment</td>
											  <td>' . $_POST['lunch_payment'] . '</td>
										  </tr>
										  <tr>
											  <td>Tour Addition</td>
											  <td>' . $_POST['addtionTour'] . '</td>';
							}
						$bodyText .= '
							</tr> 
						</table>
					</body>
					</html>
					';

				$mail -> setFrom('no-reply@tamu.edu', 'Texas A&M Visitor Center')
					  -> addTo('zhengbernard@gmail.com') // for test purpose
					  // -> addTo('groupvisits@tamu.edu')
					  -> setSubject('Group Visit to Texas A&M University')
					  -> setBodyHtml($bodyText)
					  -> send();

			} catch (Exception $e) {
				error_log($e -> getMessage());
			}
		}
	}

}
