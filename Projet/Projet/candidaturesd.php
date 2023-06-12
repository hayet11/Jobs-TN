<?php 
require('config.php'); 
$internaute = $_GET['internaute'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="candidatured.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<header style="height:100px; background: linear-gradient(135deg,#5390D9,#7400B8); " >
    <a href="home.html" class="Logo"><img src="logo.png" alt="" width="100px"></a>
    <nav>
      <ul class="navlist">
        <li class="active"><a href="home.html">Accueil</a></li>
        <li><a href="log.php">Se connecter</a></li>
   
        <li><a href="">S'inscrire</a>
              <ul class="sub-menu-1">
              <li><a href="signup_emp.php">Employeur</a></li>
              <li><a href="signup_dem.php">Demandeur d'emploi</a></li>
              </ul> 
              <li><a href="profil_dmd.php?internaute=<?php echo $internaute; ?>"> <i class="bx bxs-user-detail"></i> Profil</a></li>

       </li>
      
        </ul>
      </nav>
  </header>
      <br><br><br>
        <?php
      $sql="select * from candidature where cin=:internaute"; 
      $stmt=$con->prepare($sql);
      $stmt->bindParam(':internaute',$internaute);
      $stmt->execute();
      ?>
  
       <table class="table ">
        <thead class="table-header">
          <tr >
            <th scope="col" >Nom du poste</th>
            <th scope="col">Nom de la Societé</th>
            <th scope="col">Staut</th>
          </tr>
        </thead>
        <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : 
        //recuperer le titre de l'offre
          $sql_titre="select titre_offre from offre where id_offre= :id";
          $stmt_titre=$con->prepare($sql_titre);
          $stmt_titre->bindParam(':id',$row['id_offre']);
          $stmt_titre->execute();
          $titre_offre = $stmt_titre->fetchColumn();
          //recuperer le nom de l'entreprise
          $sql_entreprise="select nom_entreprise from employeur where code_registre= :code";
          $stmt_entreprise=$con->prepare($sql_entreprise);
          $stmt_entreprise->bindParam(':code',$row['code_registre']);
          $stmt_entreprise->execute();
          $entreprise = $stmt_entreprise->fetchColumn();
          //etat de la candidature:
          if($row['etat']==-1)
           { $etat="Refusé"; 
              $col="red";
              $icon="bx bx-check refuse";
           }
          else if($row['etat']==1){
            $etat="Accepté";
            $col="green";
            $icon="bx bx-check accepte";
          }
          else
          {
            $etat="En attente";
            $col="orange";
            $icon="bx bx-time-five attente";
          }
          ?>
          <tr>
            <td><?= $titre_offre?></td>
            <td><?= $entreprise?></td>
            <td style="color:<?= $col?>;"><i class='<?= $icon?>'><?= $etat?></i></td>
        </tr>
    <?php endwhile; ?>
      </table>

      <footer style="background: linear-gradient(135deg,#5390D9,#7400B8);">
        <section class="main">
            <article class="list">
                <h4>Navigation</h4>
                <ul>
                  <li><a href="home.html">Accueil</a></li>
                  <li><a href="log.php">Se connecter</a></li>
                  <li><a href="signup_emp.php">S'inscrire en tant qu'employeur</a></li>
                  <li><a href="signup_dem.php">S'inscrire en tant que demandeur</a></li>
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