


<?php  


require_once('config.php');
$cin = $_GET['cin'];
$id_offre = $_GET['id_offre'];
//n'afficher que les offres au cours d'evaluation
try {
   
    // Retrieve data from database
    // récupérer CIN des candidatures pour cette offre
    $sql = "UPDATE candidature SET etat=1 WHERE id_offre=$id_offre AND cin='$cin'";
     

    $stmt = $con->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {

        echo '<div style="background-color: #f2f2f2; padding: 20px;">
        <h1 style="text-align: center; color: #555;">Candidature acceptée</h1>
        <div style="text-align: center;">
          <a href="javascript:history.go(-1)" style="color: #fff; background-color: #4CAF50; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Retourner à la page précédente</a>
        </div>
      </div>';
      
      


    } else {
        echo '<div style="background-color: #f2f2f2; padding: 20px;">
        <h1 style="text-align: center; color: #555;">Etat non modifiée</h1>
        <div style="text-align: center;">
          <a href="javascript:history.go(-1)" style="color: #fff; background-color: #4CAF50; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Retourner à la page précédente</a>
        </div>
      </div>';
      echo "<script>alert('Etat non modifié');</script>";

    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

 ?>
       
         