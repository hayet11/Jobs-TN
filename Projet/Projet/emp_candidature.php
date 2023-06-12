<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobsTN - Liste de candidatures</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
   
      <?php
  $internaute = $_GET['code_registre'];
  echo '
  <header style="height: 100px;">
  <a href="index.html" class="Logo"><img src="logo.png" alt="" width=100px></a>
       <nav>
        <ul class="navlist">
          <li class="active"><a href="home.html">Accueil</a></li>
          <li><a href="log.php">Se connecter</a></li>
     
          <li><a href="">S\'inscrire</a>
                <ul class="sub-menu-1">
                <li><a href="singup_emp.php">Employeur</a></li>
                <li><a href="singup_dem.php">Demandeur d\'emploi</a></li>
                </ul> 
         </li>';
 
  if(isset($_GET['code_registre'])) {
    echo '<li><a href="profil_emp.php?code_registre=' . urlencode($_GET['code_registre']) . '"><i class="bx bxs-user-detail"></i></a></li>';

  }
  echo '</ul></nav></header>';
?>


      <br><br><br><br><br>
       
        <?php
         // Connect to database
require_once('config.php');
require('scoredem.php');
    
$id_offre = $_GET['id_offre'];
try {


// Prepare SQL query to retrieve data

$sql = "SELECT demandeur.nom as nom, demandeur.cin as cin, demandeur.email as email,cv.diplomes as diplome_dem,offre.diplomes as  diplome_em,cv.universite as universite_dem,cv.competences as competences_dem,offre.competences as competences_em,cv.experience as exeperience_dem,offre.experience as experience_em,candidature.etat as etat
              FROM candidature 
              JOIN demandeur ON candidature.cin = demandeur.cin 
              JOIN cv ON cv.cin = demandeur.cin 
            JOIN offre ON offre.id_offre = candidature.id_offre 
              WHERE candidature.id_offre =$id_offre ";
$stmt = $con->prepare($sql);
$stmt->execute();

// Create empty matrix
$matrix = array();

// Fetch data and store in matrix
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
   
// Calculate score for current row
$score = scoring_demandeur($row['competences_em'], $row['competences_dem'], $row['experience_em'], $row['exeperience_dem'], $row['diplome_em'], $row['diplome_dem']);

// Add score to row
$row['score'] = $score;

// Add row to matrix
$matrix[] = $row;
}

// Sort matrix by score (descending)
usort($matrix, function ($a, $b) {
return $b['score'] - $a['score'];
});


// Display matrix in HTML table
echo "<table class=offres>";
echo "<tr><th>Nom</th><th>CIN</th><th>E-mail</th><th>Diplomes</th><th>Université</th><th>Competences</th><th>Experience(ans)</th><th>Score</th><th></th><th></th><th></th></tr>";
foreach ($matrix as $row) {
    if($row['etat']==0)
    {
echo "<tr>";
echo "<td>" . $row['nom'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['cin'] . "</td>";
echo "<td>" . $row['diplome_dem'] . "</td>";
echo "<td>" . $row['universite_dem'] . "</td>";
echo "<td>" . $row['competences_dem'] . "</td>";
echo "<td>" . $row['exeperience_dem'] . "</td>";
echo "<td>" . $row['score'] . "</td>";
echo '<td><button class="btn btn-success" name="Accepter"
onclick="if(confirm(\'Are you sure you want to accept this job offer?\')) {
    window.location.href = \'accepter.php?cin=' . $row['cin'] . '&id_offre=' . $id_offre . '\';
    
}">Accepter</button></td>';
           
echo '<td><button class="btn btn-danger" name="Refuser"
onclick="if(confirm(\'Are you sure you want to delete this job offer?\')) {
    window.location.href = \'refuser.php?cin=' . $row['cin'] . '&id_offre=' . $id_offre. '\';

}">Refuser</button></td>';
echo '<td><button class="btn btn-secondary" name="voirCV" onclick="if(confirm(\'Esct ce que vous voulez voir le CV?\')) { window.location.href = \'cv_dem.php?cin=' . $row['cin'] . '&id_offre=' . $id_offre . '&code_registre=' . $_GET['code_registre'] . '\'; }">Voir CV</button></td>';
echo "</tr>";


}
}
echo "</table>";
}
catch(PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}

?>

  <footer>
    <section class="main">
        <article class="list">
            <h4>Navigation</h4>
            <ul>
                <li><a href="home.html">Accueil</a></li>
                <li><a href="log.php">Se connecter</a></li>
                <li><a href="singup_emp.php">S'inscrire en tant qu'employeur</a></li>
                <li><a href="singup_dem.php">S'inscrire en tant que demandeur</a></li>
            </ul>
        </article>

        <article class="list">
            <h4>Newsletter</h4>
             
             <form>
       <input type="text" placeholder="adresse mail" required>
          <button type="submit">Inscrivez vous</button>
      </form>
        </article>

    <article class="list">
        <h4>Connectez-vous</h4>
        <div class="social">
            <a href=""><i class='bx bxl-facebook' ></i></a>
            <a href=""><i class='bx bxl-instagram-alt' ></i></a>
            <a href=""><i class='bx bxl-twitter' ></i></a>
        </div>
    </article>
    
    </section>

<article class="end-text">
    <p>Copyright ©2023 All rights reserved | Made  by <i class='bx bx-heart'></i>  Chabbouh  Hiba and Fkiri Hayet</p>
</article>    
</footer>
</body>
</html>