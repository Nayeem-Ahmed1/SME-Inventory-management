<?php 

function dbQuery(string $query){

  $host = 'localhost';
  $port = 3308;
  $dbname = 'sme_inventory';
  $username = 'root';
  $password = '';
  
  $pdo = new PDO("mysql:host={$host};port={$port};dbname={$dbname}",$username,$password,[
    PDO::ATTR_ERRMODE =>  PDO::ERRMODE_EXCEPTION
    ]);
    
    // query must be provided
    
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }
  ?>