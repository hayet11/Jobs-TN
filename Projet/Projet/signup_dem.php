<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
  
  $servername="localhost";
  $username="root";
  $password="";
  $dbname="projet_pweb";

  try{
    $con=new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  }

  catch(PDOException $e){
    die("probleme de connexion : ". $e->getMessage());
  }

  if(isset($_POST['creer_dmd']))
  {


    $nom=$_POST['nom'];
    $mail=$_POST['mail'];
    $pseudo=$_POST['pseudo'];
    $pass=$_POST['pass'];
    $cin=$_POST['cin'];
    
    
    //recherche si cin ou bien pseudo sont deja utilisés
    $sql1=("select * from demandeur where cin=:cin or pseudo=:pseudo");
    $stmt1=$con->prepare($sql1);
    $stmt1->bindParam(':cin',$cin);
    $stmt1->bindParam(':pseudo',$pseudo);
    $stmt1->execute();

    $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);


    if(!empty($result))
    {
      echo "<script>alert('cin ou pseudo deja utilisé!')</script>";

    }
    else{

    $sql=("insert into demandeur values(:cin,:nom,:mail,:pseudo,:pass)");
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':nom',$nom);
    $stmt->bindParam(':mail',$mail);
    $stmt->bindParam(':pseudo',$pseudo);
    $stmt->bindParam(':pass',$pass);
    $stmt->bindParam(':cin',$cin);
    $stmt->execute();

    echo "<script>alert('Votre compte est créé avec succès')</script>";
  }

  }


?> 


<!DOCTYPE html>
<html>
<head>
  <title>JobsTN sign-in</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <link rel="stylesheet" href="sign.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
       </li>
      </ul>
    </nav>
  </header>
  <div class="container">
    <div class="row px-3">
      <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
        <div class="img-left2 d-none d-md-flex">
            <img src="" alt="" >
        </div>

        <div class="card-body1">
          <h4 class="title text-center mt-4">
            Créer un Compte
          </h4>
          <form class="form-box px-3" id="form2" method="post">
            <div class="form-input">
              <input type="text" name="nom" id="nomp" placeholder="Nom et Prenom" tabindex="10" required>
              <p id="err_nomp"></p>
            </div>
            <div class="form-input">
              <input type="email" name="mail" id="email" placeholder="Email" required>
              <p id="err_email"></p>
            </div>
            <div class="form-input">
                <input type="text" name="pseudo" placeholder="Pseudo" required>
              </div>
              <div class="form-input">
                <input type="password" name="pass" placeholder="Mot de passe" required>
              </div>
              <div class="form-input">
                <input type="number" name="cin" placeholder="CIN" id="cin" required>
                <p id="err_cin"></p>
              </div>

            <div class="mb-3">
              <button type="submit" class="btn btn-block text-uppercase" name="creer_dmd">
                Créer mon compte
              </button>
            </div>

        

            <hr class="my-4">

            <div class="text-center mb-2">
              Vous avez déjà un compte?
              <a href="login.html">Se connecter</a>
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
  <script src="sign_dem.js"></script>
</body>
</html>