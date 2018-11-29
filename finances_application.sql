
-- users table

CREATE TABLE `users` 
(
user_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
name varchar(50) NOT NULL,
password varchar(255) NOT NULL
);

-- incomes_category_assigned_to_users

CREATE TABLE `incomes_category_assigned_to_user` 
(
id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id int(11) NOT NULL,
CONSTRAINT users_user_id_fk
FOREIGN KEY (user_id)
REFERENCES users (user_id),
name varchar(50) NOT NULL
);

-- incomes_category_default

CREATE TABLE `incomes_category_default`
(
id int(11) NOT NULL,
name varchar(50) NOT NULL
);

-- add default categories

INSERT INTO `incomes_category_default` (`id`, `name`) VALUES
(1,'Wypłata'),
(2, 'Odsetki'),
(3, 'Allegro'),
(4, 'Inny');

-- incomes

CREATE TABLE `incomes` 
(
id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id int(11) NOT NULL,
CONSTRAINT `incomes_category_users_user_id_fk`
FOREIGN KEY (user_id)
REFERENCES `users` (user_id),
income_category_assigned_to_user_id int(11) NOT NULL,
CONSTRAINT `incomes_category_assigned_to_user_id_fk`
FOREIGN KEY (income_category_assigned_to_user_id)
REFERENCES `incomes_category_assigned_to_user` (id)
ON DELETE CASCADE,
amount decimal(8,2) NOT NULL,
date_of_income date NOT NULL,
income_comment varchar(100) NOT NULL
);

-- expenses_category_assigned_to_users

CREATE TABLE `expenses_category_assigned_to_user` 
(
id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id int(11) NOT NULL,
CONSTRAINT `expenses_users_user_id_fk`
FOREIGN KEY (user_id)
REFERENCES `users` (user_id),
name varchar(50) NOT NULL
);

-- expenses_category_default

CREATE TABLE `expenses_category_default`
(
id int(11) NOT NULL,
name varchar(50) NOT NULL
);

INSERT INTO `expenses_category_default` (`id`, `name`) VALUES
(1,'Jedzenie'),
(2, 'Mieszkanie'),
(3, 'Transport'),
(4, 'Telekomunikacja'),
(5, 'Zdrowie'),
(6, 'Ubranie'),
(7, 'Higiena'),
(8, 'Dzieci'),
(9, 'Rozrywka'),
(10, 'Wycieczki'),
(11, 'Szkolenia'),
(12, 'Książki'),
(13, 'Oszczędności'),
(14, 'Emeryturę'),
(15, 'Raty'),
(16, 'Darowizna'),
(17, 'Inne');

-- payment_method_assigned_to_user

CREATE TABLE `payment_method_assigned_to_user` 
(
id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id int(11) NOT NULL,
CONSTRAINT `payment_users_user_id_fk`
FOREIGN KEY (user_id)
REFERENCES `users` (user_id),
pay_name varchar(50) NOT NULL
);

-- payment_methods_default

CREATE TABLE `payment_methods_default`
(
id int(11) NOT NULL,
pay_name varchar(50) NOT NULL
);

-- add payment_methods_default

INSERT INTO `payment_methods_default` (`id`, `pay_name`) VALUES
(1,'Gotówka'),
(2, 'Karta kredytowa'),
(3, 'Karta debetowa');

-- expenses

CREATE TABLE `expenses` 
(
id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id int(11) NOT NULL,
CONSTRAINT `expenses_key_users_user_id_fk`
FOREIGN KEY (user_id)
REFERENCES `users` (user_id),
expenses_category_assigned_to_user_id int(11) NOT NULL,
CONSTRAINT `expenses_category_assigned_to_user_id_fk`
FOREIGN KEY (expenses_category_assigned_to_user_id)
REFERENCES `expenses_category_assigned_to_user` (id)
ON DELETE CASCADE,
payment_method_assigned_to_user_id int(11) NOT NULL,
CONSTRAINT `payment_method_assigned_to_user_id_fk`
FOREIGN KEY (payment_method_assigned_to_user_id)
REFERENCES `payment_method_assigned_to_user` (id)
ON DELETE CASCADE,
amount decimal(8,2) NOT NULL,
date_of_expense date NOT NULL,
expense_comment varchar(100) NOT NULL
);

ALTER DATABASE `aplikacja_budzetowa` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE `incomes_category_default` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
