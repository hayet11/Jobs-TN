<?php

$internaute = $_GET['internaute'];
require_once('config.php');
if(isset($_POST["submit"]) and  isset($internaute)){
  try {
   
    $titre = $_POST['titre'];
    $description = $_POST['desc'];
    $diplome = $_POST['diplomes'];
    $competences = implode('/', $_POST['competences']);
    $experience = $_POST['nbr'];
    $salaire = $_POST['sal'];

    $sql = "INSERT INTO offre (titre_offre, description, diplomes, competences, experience, salaire, code_registre)
            VALUES ('$titre', '$description', '$diplome', '$competences', $experience, $salaire, '$internaute')";
    $con->exec($sql);
    //echo "<span style='color:green;'>SUCCESS :</span> Le nouveau offre   a été créé avec succès.";
    echo '<script>alert("Le nouveau offre a été créé avec succès.");</script>';
    //header("Location: profil_emp.php?code_registre=$internaute");
    header("Location: offres_emp.php?internaute=$internaute");
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
  $con = null;
  //header("Location: profil.php?internaute=$internaute");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobsTN - Ajout d'offre</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="offre.css">
    <style>
        .profile-icon i{
            color: white;
            font-size: 32px;
        }
    </style>
</head>
<body>
    <!--header>
        <a href="index.html" class="Logo"><img src="images/logoprojet.png" alt=""></a>
        <nav>
            <ul class="navlist">
                <li class="active"><a href="home.html">Accueil</a></li>
                <li><a href="login.html">Se connecter</a></li>
                <li><a href="">S'inscrire</a>
                    <ul class="sub-menu-1">
                        <li><a href="signup_emp.html">Employeur</a></li>
                        <li><a href="signup_dem.html">Demandeur d'emploi</a></li>
                    </ul> 
                </li>
            </ul>
            
        </nav>
    </header-->
    
    <?php
  $internaute = $_GET['internaute'];
  echo ' <header style="height: 100px;">
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
  /*if(isset($_GET['internaute'])) {
    echo '<li><a href="profil.php?code_registre=' . urlencode($_GET['internaute']) . '">Profil</a></li>';
  }*/
  if(isset($_GET['internaute'])) {
    //echo '<li><a href="profil_emp.php?code_registre=' . urlencode($_GET['internaute']) . '">Profil</a></li>';
    echo '<li><a href="profil_emp.php?code_registre=' . urlencode($_GET['internaute']) . '"><i class="bx bxs-user-detail"></i>Profil</a></li>';
  }
  
  echo '</ul></nav></header>';
?>

    <div class="container">
        <form action="#" id="form" method="post"  action="" name="submit">
            <h3 align="center">Ajout d'une nouvelle offre</h3>
            <div class="info">
                <div class="input-box">
                    <label for="titre">Titre de l'offre</label><br>
                    <input type="text" name="titre" placeholder="Le titre de l'offre" id="titre" required>
                    <p id="err_titre"></p>
                </div>
                <div class="input-box">
                    <label for="desc">Description de l'offre</label><br>
                    <textarea name="desc" id="desc" cols="50" rows="2" required></textarea>
                </div>
                <label for="diplomes">Diplome demandé</label><br>
                <div class="choix">
                    <select name="diplomes" id="diplomes"  required>
                    <option value="licence">Licence </option>
                    <option value="maitrise">Maitrise</option>
                    <option value="mastere">Mastere</option>
                    <option value="doctorat">Doctorat</option>
                    </select>
                </div>
                <label for="competences">Competences demandées</label>
                <div class="comp">
                    <select name="competences[]" id="competences" multiple required>
                    <optgroup label="Langues">
                    <option value="arabe">Arabe </option>
                    <option value="Français">Français</option>
                    <option value="Anglais">Anglais</option>
                    </optgroup>
                    <optgroup label="programmation">
                    <option value="c">C</option>
                    <option value="java">JAva</option>
                    <option value="c#">C#</option>
                    <option value="HTML5">HTML5 </option>
                    <option value="CSS3">CCS3</option>
                    <option value="JavaScript">JavaScript</option>
                    <option value="PHP5">PHP5</option>
                    </optgroup>
                    </select>
                </div>

                <div class="input-box">
                    <br>
                    <label for="exper">Nombre d'années d'expérience</label><br>
                    <input type="number" placeholder="nombre d'anneés" id="nbr" name="nbr" required>
                    <p id="err_nbr"></p>
                </div>

                <div class="input-box ">
                    <label for="sal">Salaire proposé (DT)</label><br>
                    <input type="number" placeholder="Salaire proposé" id="sal" name="sal" required>
                    <p id="err_sal"></p>
                </div>
            </div>
            
            <div class="button">
                <input type="submit" value="Ajouter l'offre" name="submit">
            </div>
        </form>
    </div>
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
    <script src="offre.js"></script>
</body>
</html>