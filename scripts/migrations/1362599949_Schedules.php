<?php
class Migration_1362599949_Schedules extends Mooduino_Db_Migrations_Migration_Abstract {

	public function __construct() {
		parent::__construct('Schedules', 1362599949);
	}

	public function up() {
		$sql = "CREATE TABLE Schedules (
					id 				INT 		AUTO_INCREMENT,
					name 			VARCHAR(45),
					public			BOOLEAN,
					PRIMARY KEY (id)
				);
				INSERT INTO Schedules (name, public)
				VALUES ('Schedule1-1', true);
				INSERT INTO Schedules (name, public)
				VALUES ('Schedule1-2', true);
				INSERT INTO Schedules (name, public)
				VALUES ('Schedule1-3', true);
				INSERT INTO Schedules (name, public)
				VALUES ('Schedule2-1', true);
				INSERT INTO Schedules (name, public)
				VALUES ('Schedule2-2', true);
				INSERT INTO Schedules (name, public)
				VALUES ('Schedule2-3', true);
				INSERT INTO Schedules (name, public)
				VALUES ('Tour1', true);
				INSERT INTO Schedules (name, public)
				VALUES ('Tour2', true);
				INSERT INTO Schedules (name, public)
				VALUES ('Tour3', true);
				INSERT INTO Schedules (name, public)
				VALUES ('Tour4', true);
				INSERT INTO Schedules (name, public)
				VALUES ('Tour5', true);";

		return $sql;
	}

	public function down() {
		return 'DROP TABLE Schedules;';
	}
}

