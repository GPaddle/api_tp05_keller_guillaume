DROP TABLE IF EXISTS Accounts;

DROP TABLE IF EXISTS Addresses;

DROP TABLE IF EXISTS Contacts;

DROP TABLE IF EXISTS MetaData;

DROP TABLE IF EXISTS category_product;

DROP TABLE IF EXISTS Categories;

DROP TABLE IF EXISTS Products;

DROP TABLE IF EXISTS Users;

Create Table Users (
	id SERIAL PRIMARY KEY,
	firstName VARCHAR(256),
	lastName VARCHAR(256),
	civility VARCHAR(256)
);

Create Table Accounts (
	id SERIAL PRIMARY KEY,
	login_ VARCHAR(20),
	hashedPassword VARCHAR(256),
	user_id INT,
	CONSTRAINT fk_user FOREIGN KEY(user_id) REFERENCES Users(id)
);

Create Table Addresses (
	id SERIAL PRIMARY KEY,
	street VARCHAR(256),
	postal_code VARCHAR(5),
	city VARCHAR(256),
	country VARCHAR(256),
	user_id INT,
	CONSTRAINT fk_user FOREIGN KEY(user_id) REFERENCES Users(id)
);

Create Table Contacts (
	id SERIAL PRIMARY KEY,
	email VARCHAR(256),
	phone_number VARCHAR(20),
	user_id INT,
	CONSTRAINT fk_user FOREIGN KEY(user_id) REFERENCES Users(id)
);

Create Table Products (
	id SERIAL PRIMARY KEY,
	title VARCHAR(256),
	description_ VARCHAR(256),
	price DECIMAL,
	icon VARCHAR(4)
);

Create Table Categories (
	id SERIAL PRIMARY KEY,
	name_ VARCHAR(256)
);

Create Table MetaData (
	id SERIAL PRIMARY KEY,
	name_ VARCHAR(256),
	value_ VARCHAR(256),
	product_id INT,
	CONSTRAINT fk_product FOREIGN KEY(product_id) REFERENCES Products(id)
);

Create Table category_product (
	id SERIAL PRIMARY KEY,
	product_id INT,
	category_id INT,
	CONSTRAINT fk_category_pc FOREIGN KEY(category_id) REFERENCES Categories(id),
	CONSTRAINT fk_product_pc FOREIGN KEY(product_id) REFERENCES Products(id)
);