<?php

$conn = new mysqli('localhost','root','','customers');
mysqli_set_charset($conn,'utf8');


$i=0;
$consulta = $conn->query("SELECT * FROM customers");

if ($consulta->num_rows > 0) {
    // output data of each row
    while($row = $consulta->fetch_assoc()) {
        $data = array (
        'id' => $row['id'],
        'first_name' => $row['first_name'],
        'last_name' => $row['last_name'],
        'email' => $row['email'],
        'gender' => $row['gender'],
        'ip_address' => $row['ip_address'],
        'company' => $row['company'],
        'city' => $row['city'],
        'title' => $row['title'],
        'website' => $row['website'],
        );

        $dataArr[$i] = $data;
        $i++;
    }
} 

$conn->close();
echo json_encode($dataArr); 