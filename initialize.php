 <?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IPProject";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?> 
 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "IPProject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE Ad (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
CompName VARCHAR(60) NOT NULL,
CompDesc VARCHAR(300) NOT NULL,
Email VARCHAR(60) NOT NULL,
Address VARCHAR(200) NOT NULL,
Telephone VARCHAR(10) NOT NULL,
Mobile VARCHAR(10) NOT NULL,
Category VARCHAR(100) NOT NULL,
userPic VARCHAR(200),
userid int(8),
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Ad created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?> 

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "IPProject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table

$sql="CREATE TABLE users (
  id int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(30) NOT NULL,
  email varchar(60) NOT NULL UNIQUE KEY,
  password varchar(40) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?> 

 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "IPProject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Ad(CompName,CompDesc,Email,Address,Telephone,Mobile,Category,userPic,reg_date) VALUES('KFC', 'World famous chicken', 'kfc@gmail.com','44 West Street,Durban','0312819821','0849280981','Food and Beverage','kfc.jpeg',NOW());";
$sql .= "INSERT INTO Ad(CompName,CompDesc,Email,Address,Telephone,Mobile,Category,userPic,reg_date) VALUES('Uber', 'World class Transportation at an affordable price', 'uber@yahoo.com','44 East Street,Cape Town','0332819521','0849550985','Transportation','uber.jpg',NOW());";
$sql .= "INSERT INTO Ad(CompName,CompDesc,Email,Address,Telephone,Mobile,Category,userPic,reg_date) VALUES('Nandos', 'Better than Wandos', 'nando@mweb.com','253 Fox Street, Johannesburg, South Africa','0322819561','0819255085','Food and Beverage','nandos.png',NOW());";
$sql .= "INSERT INTO Ad(CompName,CompDesc,Email,Address,Telephone,Mobile,Category,reg_date) VALUES('Apple Property', 'Helping you find your new home', 'apple@notfruit.com','68 Rivonia Road, Sandton, South Africa','0232819521','0349550985','Other',NOW());";
$sql .= "INSERT INTO Ad(CompName,CompDesc,Email,Address,Telephone,Mobile,Category,userPic,reg_date) VALUES('BuildIt', 'Construction', 'built@gmail.com','54 West Drive,PE','0312814822','0799280981','Construction and Contractors','buildit.jpg',NOW())";

if ($conn->multi_query($sql) === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 
 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "IPProject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO users(id,name,email,password) VALUES('1', 'Vishay', 'vishaysukhoo.vs@gmail.com','@Vishay1#');";
$sql .="INSERT INTO users(id,name,email,password) VALUES('2', 'Test', 'test@gmail.com','@Test1#');";
$sql .="INSERT INTO users(id,name,email,password) VALUES('3', 'Test2', 'test2@gmail.com','@Test2#');";


if ($conn->multi_query($sql) === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 