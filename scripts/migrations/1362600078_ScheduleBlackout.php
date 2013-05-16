<?php
class Migration_1362600078_ScheduleBlackout extends Mooduino_Db_Migrations_Migration_Abstract {

	public function __construct() {
		parent::__construct('ScheduleBlackout', 1362600078);
	}

	public function up() {
		// Not use schedule_id as Foreign Key
		// when two schedules have been made for one day, store the sum of those two schedule_id
		// For example, when group A made a schedule 1 on 20130325, we insert a new tuple with 
		// date = 20130325, schedule_id = 1, status = 1 (One schedule is made, one slot left)
		// Then we will blackout that schedule for that day. Group B made a schedule 2 after this,
		// we need to update the tuple as
		// date = 20130325, schedule_id = 3, status = 2 (Two schedule is made, the day is full now)
		// A few hours later, group A decide to cancel their reservation which is shcedule 1.
		// We will still be able to keep the record of the second schedule_id by updating the tuple as
		// date = 20130325, schedule_id = 2, status = 1
		$sql = "CREATE TABLE ScheduleBlackout (
					id 			INT 	NOT NULL AUTO_INCREMENT,
					date		DATE	NOT NULL,
					schedule_id	INT,
					status 		INT(1) 	DEFAULT 1 CHECK (status <= 3),
					INDEX (id),
					PRIMARY KEY (date)
				);";

		return $sql;
	}

	public function down() {
		return 'DROP TABLE ScheduleBlackout;';
	}
}

