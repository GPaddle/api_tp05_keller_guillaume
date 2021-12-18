DELETE FROM
	Accounts;

DELETE FROM
	Users;

DELETE FROM
	Addresses;

DELETE FROM
	Contacts;

DELETE FROM
	category_product;

DELETE FROM
	MetaData;

DELETE FROM
	Products;

DELETE FROM
	Categories;

INSERT INTO
	Users
VALUES
	(1, 'Bill', 'Gates', 'Mr'),
	(2, 'Steve', 'Jobs', 'Mr'),
	(3, 'Mark', 'Zuckerberg', 'Mr'),
	(4, 'Evan ', 'Spiegel ', 'Mr '),
	(5, 'Jack ', 'Dorsey ', 'Mr ');

INSERT INTO
	Accounts (id, login_, hashedPassword, user_id)
VALUES
	(1, 'bill.gates', '$2y$10$S4FkXBHpxOu1W97QsBY4RenBUU6EzkpICWpuaGdsAeQKXOWcURyqO', 1), --azerty
	(2, 'steve.jobs', '$2y$10$S4FkXBHpxOu1W97QsBY4RenBUU6EzkpICWpuaGdsAeQKXOWcURyqO', 2), --azerty
	(3, 'mark.zuckerberg', '$2y$10$S4FkXBHpxOu1W97QsBY4RenBUU6EzkpICWpuaGdsAeQKXOWcURyqO', 3), --azerty
	(4, 'evan.spiegel', '$2y$10$S4FkXBHpxOu1W97QsBY4RenBUU6EzkpICWpuaGdsAeQKXOWcURyqO', 4), --azerty
	(5, 'jack.dorsey', '$2y$10$S4FkXBHpxOu1W97QsBY4RenBUU6EzkpICWpuaGdsAeQKXOWcURyqO', 5); --azerty

INSERT INTO
	Addresses (
		id,
		street,
		postal_code,
		city,
		country,
		user_id
	)
VALUES
	(1, 'Microsoft street', '00000', 'Test', 'USA', 1),
	(2, 'Apple street', '00000', 'Test', 'USA', 2),
	(3, 'Facebook street', '00000', 'Test', 'USA', 3),
	(4, 'Snapchat street', '00000', 'Test', 'USA', 4),
	(5, 'Twitter street', '00000', 'Test', 'USA', 5);

INSERT INTO
	Contacts (id, email, phone_number, user_id)
VALUES
	(1, 'bill@gates.com', '0606060606', 1),
	(2, 'steve@jobs.com', '0606060606', 2),
	(3, 'mark@zuckerberg.com', '0606060606', 3),
	(4, 'evan@spiegel.com', '0606060606', 4),
	(5, 'jack@dorsey.com', '0606060606', 5);

INSERT INTO
	Products (id, title, description_, price, icon)
VALUES
	(
		0,
		'Orange',
		'🍊 Comme une célèbre marque de télécom',
		0.58,
		'🍊'
	),
	(
		1,
		'Pomme',
		'🍎 Sympa, disponible toute l''année',
		0.18,
		'🍎'
	),
	(
		2,
		'Banane',
		'🍌 Pas mal pour avoir la forme avant une course.',
		0.43,
		'🍌'
	),
	(
		3,
		'Pastèque',
		'🍉 Top pour l''été, rafraichissant.',
		1.00,
		'🍉'
	),
	(
		4,
		'Ananas',
		'🍍 Très bon en tranche.',
		2.99,
		'🍍'
	),
	(
		5,
		'Fraise',
		'🍓 Sucré, summer vibes, c''est top !',
		0.05,
		'🍓'
	),
	(
		6,
		'Citron',
		'🍋 Ca pique un peu les papilles.',
		0.30,
		'🍋'
	),
	(7, 'Pêche', '🍑 Bon été', 1.40, '🍑'),
	(
		8,
		'Raisin',
		'🍇 Aussi pour bon le vin que pour la table',
		2.98,
		'🍇'
	),
	(
		9,
		'Cerise',
		'🍒 De belles boucles d''oreilles qui se mange',
		0.12,
		'🍒'
	),
	(
		10,
		'Kiwi',
		'🥝 Avec le kiwi, une bonne dose de vitamine C tous les matins',
		1.30,
		'🥝'
	),
	(
		11,
		'Cornichon',
		'🥒 Le petit frère du concombre',
		0.99,
		'🥒'
	),
	(
		12,
		'Poire',
		'🍐 Juteuses et très colorées',
		1.20,
		'🍐'
	),
	(13, 'Mangue ', '🥭', 2.00, '🥭'),
	(14, 'Noix de coco', '🥥', 3.50, '🥥'),
	(16, 'Avocat', '🥑', 1.80, '🥑'),
	(15, 'Aubergine', '🍆', 2.30, '🍆'),
	(18, 'Navet', '🥬', 3.40, '🥬'),
	(17, 'Brocolis', '🥦', 1.70, '🥦'),
	(
		20,
		'Piment',
		'🌶 Sensations fortes culinaires garanties',
		0.98,
		'🌶'
	),
	(19, 'Maïs', '🌽', 1.90, '🌽'),
	(
		21,
		'Pomme deterre',
		'🥔 Un féculent d''excellente qualité, peu cher, l''idéal pour vos Baeckeoffe',
		0.12,
		'🥔'
	),
	(22, 'Ail', '🧄', 0.70, '🧄'),
	(23, 'Carotte', '🥕', 0.90, '🥕'),
	(24, 'Oignons', '🧅', 0.80, '🧅');

