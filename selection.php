<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myDB";
// Create connection
$conn = new mysqli($servername, $username, $password,$database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET['ci'])){
    $ci=$_GET['ci'];
    $si=$_GET['si'];
    $sql="INSERT INTO studentcourse VALUES($si,$ci)";
    $result = $conn->query($sql);
    if($result){
        echo 'data updated';
    }
}


?>