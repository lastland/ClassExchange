delimiter //

DROP PROCEDURE IF EXISTS fail; //

DROP TRIGGER IF EXISTS time_chk; //

DROP TRIGGER IF EXISTS time_up_lock; //

DROP TRIGGER IF EXISTS deal_chk; //

CREATE PROCEDURE fail()
BEGIN
	INSERT INTO NOTHING VALUES('NOTHING');
END; //

CREATE TRIGGER time_chk BEFORE INSERT ON classtime
FOR EACH ROW
BEGIN
	IF NEW.start_time < 1 OR NEW.start_time > 14 THEN
		CALL fail();
	END IF;
	IF NEW.end_time < 1 OR NEW.end_time > 14 THEN
		CALL fail();
	END IF;
	IF NEW.day_in_week < 1 OR NEW.day_in_week > 7 THEN 
		CALL fail();
	END IF;
	SET NEW.classtime_id = (NEW.day_in_week - 1) * 7 * 14 + (NEW.start_time - 1) * 14 + NEW.end_time;
END; //

CREATE TRIGGER time_up_lock BEFORE UPDATE ON classtime
FOR EACH ROW
BEGIN
	CALL fail();
END; //

CREATE TRIGGER deal_chk BEFORE UPDATE ON exchanges
FOR EACH ROW
BEGIN
	IF NEW.exchange_status = 1 AND ((NEW.exc_exchange_id2 IS NULL AND NEW.exc_exchange_id3 IS NULL) OR (OLD.exc_exchange_id2 IS NULL AND OLD.exc_exchange_id3 IS NULL)) THEN
		CALL fail();
	END IF;
END; //

delimiter ;
