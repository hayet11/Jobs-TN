





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobsTN - Liste des offres</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="table.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  
      <?php
  $internaute = $_GET['internaute'];
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
 
   if(isset($_GET['internaute'])) {
   
    echo '<li><a href="profil_emp.php?code_registre=' . urlencode($_GET['internaute']) . '"><i class="bx bxs-user-detail"></i></a></li>';
  }
  echo '</ul></nav></header>';
?>
      <br><br><br><br><br>
      <table class="offres">
        <tr>
            <th>Titre de l'offre</th>
            <th>Nom du diplome</th>
            <th>Experience</th>
            <th>Competences</th>
            <th>Description</th>
            <th>Salaire (DT)</th>
            <th></th>
          
            <th></th>
        </tr>
      
        
          <?php 
      
      require_once('config.php');

try {


$internaute = $_GET['internaute'];

// Retrieve data from database
$sql = "SELECT * FROM offre WHERE code_registre='$internaute'";
$stmt = $con->query($sql);

// Generate HTML code for table rows
if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $row["titre_offre"] . "</td>";
        echo "<td>" . $row["diplomes"] . "</td>";
        echo "<td>" . $row["experience"] . "</td>";
        echo "<td>" . $row["competences"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . $row["salaire"] . "</td>";
       
       echo "<td><a href='emp_candidature.php?id_offre={$row['id_offre']}&code_registre={$row['code_registre']}'>Candidatures</a></td>";
       
             echo '<td><button class="btn btn-danger" name="Refuser"
          onclick="if(confirm(\'Etes-vous sur(e) de vouloir supprimer cette offre  ?\')) {
              window.location.href = \'supprimer_emp_offre.php?id_offre=' . $row['id_offre'] . '&internaute=' . $_GET['internaute'] . '\';
              window.location.reload();
          }">Supprimer</button></td>';



        echo "</tr>";
    }
} else {
    echo "Aucune offre d'emploi trouvée.";
   
}
echo "<a href='forme_offre.php?internaute=$internaute' id='ajout'>Ajouter une nouvelle offre</a>";


} catch(PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}

// Close database connection
$con = null;



           ?>


      </table>
     
      <br><br>
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