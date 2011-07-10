CREATE OR REPLACE VIEW detailexchange AS
SELECT exchanges.exchange_id, exchanges.exc_exchange_id, classes.class_id, classes.class_name, users.user_id, users.user_name
FROM users, exchanges, classes
WHERE exchanges.user_id = users.user_id
AND exchanges.class_id = classes.class_id
AND exchanges.exchange_status = 0;
