CREATE DATABASE project CHARACTER SET utf8 COLLATE utf8_general_ci;
USE project;

CREATE TABLE tbl_cartegory (
	cartegory_id INT AUTO_INCREMENT NOT NULl,
	cartegory_name VARCHAR(255) NOT NULL,
	PRIMARY KEY(cartegory_id)
);
SELECT * FROM tbl_category;

CREATE TABLE tbl_news (
	news_id INT AUTO_INCREMENT NOT NULl,
	news_title VARCHAR(255) NOT NULL,
    news_content LONGTEXT NOT NULL,
    news_desc TEXT NOT NULL,
    news_img VARCHAR(255) NOT NULL,
	PRIMARY KEY(news_id)
);
SELECT * FROM tbl_news;

CREATE TABLE tbl_product (
	product_id INT AUTO_INCREMENT NOT NULl,
    cartegory_id INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    product_price VARCHAR(255) NOT NULL,
    product_desc TEXT NOT NULL,
    product_img VARCHAR(255) NOT NULL,
	PRIMARY KEY(product_id),
    FOREIGN KEY(cartegory_id) REFERENCES tbl_cartegory(cartegory_id) 
    ON DELETE CASCADE ON UPDATE CASCADE
);
SELECT * FROM tbl_product;

CREATE TABLE tbl_cart (
	cart_id INT AUTO_INCREMENT NOT NULl,
    session_id VARCHAR(255) NOT NULL,
    product_id INT NOT NULL,
    product_quantity VARCHAR(255) NOT NULL,
	PRIMARY KEY(cart_id)
);
SELECT * FROM tbl_cart;

CREATE TABLE tbl_order (
	order_id INT AUTO_INCREMENT NOT NULl,
    order_code INT NOT NULL,
	product_id INT NOT NULL,
    product_quantity INT NOT NULL,
    hoten VARCHAR(255) NOT NULL,
	dienthoai VARCHAR(255) NOT NULL,
	diachi VARCHAR(255) NOT NULL,
	status INT DEFAULT(0) NOT NULL,
	method VARCHAR(100) NOT NULL,
	date TIMESTAMP DEFAULT(CURRENT_TIMESTAMP()),
	PRIMARY KEY(order_id)
);

SELECT * FROM tbl_order;
