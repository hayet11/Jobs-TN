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


 if(isset($_POST['creer_emp']))
 {
   $nom_emp=$_POST['nom_emp'];
   $mail_emp=$_POST['mail_emp'];
   $pseudo_emp=$_POST['pseudo_emp'];
   $pass_emp=$_POST['pass_emp'];
   $entreprise=$_POST['entreprise'];
   $code=$_POST['code'];

   //recherche si code ou bien pseudo sont deja utilisés
   $sql1=("select * from employeur where code_registre=:code or pseudo=:pseudo_emp");
   $stmt1=$con->prepare($sql1);
   $stmt1->bindParam(':code',$code);
   $stmt1->bindParam(':pseudo_emp',$pseudo_emp);
   $stmt1->execute();

   $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);


   if(!empty($result))
     die("Code de registre ou pseudo déjà utilisé!");  //popup!!
   else{

   $sql2=("insert into employeur values(:code,:nom_emp,:mail_emp,:pseudo_emp,:pass_emp,:entreprise)");
   $stmt2 = $con->prepare($sql2);
   $stmt2->bindParam(':code',$code);
   $stmt2->bindParam(':nom_emp',$nom_emp);
   $stmt2->bindParam(':mail_emp',$mail_emp);
   $stmt2->bindParam(':pseudo_emp',$pseudo_emp);
   $stmt2->bindParam(':pass_emp',$pass_emp);
   $stmt2->bindParam(':entreprise',$entreprise);

   $stmt2->execute();
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
  <br><br><br><br>
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
          <form class="form-box px-3" id="form1" method="post">
            <div class="form-input">
              <input type="text" name="nom_emp" id="nom" placeholder="Nom et Prenom" tabindex="10" required>
              <p id="err_nom"> </p>
            </div>
            <div class="form-input">
              <input type="email" name="mail_emp" id="mail" placeholder="Email" required>
              <p id="err_mail"> </p>
            </div>
            <div class="form-input">
                <input type="text" name="pseudo_emp" placeholder="Pseudo" required>
              </div>
              <div class="form-input">
                <input type="password" name="pass_emp" placeholder="Mot de passe" required>
              </div>
              <div class="form-input">
                <input type="text" name="entreprise" placeholder="Nom d'entreprise" required>
              </div>
              <div class="form-input">
                <input type="number" name="code" placeholder="Code de registre" required>
              </div>

            <div class="mb-3">
              <button type="submit" class="btn btn-block text-uppercase" name="creer_emp">
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
  <script src="sign_emp.js"></script>
</body>
</html>