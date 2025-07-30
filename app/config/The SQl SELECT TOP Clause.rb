The SQl SELECT TOP Clause

The SELECT TOP Clause is used to specify the number of records to return
The SELECT TOP Clause is useful on large talbes with thousands   of records. Returning
a large  number of records

Example
 SELECT TOP 3 * FROM Customers;

 Note : Not all database systems support the  SELECT TOP clause. MYSQL support the LIMIT clause to select 
  limited number of records, while Oracle uses FETCH FIRST n ROWS ONLY and ROWNUM
  
  SQL Server / MS Access
  SELECT TOP number|percent column_name(s)
  FROM table_name
  WHERE condition; 

  MySQL Syntax:

SELECT column_name(s)
FROM table_name
WHERE condition
LIMIT number;

Oracle 12 Syntax:

SELECT column_name(s)
FROM table_name
ORDER BY column_name(s)
FETCH FIRST number ROWS ONLY;


ADD the ORDER BY Keyword

Add the ORDER  BY Keyword when you  want  to sort the result, and return the first 3 records of the sorted result
For SQL Server and MS Access;

SELECT TOP 3 * FROM [bambi-bmi].[dbo].customer
ORDER BY CustName DESC;


SELECT TOP 3 * FROM [bambi-bmi].[dbo].customer
ORDER BY CustName ASC;









SQL Aggregate Functions

An Aggregate function is a function that performs a calculation on a set of values, and returns a single value.
(Fungsi Agregat adalah fungsi yang melakukan penghitungan pada sekumpulan nilai, dan mengembalikan satu nilai.)

Aggregate functions are often used with the GROUP BY clause of the SELECT statement. The GROUP BY clause splits the result-set into groups of values and the aggregate function can be used to return a single value for each group.

(Fungsi agregat sering digunakan dengan klausa GROUP BY pada pernyataan SELECT. Klausa GROUP BY membagi kumpulan hasil menjadi beberapa kelompok nilai dan fungsi agregat dapat digunakan untuk mengembalikan satu nilai untuk setiap kelompok.)

The most commonly userd SQL aggregate functions are:
(Fungsi agregat SQL yang paling umum digunakan adalah:)
-MIN() - returns the smallest value within the selected column
-MAX() - returns the largest value within the selected column
-COUNT() - returns the number of rows in a set
-SUM() - returns the total sum of a numerical column
-AVG() - returns the average value of a numerical column

Aggregate functions ignore null values (except for COUNT()).

We will go through the aggregate functions above in the next chapters.
(Kita akan membahas fungsi agregat di atas pada bab berikutnya.)



SELF JOIN
A self join is a regular join, but the table is joined with itsellf
Self Join Syntax

SELECT column_name(s)
FROM table1 T1, table1 T2
WHERE condition;

Self join  Example 

SELECT A.CustomerName AS CustomerName1, B.CustomerName AS CustomerName2, A.City
FROM Customers A, Customers B
WHERE A.CustomerID <> B.CustomerID
AND A.City = B.City
ORDER BY A.City;


SQL group by statement

GROUP BY statement

The  GROUP BY statement groups rows  that have the same  values into summary rows, like "find the number of customer in each country"
(Pernyataan GROUP BY mengelompokkan baris yang memiliki nilai yang sama ke dalam baris ringkasan, seperti "temukan jumlah pelanggan di setiap negara")
The GROUP BY statement is often  used with aggregate function(COUNT(), MAX(), MIN(), SUM(), AVG()) to group the result-set by one or more columns.
(Pernyataan GROUP BY sering digunakan dengan fungsi agregat (COUNT(), MAX(), MIN(), SUM(), AVG()) untuk mengelompokkan kumpulan hasil berdasarkan satu atau lebih kolom.)

group by examples
The following SQL statement lists the number of customer in each country
(Pernyataan SQL berikut mencantumkan jumlah pelanggan di setiap negara)


HAVING Clause
The Haviing clause was added to SQL because the WHERE  Keyword cannot be used with aggregate functions.
(Klausa Haviing ditambahkan ke SQL karena Kata Kunci WHERE tidak dapat digunakan dengan fungsi agregat.)

syntax
SELECT column_name(s)
FROM table_name
WHERE condition
GROUP BY column_name(s)
HAVING condition
ORDER BY column_name(s);

Having examples
The following SQL statement  lists the number  of customers in each country. Only include  countries with more than  5 customers:
(Pernyataan SQL berikut mencantumkan jumlah pelanggan di setiap negara. Hanya sertakan negara dengan lebih dari 5 pelanggan:)

Example

SELECT COUNT(CustomerID), Country
FROM Customers
GROUP BY Country
HAVING COUNT(CustomerID) > 5;

SELECT CustomerID FROM [bambi-bmi].[dbo].customer
GROUP BY CustomerID
HAVING COUNT(CustomerID) = 1


More Having Example
The following SQL statement lists the employees that have registered more than 10 orders:
(Pernyataan SQL berikut mencantumkan karyawan yang telah mendaftarkan lebih dari 10 pesanan:)
SELECT Employees.LastName, COUNT(Orders.OrderID) AS NumberOfOrders
FROM (Orders
INNER JOIN Employees ON Orders.EmployeeID = Employees.EmployeeID)
GROUP BY LastName
HAVING COUNT(Orders.OrderID) > 10;


Tip: Make sure you have admin privilege before dropping  any database is dropped, 
you can check it in the list of databses with the following SQL command: SHOW DATABSES;

DROP database Example

