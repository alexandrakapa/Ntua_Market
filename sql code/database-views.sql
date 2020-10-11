CREATE VIEW Sales AS 
SELECT DISTINCT Transaction.Store_id, Transaction.Card_id, Transaction.DateTime, Contains.Barcode, Contains.Pieces, Product.Category_name
FROM Transaction
INNER JOIN Contains ON Contains.Card_id=Transaction.Card_id 
INNER JOIN Product ON Product.Barcode=Contains.Barcode
WHERE Transaction.DateTime=Contains.DateTime

CREATE VIEW Customers_List AS 
SELECT DISTINCT Customer.Card_id, Customer.Name, Customer.Last_name, Customer.Date_of_birth, Customer.City, Customer.Street, Customer.Number, Customer.Postal_code, Customer.Family_members, Customer.Pets, Customer.Points, E_mail.E_mail, Phone_C.Phone_number, (YEAR(CURRENT_DATE()) - YEAR(Customer.Date_of_Birth) - (DATE_FORMAT(CURRENT_DATE(), '%m%d') < DATE_FORMAT(Customer.Date_of_birth, '%m%d'))) as Age
FROM Customer 
LEFT JOIN E_mail ON Customer.Card_id=E_mail.Card_id
LEFT JOIN Phone_C ON Phone_C.Card_id=Customer.Card_id
