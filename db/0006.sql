DROP TABLE IF EXISTS idx;

create table idx
(
	letter		varchar(1) not null,
	class_id 	int not null,
	primary key (letter, class_id)
);

alter table idx add constraint FK_letter_idx foreign key (class_id)
	references classes (class_id) on delete restrict on update restrict;

delimiter //

DROP TRIGGER IF EXISTS class_name_indexer; //

CREATE TRIGGER class_name_indexer AFTER INSERT ON classes
FOR EACH ROW
BEGIN
	DECLARE i int;
	SET i = 0;
	WHILE i < LENGTH(NEW.class_name) DO
		INSERT INTO idx(letter, class_id) VALUES(RIGHT(LEFT(NEW.class_name, i + 1), 1), NEW.class_id);
		SET i = i + 1;
	END WHILE;
END; //

delimiter ;

CREATE OR REPLACE VIEW nameselector AS
SELECT exchange_id, exc_exchange_id, idx.class_id, class_name, user_id, user_name
FROM detailexchange, idx 
WHERE detailexchange.class_id = idx.class_id;
