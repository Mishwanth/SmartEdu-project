<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "epitome244";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = $_POST['email'];
$password = $_POST['password'];
$query = "SELECT * FROM students WHERE Email = '$email' AND _Password = '$password'";
$result = $conn->query($query);
echo $result->num_rows;
if($result->num_rows > 0){
    header("Location: ai.html");
}else{
    echo "Login Failed";
}



$conn->close();
?>




       