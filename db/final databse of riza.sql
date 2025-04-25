
-- Enhanced schema for restaurant app with user avatars and phone numbers

CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    avatar VARCHAR(255),
    phone VARCHAR(20),
    account_role ENUM('customer', 'owner') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE restaurant (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    address TEXT,
    phone VARCHAR(20),
    owner_id INT UNIQUE,
    FOREIGN KEY (owner_id) REFERENCES user(id) ON DELETE CASCADE
);

CREATE TABLE product (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    restaurant_id INT NOT NULL,
    img VARCHAR(255),
    time_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(id) ON DELETE CASCADE
);

CREATE TABLE cart (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    restaurant_id INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(id) ON DELETE CASCADE
);

CREATE TABLE cart_item (
    id INT PRIMARY KEY AUTO_INCREMENT,
    cart_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (cart_id) REFERENCES cart(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE
);

CREATE TABLE order_table (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    restaurant_id INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(id) ON DELETE CASCADE
);

CREATE TABLE invoice (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    user_id INT NOT NULL,
    restaurant_id INT NOT NULL,
    notes TEXT,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES order_table(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(id) ON DELETE CASCADE
);


--INSERT dummy data


INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (1, 'Hank', 'Williams', 'hank.williams1@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_1.jpg', '+13045186524', 'owner');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (2, 'Bob', 'Davis', 'bob.davis2@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_2.jpg', '+14448939591', 'customer');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (3, 'Charlie', 'Brown', 'charlie.brown3@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_3.jpg', '+17503786998', 'owner');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (4, 'Jack', 'Williams', 'jack.williams4@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_4.jpg', '+12187798294', 'customer');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (5, 'Grace', 'Brown', 'grace.brown5@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_5.jpg', '+17204315527', 'customer');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (6, 'Alice', 'Johnson', 'alice.johnson6@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_6.jpg', '+13987387992', 'customer');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (7, 'Hank', 'Williams', 'hank.williams7@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_7.jpg', '+18030583160', 'customer');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (8, 'Diana', 'Williams', 'diana.williams8@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_8.jpg', '+17414816050', 'customer');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (9, 'Hank', 'Williams', 'hank.williams9@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_9.jpg', '+15478112497', 'owner');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (10, 'Ivy', 'Brown', 'ivy.brown10@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_10.jpg', '+19711666083', 'customer');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (11, 'Grace', 'Smith', 'grace.smith11@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_11.jpg', '+12836042116', 'customer');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (12, 'Alice', 'Smith', 'alice.smith12@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_12.jpg', '+19610857521', 'customer');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (13, 'Ivy', 'Wilson', 'ivy.wilson13@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_13.jpg', '+19862141801', 'customer');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (14, 'Hank', 'Smith', 'hank.smith14@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_14.jpg', '+15417590513', 'customer');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (15, 'Bob', 'Miller', 'bob.miller15@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_15.jpg', '+14897654411', 'owner');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (16, 'Grace', 'Brown', 'grace.brown16@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_16.jpg', '+12032978605', 'customer');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (17, 'Ivy', 'Johnson', 'ivy.johnson17@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_17.jpg', '+18194861763', 'owner');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (18, 'Jack', 'Miller', 'jack.miller18@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_18.jpg', '+16096133642', 'customer');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (19, 'Grace', 'Davis', 'grace.davis19@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_19.jpg', '+18420014635', 'customer');
INSERT INTO user (id, first_name, last_name, email, password, avatar, phone, account_role) VALUES (20, 'Jack', 'Smith', 'jack.smith20@example.com', 'e10adc3949ba59abbe56e057f20f883e
', 'avatar_20.jpg', '+17662627316', 'owner');
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (1, 'Restaurant_1', 'Address_1', '+12126242681', 1);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (2, 'Restaurant_2', 'Address_2', '+12934028719', 2);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (3, 'Restaurant_3', 'Address_3', '+18143866552', 3);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (4, 'Restaurant_4', 'Address_4', '+19937846210', 4);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (5, 'Restaurant_5', 'Address_5', '+19522350328', 5);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (6, 'Restaurant_6', 'Address_6', '+17882265084', 6);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (7, 'Restaurant_7', 'Address_7', '+17209594216', 7);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (8, 'Restaurant_8', 'Address_8', '+17345523602', 8);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (9, 'Restaurant_9', 'Address_9', '+15849872499', 9);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (10, 'Restaurant_10', 'Address_10', '+14373042784', 10);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (11, 'Restaurant_11', 'Address_11', '+18012215509', 11);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (12, 'Restaurant_12', 'Address_12', '+13696606123', 12);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (13, 'Restaurant_13', 'Address_13', '+15491007657', 13);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (14, 'Restaurant_14', 'Address_14', '+17934515584', 14);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (15, 'Restaurant_15', 'Address_15', '+16185570852', 15);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (16, 'Restaurant_16', 'Address_16', '+13094400191', 16);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (17, 'Restaurant_17', 'Address_17', '+12090685675', 17);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (18, 'Restaurant_18', 'Address_18', '+14880773374', 18);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (19, 'Restaurant_19', 'Address_19', '+16663749316', 19);
INSERT INTO restaurant (id, name, address, phone, owner_id) VALUES (20, 'Restaurant_20', 'Address_20', '+15151021980', 20);
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (1, 'Product_1', 20.33, 18, 1, 'img_1.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (2, 'Product_2', 5.07, 98, 1, 'img_2.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (3, 'Product_3', 39.07, 46, 1, 'img_3.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (4, 'Product_4', 25.16, 57, 1, 'img_4.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (5, 'Product_5', 14.96, 93, 1, 'img_5.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (6, 'Product_6', 28.39, 21, 2, 'img_6.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (7, 'Product_7', 26.99, 73, 2, 'img_7.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (8, 'Product_8', 6.34, 86, 2, 'img_8.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (9, 'Product_9', 49.22, 47, 2, 'img_9.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (10, 'Product_10', 16.5, 66, 2, 'img_10.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (11, 'Product_11', 41.27, 34, 3, 'img_11.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (12, 'Product_12', 28.95, 87, 3, 'img_12.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (13, 'Product_13', 35.44, 95, 3, 'img_13.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (14, 'Product_14', 11.05, 66, 3, 'img_14.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (15, 'Product_15', 41.0, 98, 3, 'img_15.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (16, 'Product_16', 40.4, 37, 4, 'img_16.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (17, 'Product_17', 32.83, 7, 4, 'img_17.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (18, 'Product_18', 24.96, 84, 4, 'img_18.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (19, 'Product_19', 18.1, 73, 4, 'img_19.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (20, 'Product_20', 33.34, 100, 4, 'img_20.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (21, 'Product_21', 15.02, 64, 5, 'img_21.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (22, 'Product_22', 18.34, 95, 5, 'img_22.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (23, 'Product_23', 34.08, 68, 5, 'img_23.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (24, 'Product_24', 24.07, 18, 5, 'img_24.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (25, 'Product_25', 15.65, 21, 5, 'img_25.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (26, 'Product_26', 27.96, 91, 6, 'img_26.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (27, 'Product_27', 42.51, 53, 6, 'img_27.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (28, 'Product_28', 42.8, 62, 6, 'img_28.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (29, 'Product_29', 45.77, 78, 6, 'img_29.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (30, 'Product_30', 24.11, 81, 6, 'img_30.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (31, 'Product_31', 26.41, 36, 7, 'img_31.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (32, 'Product_32', 24.13, 57, 7, 'img_32.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (33, 'Product_33', 15.05, 34, 7, 'img_33.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (34, 'Product_34', 40.88, 87, 7, 'img_34.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (35, 'Product_35', 16.58, 82, 7, 'img_35.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (36, 'Product_36', 19.31, 51, 8, 'img_36.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (37, 'Product_37', 19.14, 16, 8, 'img_37.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (38, 'Product_38', 7.53, 51, 8, 'img_38.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (39, 'Product_39', 17.33, 37, 8, 'img_39.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (40, 'Product_40', 29.62, 68, 8, 'img_40.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (41, 'Product_41', 27.03, 83, 9, 'img_41.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (42, 'Product_42', 48.33, 74, 9, 'img_42.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (43, 'Product_43', 39.12, 23, 9, 'img_43.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (44, 'Product_44', 16.95, 96, 9, 'img_44.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (45, 'Product_45', 11.38, 58, 9, 'img_45.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (46, 'Product_46', 48.78, 15, 10, 'img_46.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (47, 'Product_47', 5.28, 29, 10, 'img_47.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (48, 'Product_48', 47.96, 77, 10, 'img_48.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (49, 'Product_49', 20.9, 39, 10, 'img_49.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (50, 'Product_50', 17.79, 63, 10, 'img_50.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (51, 'Product_51', 36.3, 93, 11, 'img_51.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (52, 'Product_52', 44.31, 39, 11, 'img_52.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (53, 'Product_53', 44.34, 79, 11, 'img_53.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (54, 'Product_54', 35.07, 49, 11, 'img_54.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (55, 'Product_55', 7.7, 7, 11, 'img_55.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (56, 'Product_56', 25.2, 52, 12, 'img_56.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (57, 'Product_57', 45.08, 88, 12, 'img_57.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (58, 'Product_58', 21.4, 28, 12, 'img_58.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (59, 'Product_59', 32.31, 27, 12, 'img_59.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (60, 'Product_60', 39.59, 78, 12, 'img_60.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (61, 'Product_61', 44.25, 56, 13, 'img_61.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (62, 'Product_62', 20.63, 4, 13, 'img_62.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (63, 'Product_63', 11.89, 18, 13, 'img_63.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (64, 'Product_64', 49.3, 80, 13, 'img_64.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (65, 'Product_65', 15.92, 4, 13, 'img_65.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (66, 'Product_66', 47.76, 52, 14, 'img_66.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (67, 'Product_67', 21.08, 75, 14, 'img_67.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (68, 'Product_68', 33.5, 24, 14, 'img_68.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (69, 'Product_69', 23.44, 90, 14, 'img_69.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (70, 'Product_70', 42.82, 62, 14, 'img_70.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (71, 'Product_71', 8.26, 18, 15, 'img_71.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (72, 'Product_72', 18.84, 67, 15, 'img_72.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (73, 'Product_73', 5.75, 6, 15, 'img_73.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (74, 'Product_74', 31.18, 79, 15, 'img_74.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (75, 'Product_75', 37.91, 3, 15, 'img_75.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (76, 'Product_76', 45.01, 20, 16, 'img_76.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (77, 'Product_77', 15.0, 63, 16, 'img_77.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (78, 'Product_78', 40.29, 59, 16, 'img_78.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (79, 'Product_79', 18.34, 9, 16, 'img_79.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (80, 'Product_80', 40.61, 73, 16, 'img_80.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (81, 'Product_81', 13.23, 13, 17, 'img_81.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (82, 'Product_82', 31.86, 8, 17, 'img_82.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (83, 'Product_83', 27.46, 96, 17, 'img_83.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (84, 'Product_84', 49.64, 90, 17, 'img_84.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (85, 'Product_85', 15.11, 38, 17, 'img_85.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (86, 'Product_86', 15.04, 78, 18, 'img_86.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (87, 'Product_87', 36.52, 30, 18, 'img_87.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (88, 'Product_88', 45.76, 96, 18, 'img_88.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (89, 'Product_89', 23.59, 68, 18, 'img_89.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (90, 'Product_90', 34.34, 25, 18, 'img_90.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (91, 'Product_91', 28.2, 7, 19, 'img_91.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (92, 'Product_92', 16.41, 53, 19, 'img_92.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (93, 'Product_93', 28.94, 90, 19, 'img_93.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (94, 'Product_94', 49.68, 53, 19, 'img_94.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (95, 'Product_95', 24.02, 61, 19, 'img_95.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (96, 'Product_96', 11.49, 99, 20, 'img_96.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (97, 'Product_97', 45.0, 65, 20, 'img_97.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (98, 'Product_98', 32.75, 75, 20, 'img_98.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (99, 'Product_99', 33.0, 61, 20, 'img_99.jpg');
INSERT INTO product (id, name, price, quantity, restaurant_id, img) VALUES (100, 'Product_100', 27.8, 81, 20, 'img_100.jpg');
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (1, 14, 17, 102.9);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (2, 13, 10, 20.89);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (3, 11, 5, 91.48);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (4, 13, 14, 57.8);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (5, 4, 18, 197.17);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (6, 9, 16, 147.12);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (7, 11, 8, 181.83);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (8, 17, 19, 193.32);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (9, 14, 14, 10.15);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (10, 11, 16, 58.84);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (11, 1, 1, 160.25);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (12, 14, 10, 77.5);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (13, 2, 15, 162.46);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (14, 7, 20, 45.21);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (15, 2, 18, 80.31);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (16, 3, 9, 158.59);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (17, 14, 5, 99.04);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (18, 18, 3, 150.34);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (19, 20, 3, 184.13);
INSERT INTO cart (id, user_id, restaurant_id, total) VALUES (20, 20, 19, 126.07);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (1, 1, 64, 4);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (2, 1, 44, 3);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (3, 2, 35, 1);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (4, 2, 88, 2);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (5, 3, 86, 2);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (6, 3, 32, 5);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (7, 4, 90, 1);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (8, 4, 70, 4);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (9, 5, 47, 1);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (10, 5, 85, 1);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (11, 6, 33, 1);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (12, 6, 28, 5);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (13, 7, 23, 4);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (14, 7, 70, 2);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (15, 8, 10, 2);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (16, 8, 12, 1);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (17, 9, 50, 5);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (18, 9, 76, 2);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (19, 10, 26, 1);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (20, 10, 40, 3);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (21, 11, 57, 5);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (22, 11, 96, 5);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (23, 12, 6, 5);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (24, 12, 86, 5);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (25, 13, 78, 1);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (26, 13, 43, 1);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (27, 14, 73, 5);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (28, 14, 11, 3);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (29, 15, 32, 4);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (30, 15, 79, 4);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (31, 16, 96, 5);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (32, 16, 22, 5);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (33, 17, 29, 4);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (34, 17, 75, 5);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (35, 18, 80, 2);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (36, 18, 11, 1);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (37, 19, 19, 2);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (38, 19, 6, 2);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (39, 20, 3, 3);
INSERT INTO cart_item (id, cart_id, product_id, quantity) VALUES (40, 20, 49, 4);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (1, 18, 16, 123.89);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (2, 15, 10, 257.73);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (3, 19, 2, 257.84);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (4, 9, 9, 244.57);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (5, 7, 15, 276.61);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (6, 5, 19, 45.6);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (7, 1, 16, 264.64);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (8, 1, 9, 57.89);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (9, 5, 8, 159.41);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (10, 19, 10, 119.98);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (11, 1, 1, 31.16);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (12, 8, 7, 243.8);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (13, 4, 2, 120.04);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (14, 3, 8, 276.04);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (15, 3, 1, 229.35);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (16, 13, 8, 45.11);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (17, 13, 10, 265.38);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (18, 18, 12, 133.63);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (19, 5, 1, 73.78);
INSERT INTO order_table (id, user_id, restaurant_id, total) VALUES (20, 6, 14, 84.14);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (1, 1, 17, 5, 'Note_1', 80.04);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (2, 2, 12, 13, 'Note_2', 234.8);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (3, 3, 11, 13, 'Note_3', 295.93);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (4, 4, 3, 3, 'Note_4', 296.92);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (5, 5, 18, 20, 'Note_5', 289.31);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (6, 6, 1, 12, 'Note_6', 280.81);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (7, 7, 12, 9, 'Note_7', 72.57);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (8, 8, 1, 13, 'Note_8', 263.01);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (9, 9, 1, 8, 'Note_9', 223.94);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (10, 10, 18, 14, 'Note_10', 126.52);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (11, 11, 9, 7, 'Note_11', 217.23);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (12, 12, 2, 1, 'Note_12', 50.71);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (13, 13, 6, 13, 'Note_13', 275.01);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (14, 14, 4, 16, 'Note_14', 161.99);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (15, 15, 12, 9, 'Note_15', 219.01);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (16, 16, 15, 16, 'Note_16', 229.05);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (17, 17, 4, 19, 'Note_17', 241.04);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (18, 18, 4, 18, 'Note_18', 212.03);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (19, 19, 4, 10, 'Note_19', 186.29);
INSERT INTO invoice (id, order_id, user_id, restaurant_id, notes, total) VALUES (20, 20, 18, 14, 'Note_20', 89.76);