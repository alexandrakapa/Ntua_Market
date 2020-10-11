CREATE TABLE `Category` (
  `Category_name` enum('Fresh_produce','Frozen_foods','Drinks','Personal_care','House_supplies','Pet_care','Test') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Contains` (
  `Barcode` decimal(12,0) NOT NULL,
  `Card_id` decimal(5,0) NOT NULL,
  `Pieces` tinyint NOT NULL DEFAULT '1',
  `DateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Customer` (
  `Card_id` decimal(5,0) NOT NULL,
  `Points` int NOT NULL DEFAULT '0',
  `Family_members` tinyint NOT NULL DEFAULT '0',
  `Name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Last_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Date_of_birth` date NOT NULL,
  `City` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Postal_code` decimal(5,0) NOT NULL,
  `Number` smallint NOT NULL,
  `Street` varchar(50) NOT NULL,
  `Pets` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `E_mail` (
  `E_mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Card_id` decimal(5,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=COMPACT;

CREATE TABLE `Has` (
  `Category_name` enum('Fresh_produce','Frozen_foods','Drinks','Personal_care','House_supplies','Pet_care') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Store_id` tinyint NOT NULL,
  `Number_of_products` enum('10','11','12','13','14','15','16','17','18','19','20') NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `History` (
  `Start_date` date NOT NULL,
  `End_date` date DEFAULT NULL,
  `Price` decimal(5,2) NOT NULL,
  `Barcode` decimal(12,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Offers` (
  `Alley` tinyint NOT NULL,
  `Self` tinyint NOT NULL,
  `Store_id` tinyint NOT NULL,
  `Barcode` decimal(12,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Phone_C` (
  `Card_id` decimal(5,0) NOT NULL,
  `Phone_number` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Phone_S` (
  `Phone_number` decimal(10,0) NOT NULL,
  `Store_id` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Product` (
  `Barcode` decimal(12,0) NOT NULL,
  `Category_name` enum('Fresh_produce','Frozen_foods','Drinks','Personal_care','House_supplies','Pet_care') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Brand_name` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'no',
  `Price` decimal(5,2) UNSIGNED NOT NULL,
  `Product_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Store` (
  `Store_id` tinyint NOT NULL,
  `Operating_hours` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Postal_code` decimal(5,0) NOT NULL,
  `Street` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `City` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Number` smallint NOT NULL,
  `Size` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Transaction` (
  `DateTime` datetime NOT NULL,
  `Card_id` decimal(5,0) NOT NULL,
  `Store_id` tinyint NOT NULL,
  `Total_amount` decimal(6,2) NOT NULL,
  `Payment_method` enum('Cash','Card') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Cash'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
