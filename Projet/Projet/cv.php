<?php
require('config.php');

$internaute = $_GET['internaute'];


if(isset($_POST['envoyer'])){

    $nom=$_POST['nom'];
    $nais=$_POST['nais'];
    $mail=$_POST['mail'];
    $adresse=$_POST['adresse'];
    $tel=$_POST['tel'];
    $etatCivil=$_POST['etatCivil'];
    $competences_str = implode('/', $_POST['competences']);
    $diplomes_str = implode('/', $_POST['diplomes']);
    $universite=$_POST['universite'];
    $experience=$_POST['experience'];
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo = file_get_contents($_FILES['photo']['tmp_name']);
        // Enregistrement de la photo dans la base de données
    } 

    $sql1="select * from cv where cin=:cin";
    $stmt1=$con->prepare($sql1);
    $stmt1->bindParam(':cin',$internaute);
    $stmt1->execute();
    $row = $stmt1->fetch(PDO::FETCH_ASSOC);
    $nb = $stmt1->rowCount();
    if($nb>0)
    {
        $sql2=("update cv set photo= :photo,date_naissance= :nais,etat_civil= :etatCivil,adresse= :adresse,diplomes= :diplomes,competences= :competences,universite= :universite,experience= :experience,telephone= :telephone where cin=:cin");
        $stmt2 = $con->prepare($sql2);
        $stmt2->bindParam(':cin',$internaute,PDO::PARAM_LOB);
        $stmt2->bindParam(':photo',$photo,PDO::PARAM_LOB);
        $stmt2->bindParam(':nais',$nais);
        $stmt2->bindParam(':etatCivil',$etatCivil);
        $stmt2->bindParam(':nais',$nais);
        $stmt2->bindParam(':adresse',$adresse);
        $stmt2->bindParam(':diplomes',$diplomes_str);
        $stmt2->bindParam(':competences',$competences_str);
        $stmt2->bindParam(':universite',$universite);
        $stmt2->bindParam(':experience',$experience);
        $stmt2->bindParam(':telephone',$tel);
        $stmt2->execute();
    }
    else
    {
        $sql=("insert into cv values(:cin,:photo,:nais,:etatCivil,:adresse,:diplomes,:competences,:universite,:experience,:telephone)");
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':cin',$internaute);
        $stmt->bindParam(':photo',$photo,PDO::PARAM_LOB);
        $stmt->bindParam(':nais',$nais);
        $stmt->bindParam(':etatCivil',$etatCivil);
        $stmt->bindParam(':nais',$nais);
        $stmt->bindParam(':adresse',$adresse);
        $stmt->bindParam(':diplomes',$diplomes_str);
        $stmt->bindParam(':competences',$competences_str);
        $stmt->bindParam(':universite',$universite);
        $stmt->bindParam(':experience',$experience);
        $stmt->bindParam(':telephone',$tel);
        $stmt->execute();
    }

    echo '<script>alert("Vos données ont été bien enregistrées")</script>';
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobsTN CV</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="cv.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
<header style="height:100px" >
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
    <section class="container">
        <form id="form" method="post" enctype="multipart/form-data">
        <?php
      ?>
            <div class="title">Informations générales</div>
            <div class="info">
                <div class="input-box">
                    <label for="nom">Nom et Prenom</label>
                    <input type="text" name="nom" placeholder="Donnez votre nom" id="nom" required>
                    <p id="err_nom"></p>
                </div>
                <div class="input-box">
                    <label for="nais">Date de naissance</label>
                    <input type="date" name="nais" required id="dat_nais">
                    <p id="err_date"></p>
                </div>
                <div class="input-box">
                    <label for="mail">E-mail</label>
                    <input id="mail" type="email" name="mail" placeholder="Donnez votre email" required >
                    <p id="err_mail"></p>
                </div>
                <div class="input-box">
                    <label for="adresse">Adresse</label>
                    <input type="text" name="adresse" placeholder="Donnez votre adresse" required>
                </div>
                <div class="input-box">
                    <label for="num">Numéro de Tel</label>
                    <input type="number" name="tel" placeholder="Donnez votre numero" required>
                </div>
                <div class="input-box">
                    <label for="photo">Photo d'identité</label>
                    <input type="file" name="photo" class="file" required>
                </div>
                <div class="etat">
                    <label for="etatCivil">Etat civil</label><br>
                    <div class="choix">
                    <input type="radio" name="etatCivil" value="celibataire" id="celibataire" required /> <label for="celibataire">célibataire</label><br>
                    <input type="radio" name="etatCivil" value="marié" id="marie" /> <label for="marie">marié</label><br>
                    <input type="radio" name="etatCivil" value="divorcé" id="divorce" /> <label for="divorce">divorcé</label><br>
                    <input type="radio" name="etatCivil" value="veuf" id="veuf" /> <label for="veuf">veuf</label><br>
                </div>
                </div>
            </div>
            <br>
            <div class="title">Cursus et compétences</div>
            
                <div class="curs liste">
                <label for="diplomes">Cochez vos diplomes:</label><br>
                    <div class="dip">
                        <select name="diplomes[]" id="diplomes" multiple required>
                        <option value="licence">Licence </option>
                        <option value="maitrise">Maîtrise</option>
                        <option value="mastere">Mastere</option>
                        <option value="doctorat">Doctorat </option>
                        </select>
                    </div>
                    <div class="comp liste">
                    <label for="competences">Compétences </label><br>
                    <div class="choix">
                        <select name="competences[]" id="competences" multiple required>
                        <optgroup label="Langues">
                        <option value="Arabe">Arabe </option>
                        <option value="Français">Français</option>
                        <option value="Anglais">Anglais</option>
                        </optgroup>
                        <optgroup label="programmation web">
                        <option value="HTML5">HTML5 </option>
                        <option value="CSS3">CCS3</option>
                        <option value="JavaScript">JavaScript</option>
                        <option value="PHP5">PHP5</option>
                        </optgroup>
                        </select>
                    </div>
                </div>
                <div class="univ liste">
                    <label for="universite">Université</label><br>
                    <div class="choix">
                        <select name="universite" id="universite" >
                        <option value="Tunis">Tunis </option>
                        <option value="Manar">Manar</option>
                        <option value="carthage">Carthage</option>
                        <option value="sousse">Sousse</option>
                        <option value="sfax">Sfax</option>
                        <option value="Jendouba">Jendouba</option>
                        <option value="kairouan">Kairouan</option>
                        <option value="Gabes">Gabes</option>
                        </select>
                    </div>
                </div>
                <div class="input-box liste">
                    <br>
                    <label for="exper">Nombre d'années d'expérience</label>
                    <input type="number" name="experience" placeholder="nombre d'anneés" id="nbr" required>
                    <p id="err_nbr"></p>
                </div>
                </div>
                <div class="mb-3">
              <button type="submit" class="btn btn-block text-uppercase" name="envoyer">
                Envoyer CV
              </button>
            </div>
        </form>
    </section>   
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
</body>
<script src="cv.js"></script>
</html>