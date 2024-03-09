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
    alterColumn VARCHAR(255) NOT NULL,
    newValue VARCHAR(255) NOT NULL,
    alterType TEXT NOT NULL,
    dateTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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

CREATE PROCEDURE updateUser(

    IN _userId INT,
    IN _name VARCHAR(255),
    IN _email VARCHAR(255),
    IN _password VARCHAR(255),
    IN _type ENUM("Administrator",'Assistant')

)

BEGIN

    UPDATE user 
    SET 
        name = _name, 
        email = _email, 
        password = _password, 
        type = _type
    WHERE pkUser = _userId;

END $$
DELIMITER ;



DELIMITER $$

CREATE PROCEDURE insertProducts(

    IN _name VARCHAR(255),
    IN _price FLOAT,
    IN _mark VARCHAR(255),
    IN _validate DATE

)

BEGIN
    START TRANSACTION;

    INSERT INTO products (name, price, mark, validate) 
    VALUES (_name, _price, _mark, _validate);

    COMMIT;
        ROLLBACK;
END $$
DELIMITER ;

call insertProducts("wather", 1, "cristal", "2026-02-02");

SELECT * FROM products;

-- updateProducts

DELIMITER $$

CREATE PROCEDURE updateProduct(

    IN _pk INT,
    IN _name VARCHAR(255),
    IN _price FLOAT,
    IN _mark VARCHAR(255),
    IN _validate DATE

)

BEGIN
    START TRANSACTION;

    UPDATE products SET name = _name,
                        price = _price,
                        mark = _mark,
                        validate = _validate
                        WHERE pkProduct = _pk;

    COMMIT;
        ROLLBACK;
END $$
DELIMITER ;

call updateProduct(10, "Fone Wireless", "35", "JBL", "2030-03-04");


-- updateLocation

DELIMITER $$

CREATE PROCEDURE updateLocation(

    IN _pk INT,
    IN _local VARCHAR(255),
    IN _pkProduct INT,
    IN _amount INT
)

BEGIN
    START TRANSACTION;

    UPDATE location SET local = _local,
                        fkProduct = _pkProduct,
                        amount = _amount
                        WHERE pkLocation = _pk;

    COMMIT;
        ROLLBACK;
END $$
DELIMITER ;

call updateLocation(17, "matriz", 2, 81);

-- insertLocation


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

DELIMITER $$

CREATE PROCEDURE getUserById(
    IN _pk INT
)
BEGIN

    START TRANSACTION;

    SELECT * FROM user WHERE pkUser = _pk;

    COMMIT;
END $$
DELIMITER ;

call getUserById(1);


DELIMITER $$

CREATE PROCEDURE getUserByEmail(
    IN _Email VARCHAR(255)
)
BEGIN

    START TRANSACTION;

    SELECT * FROM user WHERE Email = _email;

    COMMIT;
END $$
DELIMITER ;

-- call getUserByEmail('jorge@mail.com');

-- INSERT INTO logs (alterTable, fkAlterItem, alterColumn, oldValue, newValue)
-- VALUES ('users', 1, 'name', 'John', 'Jonathan');

DELIMITER $$

CREATE PROCEDURE getProductsById(
    IN _pk INT
)
BEGIN

    START TRANSACTION;

    SELECT * FROM products WHERE pkProduct = _pk;

    COMMIT;
END $$
DELIMITER ;

call getProductsById(1);

DELIMITER $$

CREATE PROCEDURE getLocationById(
    IN _pk INT
)
BEGIN

    START TRANSACTION;

    SELECT * FROM location WHERE pkLocation = _pk;

    COMMIT;
END $$
DELIMITER ;

call getLocationById(1);

DELIMITER $$

CREATE PROCEDURE getSalesById(
    IN _pk INT
)
BEGIN

    START TRANSACTION;

    SELECT * FROM sales WHERE sales = _pk;

    COMMIT;
END $$
DELIMITER ;

call getSalesById(1);

DELIMITER //
CREATE TRIGGER user_after_insert
AFTER INSERT
ON user FOR EACH ROW
BEGIN
    INSERT INTO logs (alterTable, alterColumn, newValue, alterType, dateTime)
    VALUES ('user', 'name', NEW.name, 'INSERT', NOW());
