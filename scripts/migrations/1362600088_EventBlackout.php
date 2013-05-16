<?php
class Migration_1362600088_EventBlackout extends Mooduino_Db_Migrations_Migration_Abstract {

	public function __construct() {
		parent::__construct('EventBlackout', 1362600088);
	}

	public function up() {
		$sql = "CREATE TABLE EventBlackout (
					id 			INT 	NOT NULL AUTO_INCREMENT,
					date		DATE	NOT NULL,
					schedule_id	INT		NOT NULL,
					event_id 	INT 	NOT NULL,
					PRIMARY KEY (id),
					FOREIGN KEY (schedule_id)
						REFERENCES Schedules(id)
						ON DELETE CASCADE
						ON UPDATE CASCADE,
					FOREIGN KEY (event_id)
						REFERENCES Events(id)
						ON DELETE CASCADE
						ON UPDATE CASCADE
				);";

		return $sql;
	}

	public function down() {
		return 'DROP TABLE EventBlackout;';
	}
}

