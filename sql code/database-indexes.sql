CREATE INDEX Transaction_Pieces ON Contains (Pieces);
CREATE INDEX Payment_amount ON Transaction (Total_amount);
CREATE INDEX Cash_or_Card ON Transaction (Payment_method);
CREATE INDEX Alley_Number ON Offers (Alley);
CREATE INDEX Age ON Customer (Date_of_Birth);
CREATE INDEX Brand ON Product (Brand_Name);

ALTER TABLE `Category`
  ADD PRIMARY KEY (`Category_name`);

ALTER TABLE `Contains`
  ADD PRIMARY KEY (`Barcode`,`Card_id`,`DateTime`),
  ADD KEY `Transaction_Pieces` (`Pieces`),
  ADD KEY `Contains_ibfk_2` (`Card_id`),
  ADD KEY `Contains_ibfk_3` (`DateTime`);

ALTER TABLE `Customer`
  ADD PRIMARY KEY (`Card_id`),
  ADD KEY `Age` (`Date_of_birth`);

ALTER TABLE `E_mail`
  ADD PRIMARY KEY (`E_mail`),
  ADD KEY `Card_id` (`Card_id`);

ALTER TABLE `Has`
  ADD PRIMARY KEY (`Category_name`,`Store_id`),
  ADD KEY `Store_id` (`Store_id`);

ALTER TABLE `History`
  ADD PRIMARY KEY (`Start_date`,`Barcode`),
  ADD KEY `Barcode` (`Barcode`);

ALTER TABLE `Offers`
  ADD PRIMARY KEY (`Store_id`,`Barcode`),
  ADD KEY `Barcode` (`Barcode`),
  ADD KEY `Alley_Number` (`Alley`);

ALTER TABLE `Phone_C`
  ADD PRIMARY KEY (`Phone_number`),
  ADD KEY `Card_id` (`Card_id`);

ALTER TABLE `Phone_S`
  ADD PRIMARY KEY (`Phone_number`),
  ADD KEY `Store_id` (`Store_id`);

ALTER TABLE `Product`
  ADD PRIMARY KEY (`Barcode`),
  ADD KEY `Brand` (`Brand_name`),
  ADD KEY `Category_name` (`Category_name`);

ALTER TABLE `Store`
  ADD PRIMARY KEY (`Store_id`);

ALTER TABLE `Transaction`
  ADD PRIMARY KEY (`DateTime`,`Card_id`),
  ADD KEY `Payment_amount` (`Total_amount`),
  ADD KEY `Cash_or_Card` (`Payment_method`),
  ADD KEY `Transaction_ibfk_1` (`Card_id`),
  ADD KEY `Transaction_ibfk_2` (`Store_id`);
