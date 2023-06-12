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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="table.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
      .popup-container {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
}

.popup {
  background-color: white;
  margin: 10% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 500px;
  position: relative;
}

.btn-close {
  position: absolute;
  top: 10px;
  right: 10px;
  background-color: #f44336;
  color: white;
  border: none;
  cursor: pointer;
}

.btn-close:hover {
  background-color: #d32f2f;
}

.popup input{
  display: block;
  margin: 2%;
}


    </style>
</head>
<body>
<header style="height:100px;background: linear-gradient(135deg,#5390D9,#7400B8);" >
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
  <br><br><br><br><br>
    <table class="offres">

    <?php
    //fonction calcule score 
    function scoring_offre($comp_offre, $comp_demandeur, $salaire_propose, $diplome_offre, $diplome_demandeur) {
      $score = 0;
    
      // 5 points pour chaque compétence
      for ($i = 0; $i < count($comp_demandeur); $i++) {
        $test = false;
        $j = 0;
        while (!$test && $j < count($comp_offre)) {
          if (strtolower($comp_demandeur[$i]) == strtolower($comp_offre[$j])) {
            $score += 5;
            $test = true;
          } else {
            $j++;
          }
        }
      }
    
      // Ajout du salaire correspondant au score
      $score += ($salaire_propose / 100);
    
      // Si les diplômes ne correspondent pas, le score est nul
      if (!(in_array($diplome_offre, $diplome_demandeur))) {
        $score = 0;
      }
    
      return $score;
    }  

      //recuperer les offres
      $sql="select * from offre where id_offre not in(SELECT id_offre from candidature WHERE cin=:cin); "; 
      $stmt = $con->prepare($sql);
      $stmt->bindParam(':cin',$internaute);
      $stmt->execute();

      //recuperer les competences et diplomes du demandeur
      $sql2="select competences,diplomes from cv where cin=:cin";
      $stmt2=$con->prepare($sql2);
      $stmt2->bindParam(':cin',$internaute);
      $stmt2->execute();
      $tab2=$stmt2->fetch(PDO::FETCH_ASSOC);
      $comp_demandeur=explode("/", $tab2['competences']);
      $diplome_demandeur=explode("/", $tab2['diplomes']);


      //stocker les offres et leurs scores dans le tableau $tab
      $tab=array();
      $score=0;

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
        $comp_offre=explode("/", $row['competences']);
        $diplome_offre=$row['diplomes'];
        $score=scoring_offre($comp_offre,$comp_demandeur,$row['salaire'],$diplome_offre,$diplome_demandeur);
        array_push($row,$score);
        array_push($tab,$row);
      endwhile;

      $scores = array();
      foreach ($tab as $key => $T) {
          array_push($scores, $T['0']);
      }
      
      // Trier $tab selon score
      array_multisort($scores, SORT_DESC, $tab);
?>

    <tr>
      <th>Titre de l'offre</th>
      <th>Nom du diplome</th>
      <th>Experience</th>
      <th>Competences</th>
      <th>Description</th>
      <th>Salaire (DT)</th>
      <th>score</th>
      <th></th> 
    </tr>
    <?php 
    foreach ($tab as $T){ ?>
        <tr>
            <td><?= $T['titre_offre'] ?></td>
            <td><?= $T['diplomes'] ?></td>
            <td><?= $T['experience'] ?></td>
            <td><?= $T['competences'] ?></td>
            <td><?= $T['description'] ?></td>
            <td><?= $T['salaire'] ?></td>
            <td><?= $T['0'] ?></td>
 <?php      echo '<td><button class="btn btn-info" name="postuler"
             onclick="window.location.href = \'postuler.php?cin=' . $internaute . '&id_offre=' . $T['id_offre'] .'&code_registre=' . $T['code_registre'] . '\';">Postuler</button></td>';?>           
      </tr>

      <?php }?>
      </table>

      <footer>
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
      <script>
        function openPopup() {
        document.getElementById("popup-container").style.display = "block";
      }
      
      function closePopup() {
        document.getElementById("popup-container").style.display = "none";
      }
      </script>
</body>
</html>