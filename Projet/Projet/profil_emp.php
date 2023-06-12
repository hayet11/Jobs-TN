<?php  

 $servername="localhost";
 $username="root";
 $password="";
 $dbname="projetpweb";
 $code_registre = $_GET['code_registre'];
 try{
   $con=new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 } catch(PDOException $e){
   die("probleme de connexion : ". $e->getMessage());
 }


/* on va rechercher si l'utilisateur existe ou pas*/
/* pour les problémes si on utilise des caractéres spéciaux*/
$stmt = $con->prepare("SELECT * FROM employeur WHERE code_registre = :code_registre");
$stmt->bindParam(':code_registre', $code_registre);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
$nom = $row["nom"];
$email = $row["email"];
$code = $code_registre;

$stmt->closeCursor();
$con = null;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="profil.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>



    <style>
    header {
        width: 100%;
        top: 0;
        right: 0;
        z-index: 1000;
        position: fixed;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: transparent;
        padding: 20px 14%;
        transition: all .35s ease;
        background: linear-gradient(135deg, #5390D9, #7400B8);
    }

    .sub-menu-1 {
        display: none;
    }

    header ul li:hover .sub-menu-1 {
        display: block;
        position: absolute;
        background-color: #7400B8;
        margin-top: 15px;
        margin-left: -15px;
    }

    header ul li:hover .sub-menu-1 ul {
        display: block;
        margin: 10px;

    }

    header ul li:hover .sub-menu-1 ul li {
        width: 150px;
        padding: 10px;
        border-bottom: 1px dotted #fff;
        background: transparent;
        border-radius: 0;
        text-align: left;
    }

    header ul li:hover .sub-menu-1 ul li:last-child {

        border-bottom: none;
    }

    .navlist a:hover {
        color: #DB1F48;
    }

    .logo {
        font-size: 28px;
        font-weight: 700;
        letter-spacing: 1px;

    }

    .navlist {
        display: flex;
    }

    .navlist a {
        color: white;
        font-weight: 600;
        padding: 10px 25px;
        transition: all .36s ease;
    }

    .header-icons i {
        font-size: 32px;
        color: var(--text-color);
        margin-right: 20px;
        transition: all .36s ease;
    }
footer {
  background: linear-gradient(135deg,#5390D9,#7400B8);
}
    .main{
	display: flex;
	flex-wrap: wrap;
  padding: 20px;
 
}

 .list{
	 width: 25%;
	 flex-grow: 1;
 }
 .list h4{
	 font-size: 21px;
	 color:#004369;
	color: #bbbbbb;
	 margin-bottom: 30px;
	 position: relative;
 }
 .list h4::before{
	 content: "";
	 position: absolute;
	 height: 2px;
	 width: 60px;
	 left: 0;
	 bottom: -10px;
	 background-color: blueviolet;
	 background-color:   #DB1F48; 
	
 }
 .list ul li:not(last-child) {
	 margin-bottom: 16px;
 }
 .list ul li a{
	 color: #ffffffbf;
	  color: #bbbbbb;;
	 display: block;
	 transition: .3s;
 }
 .list ul li a:hover{
	 color: #DB1F48;
	 transform: translateX(14px);
 }
 .list .social a{
	 height: 40px;
	 width: 40px;
	 display: inline-flex;
	 align-items: center;
	 justify-content: center;
	 font-size: 21px;
	 border-radius: 15px;
	 transition: .3s;
	 margin-right: 10px;
	color: #bbbbbb;
 }
 .list .social a:hover{
	 transform: scale(1.1);
 }
 .end-text{
	 text-align: center;
	 padding-top: 90px;
	 color: #fff;
	
 }
 .end-text p{
	 color: var(--bg-color);
	 font-size: 14px;
	 letter-spacing: 2px;
 }
 .end-text i{
	 color: #DB1F48;
	 color: #5E60CE;
	 color: whitesmoke;
 
 } 

 footer form input{
    width: 400px;
    height: 45px;
    border-radius: 4px;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 40px;
    outline: none;
    border: none;
    }
    footer form button{
    background: transparent;
    border: 2px solid #fff;
    color: #fff;
    border-radius: 30px;
    padding: 10px 30px;
    font-size: 15px;
    cursor: pointer;
	margin-left: 132px;
    }

    h2 {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
    margin-top: 3%;
    padding: 6%;
}

label {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"] {
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    border: none;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 18px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #3e8e41;
}

form {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-top: 50px;
}

label {
  font-size: 18px;
  font-weight: bold;
  margin-right: 10px;
}

input[type="text"] {
  width: 300px;
  height: 40px;
  margin-bottom: 20px;
  padding: 10px;
  border-radius: 5px;
  border: none;
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
  font-size: 18px;
}

input[type="text"]:focus {
  outline: none;
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
}

input[type="submit"] {
  width: 200px;
  height: 50px;
  background-color: #3498db;
  color: #fff;
  border: none;
  border-radius: 5px;
  font-size: 18px;
  cursor: pointer;
  transition: all 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #2980b9;
}






    </style>





</head>

<body>

    <header style="height: 100px;">
        <a href="index.html" class="Logo"><img src="logo.png" alt="" width=100px></a>
        <nav>
            <ul class="navlist">
                <li class="active"><a href="home.html">Accueil</a></li>
                <li><a href="log.php">Se connecter</a></li>

                <li><a href="">S'inscrire</a>
                    <ul class="sub-menu-1">
                        <li><a href="singup_emp.php">Employeur</a></li>
                        <li><a href="signup_dem.php">Demandeur d'emploi</a></li>
                    </ul>
                </li>

            </ul>
        
        </nav>
    </header>

    <section class="main-content">
        <div class="side-bar">

            <div id="close-btn">
                <i class="fas fa-times"></i>
            </div>

            <div class="profile">
                <p class="role">Employeur</p>

            </div>

            <nav class="navbar">
                
                <!--a href="offres_emp.php?internaute=<?php echo $_GET['code_registre']; ?>"-->
                <a href="offres_emp.php?internaute=<?php echo $_GET['code_registre']; ?>">
                    <i class='bx bxs-briefcase'></i>
                    <span>Consultez vos offres</span>
                </a>

                <a href="forme_offre.php?internaute=<?php echo $_GET['code_registre']; ; ?>"><i
                        class='bx bxs-briefcase'></i><span>Ajouter une offre</span></a>
                <a href=""><i class='bx bxs-user-detail'></i><span> Voir les statistiques</span></a>
                <a href="home.php"><i class='bx bx-log-out'></i></i><span>Se déconnecter</span></a>

            </nav>

        </div>

        <div class="informations">

            <form>
                <table>
                    <tr>
                        <td><label for="code">Code:</label></td>
                        <td><input type="text" id="code" name="code" value="<?php echo $_GET['code_registre']; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td><label for="nom">Nom:</label></td>
                        <td><input type="text" id="nom" name="nom" value="<?php echo $row["nom"]; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td><label for="pseudo">Pseudo:</label></td>
                        <td><input type="text" id="pseudo" name="pseudo" value="<?php echo $row["pseudo"]; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="text" id="pseudo" name="pseudo" value="<?php echo $row["email"]; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td><label for="email">Nom entreprise:</label></td>
                        <td><input type="text" id="pseudo" name="pseudo" value="<?php echo $row["nom_entreprise"]; ?>" disabled></td>
                    </tr>
                </table>

            </form>








        </div>

    </section>

    <footer>
    <section class="main">
        <article class="list">
            <h4>Navigation</h4>
            <ul>
              <li><a href="home.html">Accueil</a></li>
              <li><a href="log.php">Se connecter</a></li>
              <li><a href="singup_emp.php">S'inscrire en tant qu'employeur</a></li>
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