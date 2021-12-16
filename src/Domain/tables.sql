set
	transaction read write;

DROP TABLE IF EXISTS Account;

DROP TABLE IF EXISTS Address_;

DROP TABLE IF EXISTS Category;

DROP TABLE IF EXISTS Contact;

DROP TABLE IF EXISTS MetaData;

DROP TABLE IF EXISTS ProductCategory;

DROP TABLE IF EXISTS Product;

DROP TABLE IF EXISTS User_;

Create Table User_ (
	idUser SERIAL PRIMARY KEY,
	firstName VARCHAR(256),
	lastName VARCHAR(256),
	civility VARCHAR(256)
);

Create Table Account (
	idAccount SERIAL PRIMARY KEY,
	login_ VARCHAR(20),
	hashedPassword VARCHAR(256),
	idUser INT,
	CONSTRAINT fk_user FOREIGN KEY(idUser) REFERENCES User_(idUser)
);

Create Table Address_ (
	idAddress SERIAL PRIMARY KEY,
	street VARCHAR(256),
	postalCode VARCHAR(5),
	city VARCHAR(256),
	country VARCHAR(256),
	idUser INT,
	CONSTRAINT fk_user FOREIGN KEY(idUser) REFERENCES User_(idUser)
);

Create Table Contact (
	idContact SERIAL PRIMARY KEY,
	email VARCHAR(256),
	phoneNumber VARCHAR(20),
	idUser INT,
	CONSTRAINT fk_user FOREIGN KEY(idUser) REFERENCES User_(idUser)
);

Create Table Product (
	idProduct SERIAL PRIMARY KEY,
	title VARCHAR(256),
	description_ VARCHAR(256),
	price DECIMAL,
	icon VARCHAR(4)
);

Create Table Category (
	idCategory SERIAL PRIMARY KEY,
	name_ VARCHAR(256)
);

Create Table MetaData (
	idMetaData SERIAL PRIMARY KEY,
	name_ VARCHAR(256),
	value_ VARCHAR(256),
	idProduct INT,
	CONSTRAINT fk_product FOREIGN KEY(idProduct) REFERENCES Product(idProduct)
);

Create Table ProductCategory (
	idProductCategory SERIAL PRIMARY KEY,
	idCategory INT,
	idProduct INT,
	CONSTRAINT fk_category FOREIGN KEY(idCategory) REFERENCES Category(idCategory),
	CONSTRAINT fk_product FOREIGN KEY(idProduct) REFERENCES Product(idProduct)
);