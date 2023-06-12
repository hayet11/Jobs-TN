<?php  

$servername="localhost";
  $username="root";
  $password="";
  $dbname="projet_pweb";

  try{
    $con=new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  } catch(PDOException $e){
    die("probleme de connexion : ". $e->getMessage());
  }


?>

