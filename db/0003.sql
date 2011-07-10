ALTER TABLE users CHANGE user_name user_name VARCHAR(64) UNIQUE;
ALTER TABLE users CHANGE user_email user_email VARCHAR(64) NOT NULL;
