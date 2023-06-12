<?php
require_once('config.php');

if(isset($_POST["Submit"])){
  $pseudo = $_POST["Pseudo"];
  $motdepasse = $_POST["motdepasse"];
  $table = $_POST["Staut"];
  
  /* on va rechercher si l'utilisateur existe ou pas*/
  /* pour les problémes si on utilise des caractéres spéciaux*/
  
  $stmt = $con->prepare("SELECT * FROM $table WHERE pseudo = :pseudo AND motdepasse = :motdepasse");
  $stmt->execute(array(':pseudo' => $pseudo, ':motdepasse' => $motdepasse));
  
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $nb = $stmt->rowCount();
  
  if ($nb == 1) {  
      if (strcmp($table, "demandeur") == 0) { 
          //cin 
          $cin = $row["cin"];
          header("Location: profil_dmd.php?internaute=" . urlencode($cin));
         
          
      }
      else {
          $code_registre = $row["code_registre"];
          header("Location: profil_emp.php?code_registre=" . urlencode($code_registre));
        
      }
  
      echo '<script>alert("Identifiants corrects")</script>';
  
       $code_registre = $row["code_registre"];
  
      //header("Location: profil.php?code_registre=" . urlencode($code_registre));
      
      exit;
  } 
  else {
     
      echo '<script>alert("Identifiants incorrects")</script>';
     
     
  }
  
  
  $stmt->closeCursor(); // close the result set
  
  }















?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="login.css">
   <link rel="stylesheet" href="table.css">
</head>
<body>
	<header>
		<a href="index.html" class="Logo"><img src="images/logoprojet.png" alt=""></a>
		<nav>
			<ul class="navlist">
				<li class="active"><a href="home.html">Acceuil</a></li>
				<li><a href="log.php">Se connecter</a>
					<div class="sub-menu-1">
						<ul>
							<li><a href="singup_emp.php">Employeur</a></li>
							<li><a href="singup_dem.php">Demandeur d'employe</a></li>
						</ul>
					</div>
				</li>
				<li><a href="">S'inscrire</a></li>
			</ul>
			
		</nav>
	</header>
	


    <div class="container">
        <div class="row px-3">
          <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
            <div class="img-left d-none d-md-flex">
                <img src="" alt="" >
            </div>
    
            <div class="card-body">
              <h4 class="title text-center mt-4">
                Se connecter
              </h4>
              <form class="form-box px-3" name="login_fomr" method="POST"  >
                <div class="form-input">
                  <span><i class="fa fa-envelope-o"></i></span>
                  <input type="text" name="Pseudo" placeholder="Pseudo" tabindex="10" required >
                </div>
                <div class="form-input">
                  <span><i class="fa fa-key"></i></span>
                  <input type="password" name="motdepasse"  id="password"placeholder="Mot de Passe " required  >
                </div>
    
                <div class="mb-3">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="cb1" name="">

                    <label class="custom-control-label" for="cb1" onclick="myFunction()">Afficher le mot de passe </label>
                  </div>
                </div>
                   
                <div class="form-check">
                  <input class="form-check-input" type="radio" value="demandeur" name="Staut" id="flexRadioDefault1" required>
                  <label class="form-check-label" for="flexRadioDefault1">
                    Demandeur d'emploi
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" value="employeur" name="Staut" id="flexRadioDefault2"  required >  
                  <label class="form-check-label" for="flexRadioDefault2">
                     Employeur
                  </label>
                </div>
                <div class="mb-3">
                  
                  
                  <button type="submit" class="btn btn-block text-uppercase" name="Submit">
                    Se connecter
                  </button>
                </div>

                <div class="text-center mb-3 titre">
                  Ou Se connecter avec
                </div>
    
                <div class="row mb-3">
                  <div class="col-4">
                    <a href="#" class="btn btn-block btn-social btn-facebook">
                      facebook
                    </a>
                  </div>
    
                  <div class="col-4">
                    <a href="#" class="btn btn-block btn-social btn-google">
                      google
                    </a>
                  </div>
    
                  <div class="col-4">
                    <a href="#" class="btn btn-block btn-social btn-twitter">
                      twitter
                    </a>
                  </div>
                </div>
    
                <hr class="my-4">
    
                <div class="text-center mb-2 titre-h">
                  Vous n'avez pas de compte? <br>
                  Inscrivez vous
    
                </div>
    
    
                <div class="row mb-3 text-center"> 
        
    
                  <div class="col-4">
                   
                   <a href="signupdem.php">Employeur</a>
                  </div>
                  <div class="col">
                 
                    <a href="signupdem.php">Chercheurs d'employes</a>
                    </a>
                  </div>
    
                </div>
    
              </form>
            </div>
          </div>
        </div>
      </div>

















    <footer>
        <section class="main">
            <article class="list">
                <h4>Navigation</h4>
                <ul>
                    <li><a href="home.html">Acceuil</a></li>
                    <li><a href="log.php">Se connecter</a></li>
                    <li><a href="singup_emp.php">S'inscrire</a></li>
                    
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
        <p>Copyright ©2023
             All rights reserved | Made  by <i class='bx bx-heart'></i>  Chabbouh  Hiba and Fkiri Hayet</p>
    </article>
    </footer>
<script src="home.js"></script>
<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>



</body>
</html>