END; //
DELIMITER ;

DELIMITER //
CREATE TRIGGER user_after_update
AFTER UPDATE
ON user FOR EACH ROW
BEGIN
    IF NEW.name <> OLD.name THEN
        INSERT INTO logs (alterTable, alterColumn, newValue, alterType, dateTime)
        VALUES ('user', 'name', NEW.name, 'UPDATE', NOW());
    END IF;
END; //
DELIMITER ;

DELIMITER //
CREATE TRIGGER user_after_delete
AFTER DELETE
ON user FOR EACH ROW
BEGIN
    INSERT INTO logs (alterTable, alterColumn, newValue, alterType, dateTime)
    VALUES ('user', 'name', OLD.name, 'DELETE', NOW());
END; //
DELIMITER ;


DELIMITER //
CREATE TRIGGER stock_after_insert
AFTER INSERT
ON location FOR EACH ROW
BEGIN
    INSERT INTO logs (alterTable, alterColumn, newValue, alterType, dateTime)
    VALUES ('location', 'local', 'INSERT', NEW.local, NOW());
END; //
DELIMITER ;

DELIMITER //
CREATE TRIGGER stock_after_update
AFTER UPDATE
ON location FOR EACH ROW
BEGIN
    IF NEW.local <> OLD.local THEN
        INSERT INTO logs (alterTable, alterColumn, newValue, alterType, dateTime)
        VALUES ('location', 'local', 'UPDATE', NEW.local, NOW());
    END IF;
END; //
DELIMITER ;

DELIMITER //
CREATE TRIGGER stock_after_delete
AFTER DELETE
ON location FOR EACH ROW
BEGIN
    INSERT INTO logs (alterTable, alterColumn, newValue, alterType, dateTime)
    VALUES ('location', 'local', OLD.local, 'DELETE', NOW());
END; //
DELIMITER ;

DELIMITER //
CREATE TRIGGER products_after_insert
AFTER INSERT
ON products FOR EACH ROW
BEGIN
    INSERT INTO logs (alterTable, alterColumn, newValue, alterType, dateTime)
    VALUES ('products', 'name', NEW.name, 'INSERT', NOW());
END; //
DELIMITER ;

DELIMITER //
CREATE TRIGGER products_after_update
AFTER UPDATE
ON products FOR EACH ROW
BEGIN
    IF NEW.name <> OLD.name THEN
        INSERT INTO logs (alterTable, alterColumn, newValue, alterType, dateTime)
        VALUES ('products', 'name', NEW.name, 'UPDATE', NOW());
    END IF;
END; //
DELIMITER ;

DELIMITER //
CREATE TRIGGER products_after_delete
AFTER DELETE
ON products FOR EACH ROW
BEGIN
    INSERT INTO logs (alterTable, alterColumn, newValue, alterType, dateTime)
    VALUES ('products', 'name', OLD.name, 'DELETE', NOW());
END; //
DELIMITER ;

DELIMITER //
CREATE TRIGGER sales_after_insert
AFTER INSERT
ON sales FOR EACH ROW
BEGIN
    INSERT INTO logs (alterTable, alterColumn, newValue, alterType, dateTime)
    VALUES ('sales', 'products', NEW.fkProduct, 'INSERT', NOW());
END; //
DELIMITER ;

DELIMITER //
CREATE TRIGGER sales_after_update
AFTER UPDATE
ON sales FOR EACH ROW
BEGIN
    IF NEW.name <> OLD.name THEN
        INSERT INTO logs (alterTable, alterColumn, newValue, alterType, dateTime)
        VALUES ('sales', 'products', NEW.fkProduct, 'UPDATE', NOW());
    END IF;
END; //
DELIMITER ;

DELIMITER //
CREATE TRIGGER sales_after_delete
AFTER DELETE
ON sales FOR EACH ROW
BEGIN
    INSERT INTO logs (alterTable, alterColumn, newValue, alterType, dateTime)
    VALUES ('sales', 'products', NEW.fkProduct, 'DELETE', NOW());
END; //
DELIMITER ;


CALL updateUser(1, 'jorgeNew', "jorge@mail.com", "password", "Administrator");
