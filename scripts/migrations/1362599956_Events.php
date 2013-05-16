<?php
class Migration_1362599956_Events extends Mooduino_Db_Migrations_Migration_Abstract {

	public function __construct() {
		parent::__construct('Events', 1362599956);
	}

	public function up() {
		$sql = "CREATE TABLE Events (
					id 					INT 		AUTO_INCREMENT,
					name 				VARCHAR(45),
					coordinator_name 	VARCHAR(45),
					coordinator_email	VARCHAR(45),
					coordinator_phone	INT,
					PRIMARY KEY (id)
				);
				INSERT INTO Events (name)
				VALUES ('Campus Tour');
				INSERT INTO Events (name)
				VALUES ('Lunch');
				INSERT INTO Events (name)
				VALUES ('Prospective Student Section');
				INSERT INTO Events (name)
				VALUES ('Residence Life');
				INSERT INTO Events (name)
				VALUES ('Corps of Cadets');
				INSERT INTO Events (name)
				VALUES ('Bonfire Memorial');";

		return $sql;
	}

	public function down() {
		return 'DROP TABLE Events;';
	}
}

