ALTER TABLE exchanges ADD INDEX active_idx(exchange_status);
ALTER TABLE exchanges ADD INDEX compete_idx(exc_exchange_id);
