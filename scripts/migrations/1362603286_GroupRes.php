<?php
class Migration_1362603286_GroupRes extends Mooduino_Db_Migrations_Migration_Abstract {

	public function __construct() {
		parent::__construct('GroupRes', 1362603286);
	}

	public function up() {
		$sql = "CREATE TABLE GroupRes (
					id 				INT 		NOT NULL AUTO_INCREMENT,
					schedule_id 	INT 		NOT NULL,
					date 			DATE 		NOT NULL,
					name 			VARCHAR(45) NOT NULL,
					type 			VARCHAR(45) NOT NULL,
					visitors_num 	INT 		NOT NULL,
					audits_num 		INT 		NOT NULL,
					total_num		INT			NOT NULL,
					lunch_payment 	VARCHAR(45) NOT NULL,
					bus_parking 	BOOLEAN 	NOT NULL,
					bus_name 		VARCHAR(45) NOT NULL,
					first_name 		VARCHAR(45) NOT NULL,
					last_name 		VARCHAR(45) NOT NULL,
					email 			VARCHAR(45) NOT NULL,
					phone 			INT 		NOT NULL,
					address 		VARCHAR(45) NOT NULL,
					city 			VARCHAR(45) NOT NULL,
					state 			VARCHAR(45) NOT NULL,
					zipcode 		INT 		NOT NULL,
					INDEX (id),
					PRIMARY KEY (schedule_id, date),
					FOREIGN KEY (schedule_id)
						REFERENCES Schedules(id)
						ON DELETE CASCADE
						ON UPDATE CASCADE
				);";

		return $sql;
	}

	public function down() {
		return 'DROP TABLE GroupRes;';
	}
}

