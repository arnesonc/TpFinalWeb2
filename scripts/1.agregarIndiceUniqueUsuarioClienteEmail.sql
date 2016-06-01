use editorialjr;

ALTER TABLE usuario
ADD CONSTRAINT email_unique UNIQUE (email);

ALTER TABLE cliente
ADD CONSTRAINT email_unique UNIQUE (email);