INSERT INTO
	Categories (id, name_)
VALUES
	(0, 'Fruit'),
	(1, 'Agrume'),
	(2, 'Local'),
	(3, 'Tropical'),
	(4, 'Estival'),
	(5, 'Exotique'),
	(6, 'Locaux'),
	(7, 'Légume');

INSERT INTO
	MetaData (id, name_, value_, product_id)
VALUES
	(0, 'Acidité', '+', 0),
	(1, 'Sucre', '++', 0),
	(2, 'Tarte', '++', 1),
	(3, 'Energie', '++', 2),
	(4, 'Eau', '++', 3),
	(5, 'Sucre', '+', 3),
	(6, 'Sucre', '++', 4),
	(7, 'Acidité', '+', 4),
	(8, 'Sucre', '++', 5),
	(9, 'Acidité', '++', 6),
	(10, 'Acidité', '+', 10),
	(11, 'Acidité', '+', 11),
	(
		12,
		'Précaution d''emplois',
		'Ne pas manger l''écorce',
		14
	),
	(
		13,
		'Fun fact',
		'Ne vous aidera pas à échapper au tribunal',
		15
	),
	(
		14,
		'Fun fact',
		'Les enfants n''aiment pas ça',
		17
	),
	(15, 'Fun fact', 'N''est pas un film', 18),
	(
		16,
		'Fun fact',
		'Peut se transformer en popcorn magique',
		19
	),
	(
		17,
		'Fun fact',
		'Vous donnera une haleine à repousser un monstre',
		22
	),
	(
		18,
		'Fun fact',
		'Selon la légende, elle rend aimable',
		23
	),
	(
		19,
		'Fun fact',
		'Vous fera pleurer si vous osez lui faire du mal',
		24
	);

INSERT INTO
	category_product (category_id, product_id)
VALUES
	(1, 0),
	(0, 0),
	(2, 1),
	(0, 1),
	(3, 2),
	(0, 2),
	(3, 3),
	(0, 3),
	(3, 4),
	(0, 4),
	(4, 5),
	(0, 5),
	(1, 6),
	(0, 6),
	(2, 7),
	(0, 7),
	(2, 8),
	(0, 8),
	(2, 9),
	(0, 9),
	(5, 10),
	(0, 10),
	(2, 11),
	(7, 11),
	(6, 12),
	(0, 12),
	(5, 13),
	(0, 13),
	(5, 14),
	(0, 14),
	(2, 15),
	(7, 15),
	(5, 16),
	(7, 16),
	(2, 17),
	(7, 17),
	(2, 18),
	(7, 18),
	(2, 19),
	(7, 19),
	(5, 20),
	(7, 20),
	(2, 21),
	(7, 21),
	(2, 22),
	(7, 22),
	(2, 23),
	(7, 23),
	(2, 24),
	(7, 24);

select
	*
from
	products;