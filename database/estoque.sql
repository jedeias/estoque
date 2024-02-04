DROP DATABASE IF EXISTS estoque;

CREATE DATABASE estoque CHARACTER SET utf8;

USE estoque;

create table user(
    pkUser INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255) NOT NULL,
    type ENUM('Administrator', 'Assistant') default 'Assistant'
)CHARACTER SET utf8;

create table products(
    pkProduct INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    price FLOAT NOT NULL,
    mark VARCHAR(255),
    validate DATE NOT NULL
)CHARACTER SET utf8;

create table location(
    pklocation INTEGER PRIMARY KEY AUTO_INCREMENT,
    local VARCHAR(255) NOT NULL,
    fkProduct INT NOT NULL,
	amount INT NOT NULL,
    entryDate DATE NOT NULL,
    FOREIGN KEY (fkProduct) REFERENCES products(pkProduct)
)CHARACTER SET utf8;

create table sales(
    pkSales INT PRIMARY KEY AUTO_INCREMENT,
    fkProduct INT NOT NULL,
    fkLocation INT NOT NULL,
    sales INT NOT NULL,
	amount INT NOT NULL,
    dateTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (fkProduct) REFERENCES products(pkProduct),
    FOREIGN KEY (fkLocation) REFERENCES Location(pkLocation)
)CHARACTER SET utf8;

CREATE TABLE logs (
    pkLog INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    alterTable VARCHAR(255) NOT NULL,
    fkAlterItem INT NOT NULL,
    alterColumn VARCHAR(255) NOT NULL,
    oldValue VARCHAR(255) NOT NULL,
    newValue VARCHAR(255) NOT NULL,
    dateTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (fkAlterItem) REFERENCES user(pkUser),
    FOREIGN KEY (fkAlterItem) REFERENCES products(pkProduct),
    FOREIGN KEY (fkAlterItem) REFERENCES location(pkLocation)
) CHARACTER SET utf8;

DELIMITER $$

CREATE PROCEDURE insertUser(

    IN _name VARCHAR(255),
    IN _email VARCHAR(255),
    IN _password VARCHAR(255),
    IN _type ENUM("Administrator",'Assistant')

)

BEGIN

    INSERT INTO user (name, email, password, type) 
    VALUES (_name, _email, _password, _type);

    COMMIT;
        ROLLBACK;
END $$
DELIMITER ;

call insertUser("jorge", "jorge@mail.com", "password", "Administrator");

SELECT * FROM user;

DELIMITER $$

CREATE PROCEDURE insertProducts(

    IN _name VARCHAR(255),
    IN _price FLOAT,
    IN _mark VARCHAR(255),
    IN _validate DATE

)

BEGIN

    INSERT INTO products (name, price, mark, validate) 
    VALUES (_name, _price, _mark, _validate);

    COMMIT;
        ROLLBACK;
END $$
DELIMITER ;

call insertProducts("wather", 1, "cristal", "2026-02-02");

SELECT * FROM products;

DELIMITER $$

CREATE PROCEDURE insertLocation(

    IN _local VARCHAR(255),
    IN _fkProduct INT,
	IN _amount INT
)

BEGIN

    INSERT INTO location (local, fkProduct, amount, entryDate) 
    VALUES (_local, _fkProduct, _amount, CURRENT_DATE);

    COMMIT;
        ROLLBACK;
END $$
DELIMITER ;

call insertLocation("stock", 1, 50);

SELECT * FROM location;

DELIMITER $$

CREATE PROCEDURE insertSales(
    IN _fkLocation INT,
    IN _fkProduct INT,
    IN _amount INT,
    IN _sales FLOAT
)
BEGIN
    DECLARE currentAmount INT;

    START TRANSACTION;

    INSERT INTO sales (fkProduct, fkLocation, amount, sales) 
    VALUES (_fkProduct, _fkLocation, _amount, _sales);

    SELECT amount INTO currentAmount FROM location WHERE pkLocation = _fkLocation;

    SET currentAmount = currentAmount - _amount;

    UPDATE location SET amount = currentAmount WHERE pkLocation = _fkLocation;

    COMMIT;
END $$
DELIMITER ;


SELECT * FROM location;
SELECT * FROM sales;