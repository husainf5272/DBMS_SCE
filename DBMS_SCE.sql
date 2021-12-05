CREATE DATABASE Online_Shopping_DB;
USE Online_Shopping_DB;


CREATE TABLE `User` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`first_name` varchar(20) ,
	`middle_name` varchar(20) ,
	`last_name` varchar(20) ,
	`mobile` varchar(15) ,
	`email` varchar(40) ,
	`password` varchar(64) ,
	`registered_at` DATETIME ,
	`last_login` DATETIME ,
	`address` varchar(100) ,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Admin` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_name` varchar(20) ,
	`first_name` varchar(20) ,
	`middle_name` varchar(20) ,
	`last_name` varchar(20) ,
	`mobile` varchar(15) ,
	`email` varchar(40) ,
	`password` varchar(64) ,
	`registered_at` DATETIME ,
	`last_login` DATETIME ,
	`password_changed_at` DATETIME ,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Products` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`title` varchar(30) ,
	`image` varchar(200) ,
	`category_id` int(11) ,
	`fabric_id` int(11) ,
	`available_quantity` int(11) ,
	`summary` varchar(1000) ,
    	`price` int ,
	`created_at` DATETIME ,
	`updated_at` DATETIME ,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Cart` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) ,
	`product_id` int(11) ,
    	`quantity` int ,
	`status` varchar(30) ,
	`created_at` DATETIME ,
	`updated_at` DATETIME ,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Wishlist` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) ,
	`product_id` int(11) ,
	`status` varchar(30) ,
	`created_at` DATETIME ,
	`updated_at` DATETIME ,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Categories` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(20) ,
	`created_at` DATETIME ,
	`updated_at` DATETIME ,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Orders` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) ,
	`product_id` int(11) ,
	`quantity` int(11) ,
	`subTotal` DECIMAL(10) ,
	`tax` DECIMAL(10) ,
	`total` DECIMAL(10) ,
    	`status` varchar(20) ,
	`created_at` DATETIME ,
	`updated_at` DATETIME ,
	`cancelled_at` DATETIME ,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Transactions` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`order_id` int(11) ,
	`unique_id` int(11) ,
	`type` varchar(20) ,
	`mode` varchar(20) ,
	`status` varchar(20) ,
	`date` DATETIME ,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Fabrics` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`image` varchar(200) ,
	`color` int(11) ,
	`material` varchar(50) ,
	`quantity` int(11) ,
	`created_at` DATETIME ,
	`updated_at` DATETIME ,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Colors` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(20) ,
	PRIMARY KEY (`id`)
);

ALTER TABLE `Products` ADD CONSTRAINT `Products_fk0` FOREIGN KEY (`category_id`) REFERENCES `Categories`(`id`);

ALTER TABLE `Products` ADD CONSTRAINT `Products_fk1` FOREIGN KEY (`fabric_id`) REFERENCES `Fabrics`(`id`);

ALTER TABLE `Cart` ADD CONSTRAINT `Cart_fk0` FOREIGN KEY (`user_id`) REFERENCES `User`(`id`);

ALTER TABLE `Cart` ADD CONSTRAINT `Cart_fk1` FOREIGN KEY (`product_id`) REFERENCES `Products`(`id`);

ALTER TABLE `Wishlist` ADD CONSTRAINT `Wishlist_fk0` FOREIGN KEY (`user_id`) REFERENCES `User`(`id`);

ALTER TABLE `Wishlist` ADD CONSTRAINT `Wishlist_fk1` FOREIGN KEY (`product_id`) REFERENCES `Products`(`id`);

ALTER TABLE `Orders` ADD CONSTRAINT `Orders_fk0` FOREIGN KEY (`user_id`) REFERENCES `User`(`id`);

ALTER TABLE `Orders` ADD CONSTRAINT `Orders_fk1` FOREIGN KEY (`product_id`) REFERENCES `Products`(`id`);

ALTER TABLE `Transactions` ADD CONSTRAINT `Transactions_fk0` FOREIGN KEY (`order_id`) REFERENCES `Orders`(`id`);

ALTER TABLE `Fabrics` ADD CONSTRAINT `Fabrics_fk0` FOREIGN KEY (`color`) REFERENCES `Colors`(`id`);


INSERT INTO categories VALUES (1, "Suits", now(), null);
INSERT INTO categories VALUES (2, "Shirts", now(), null);
INSERT INTO categories VALUES (3, "Trousers", now(), null);

INSERT INTO colors VALUES (1, "blue");
INSERT INTO colors VALUES (2, "red");
INSERT INTO colors VALUES (3, "white");
INSERT INTO colors VALUES (4, "grey");

INSERT INTO fabrics VALUES (1, "https://cdn.lanieri.com/linings/images/000/000/015/thumb/43820140221-2-1xpuur5.jpg", 1, "Lanificio Zignone", 20, now(), null);
INSERT INTO fabrics VALUES (2, "https://cdn.lanieri.com/linings/images/000/000/037/thumb/1309_F_1-24.jpg", 2, "Guabello", 20, now(), null);
INSERT INTO fabrics VALUES (3, "https://cdn.lanieri.com/images/images/003/845/147/original/8ff-m24600-10131_wave.jpg", 3, "Marzotto", 20, now(), null);
INSERT INTO fabrics VALUES (4, "https://cdn.lanieri.com/images/images/003/845/261/original/c88-r5200-3_wave.jpg", 4, "Reda", 20, now(), null);
INSERT INTO fabrics VALUES (5, "https://cdn.lanieri.com/images/images/003/845/035/original/ede-c2702-0262_wave.jpg", 1, "Canclini", 20, now(), null);
INSERT INTO fabrics VALUES (6, "https://cdn.lanieri.com/images/images/003/845/121/original/31b-la33035-46b_wave.jpg", 4, "Albini", 20, now(), null);

