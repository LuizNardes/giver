<?php

$conn = new mysqli('localhost','root','','customers');
mysqli_set_charset($conn,'utf8');

$arquivo = $_FILES['file']["tmp_name"];
$nome = $_FILES['file']["name"];

$ext = explode(".", $nome);

$extensao = end($ext);

if($extensao != 'csv'){
    echo "Extenão Inválida";
}else{

    $dados = [];

    $objeto = fopen($arquivo,'r');

    //PULANDO O CABEÇALHO
    fgetcsv($objeto,0,',');

    while($linha = fgetcsv($objeto,0,',')){
        $dados[] = $linha;
    }

 /*    echo "<pre>";
    print_r($dados);
 */
    foreach ($dados as $dado) {
        $first_name = $dado[1];
        $last_name = $dado[2];
        $email = $dado[3];
        $gender = $dado[4];
        $ip_address = $dado[5];
        $company = $dado[6];
        $city = $dado[7];
        $title = $dado[8];
        $website = $dado[9];

        $result = $conn->query("INSERT INTO customers (first_name,last_name,email,gender,ip_address,company,city,title,website)  VALUES ('$first_name','$last_name','$email','$gender','$ip_address',' $company','$city','$title','$website')");
    }
    
    if($result){
        echo 'Sucesso';
    }else{
        echo 'Erro ao inserir dados';
    } 
}
