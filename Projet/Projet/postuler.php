<?php
require('config.php');

$cin = $_GET['cin'];
$id_offre = $_GET['id_offre'];
$code_registre=$_GET['code_registre'];


$sql = "insert into candidature (cin, code_registre, id_offre) values (:cin, :code_registre, :id_offre)";
$stmt = $con->prepare($sql);
$stmt->bindParam(':cin', $cin);
$stmt->bindParam(':code_registre', $code_registre);
$stmt->bindParam(':id_offre', $id_offre);
$stmt->execute();

echo '<body  onload="window.location.href = \'offres_dmd.php?internaute=' . $cin .'\';"></body>';