INSERT INTO Products VALUES (1, "Light Blue Icon Twill Suit", "https://cdn.lanieri.com/images/images/003/845/472/original/cea-zg550-5795_render_Suit.jpg", 1, 1, 5, "A true must-have in any gentleman’s wardrobe, this light blue twill suit is the ideal choice for formal settings and important occasions. Perfect in all seasons, it guarantees a flawless look from one business meeting to the next", 6450, now(), null);
INSERT INTO Products VALUES (2, "Red Wool Flannel Suit", "https://cdn.lanieri.com/images/images/003/845/096/original/da7-gb4032-230_render_Suit.jpg", 1, 2, 5, "Elegant and enveloping, this burgundy brushed flannel suit is a true winter wardrobe must-have. Made for colder days, it is ideal for special occasions.", 7500, now(), null);
INSERT INTO Products VALUES (3, "Cream Twill Flannel Suit", "https://cdn.lanieri.com/images/images/003/845/144/original/ad2-m24600-10131_render_Suit.jpg", 1, 3, 5, "This cream-colored twill flannel suit is crafted using a premium fabric from Marzotto’s prestigious Fabbrica Alta range.", 5500, now(), null);
INSERT INTO Products VALUES (4, "Grey Brushed Flannel Suit", "https://cdn.lanieri.com/images/images/003/845/258/original/9f5-r5200-3_render_Suit.jpg", 1, 4, 5, "Elegance and timeless style: these are the key ingredients behind this grey Super 150’s brushed flannel suit tailored in pure Italian style", 8000, now(), null);
INSERT INTO Products VALUES (5, "Light Blue Icon Twill Trousers", "https://cdn.lanieri.com/images/images/003/845/473/big/080-zg550-5795_render_Trouser.jpg", 3, 1, 5, "A true must-have in any gentleman’s wardrobe, these light blue twill trousers are the ideal choice for formal settings and important occasions.", 1650, now(), null);
INSERT INTO Products VALUES (6, "Red Wool Flannel Trousers", "https://cdn.lanieri.com/images/images/003/845/097/original/3a5-gb4032-230_render_Trouser.jpg", 3, 2, 5, "Elegant and enveloping, these burgundy brushed flannel trousers are a true winter wardrobe must-have. Made for colder days, they are ideal for special occasions.", 2550, now(), null);
INSERT INTO Products VALUES (7, "Cream Twill Flannel Trousers", "https://cdn.lanieri.com/images/images/003/845/145/original/159-m24600-10131_render_Trouser.jpg", 3, 3, 5, " Infused with sophisticated elegance, true to the Italian tailoring tradition, they guarantee a flawless look and are ideal in formal settings and on special occasions.", 1500, now(), null);
INSERT INTO Products VALUES (8, "Grey Brushed Flannel Trousers", "https://cdn.lanieri.com/images/images/003/845/259/original/04d-r5200-3_render_Trouser.jpg", 3, 4, 5, "Elegance and timeless style: these are the key ingredients behind these grey Super 150’s brushed flannel trousers tailored in pure Italian style.", 2050, now(), null);
INSERT INTO Products VALUES (9, "Blue Cotton Shirt", "https://cdn.lanieri.com/images/images/003/844/581/original/8cf-C2702-0262_still-front_Shirt.jpg", 2, 5, 5, "A true must-have in your casual wardrobe, this blue twill shirt is made of flannel and is therefore ideal to be worn without a jacket", 1650, now(), null);
INSERT INTO Products VALUES (10, "Light Grey Cotton Shirt", "https://cdn.lanieri.com/images/images/003/844/739/original/fad-LA33035-46B_still-front_Shirt.jpg", 2, 6, 5, "This light grey shirt stands out for its elegance and style. Under a jacket or with a solid-coloured suit, preferably in the same color palette", 1550, now(), null);

INSERT INTO user (id, first_name, middle_name, last_name, mobile, email, password, registered_at)  VALUES (1, "Husain", "Akil", "Fatepurwala", "8087350152", "husain.21910817@viit.ac.in", "abc123", now());
INSERT INTO user (id, first_name, middle_name, last_name, mobile, email, password, registered_at)  VALUES (2, "Atharwa", "", "Amrutkar", "9137676536", "atharva.21910003@viit.ac.in", "abc123", now());
INSERT INTO user (id, first_name, middle_name, last_name, mobile, email, password, registered_at)  VALUES (3, "Yogesh", "", "Diwate", "9156727553", "yogesh.21910996@viit.ac.in", "abc123", now());

INSERT INTO wishlist VALUES (1, 1, 1, "added", now(), null);
INSERT INTO wishlist VALUES (2, 1, 2, "removed", now() - INTERVAL 5 MINUTE, now());

INSERT INTO cart VALUES (1, 1, 3, 1, "added", now(), null);

INSERT INTO orders VALUES (1, 1, 1, 2, (select price from products where id=1)*2, (select price from products where id=1)*2*0.1, (select price from products where id=1)*2*1.1, "delivered", now(), null, null);

INSERT INTO transactions VALUES (1, 1, 1, "online", "Credit Card", "paid", now());

