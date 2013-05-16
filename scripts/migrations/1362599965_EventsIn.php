<?php
class Migration_1362599965_EventsIn extends Mooduino_Db_Migrations_Migration_Abstract {

	public function __construct() {
		parent::__construct('EventsIn', 1362599965);
	}

	public function up() {
		$sql = "CREATE TABLE EventsIn (
					id 			INT 	NOT NULL AUTO_INCREMENT,
					schedule_id	INT		NOT NULL,
					event_id 	INT 	NOT NULL,
					start_time	TIME 	NOT NULL,
					end_time	TIME 	NOT NULL,
					PRIMARY KEY (id),
					FOREIGN KEY (schedule_id)
						REFERENCES Schedules(id)
						ON DELETE CASCADE
						ON UPDATE CASCADE,
					FOREIGN KEY (event_id)
						REFERENCES Events(id)
						ON DELETE CASCADE
						ON UPDATE CASCADE									
				);
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (1, 1, '11:15', '12:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (1, 2, '13:00', '14:00');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (1, 3, '14:15', '15:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (1, 4, '15:30', '16:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (2, 1, '11:15', '12:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (2, 2, '13:00', '14:00');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (2, 3, '14:15', '15:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (2, 5, '15:30', '16:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (3, 1, '11:15', '12:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (3, 2, '13:00', '14:00');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (3, 3, '14:15', '15:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (3, 6, '15:30', '16:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (4, 1, '11:15', '12:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (4, 2, '13:00', '14:00');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (4, 3, '14:15', '15:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (4, 4, '15:30', '16:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (5, 1, '11:15', '12:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (5, 2, '13:00', '14:00');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (5, 3, '14:15', '15:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (5, 5, '15:30', '16:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (6, 1, '11:15', '12:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (6, 2, '13:00', '14:00');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (6, 3, '14:15', '15:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (6, 6, '15:30', '16:15');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (7, 1, '8:30', '9:30');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (8, 1, '9:30', '10:30');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (9, 1, '10:00', '11:00');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (10, 1, '11:30', '12:30');
				INSERT INTO EventsIn (schedule_id, event_id, start_time, end_time)
				VALUES (11, 1, '14:30', '15:30');";

		return $sql;
	}

	public function down() {
		return 'DROP TABLE EventsIn;';
	}
}

