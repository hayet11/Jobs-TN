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
     <link rel="stylesheet" href="profil.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
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
           </li>
           <li><a href="#"> <i class="bx bxs-user-detail"></i> Profil</a></li>
            </ul>

          </nav>
      </header>
     
     <section class="main-content">
      <div class="side-bar">

        <div id="close-btn">
           <i class="fas fa-times"></i>
        </div>
      
        <div class="profile">
        <br><br><br><br><br><br>
        <?php  
          
          $stmt = $con->prepare("select photo FROM cv WHERE cin = :cin");
          $stmt->bindParam(":cin", $internaute);
          $stmt->execute();
          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          $stmt2 = $con->prepare("select * FROM demandeur WHERE cin = :cin");
          $stmt2->bindParam(":cin", $internaute);
          $stmt2->execute();
          $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
          echo '<img src="data:image/jpeg;base64,'.base64_encode($row['photo']).'" class="image" alt="photo">';
          ?>
           <h3 class="name"><?php echo $row2['nom']; ?></h3>
      
        </div>
     
        <nav class="navbar">
           <a href="cv.php?internaute=<?php echo $internaute; ?>"><i class='bx bxs-briefcase'></i></i><span>Remplir votre cv</span></a> 
           <a href="candidaturesd.php?internaute=<?php echo $internaute; ?>"><i class='bx bxs-briefcase'></i><span>Consultez vos candidatures</span></a>
           <a href="offres_dmd.php?internaute=<?php echo $internaute; ?>"><i class='bx bxs-briefcase'></i><span>Consultez les offres</span></a>
           <a href="home.html"><i class='bx bx-log-out'></i></i><span>Se déconnecter</span></a>
        </nav>
     
     </div>
     <div class="informations">
<br><br><br><br><br><br><br>
            <form>
                <table>
                    <tr>
                        <td><label for="cin">Cin :</label></td>
                        <td><input disabled type="text" id="cin" name="cin" value="<?php echo $_GET['internaute']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="nom">Nom:</label></td>
                        <td><input disabled type="text" id="nom" name="nom" value="<?php echo $row2['nom']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="pseudo">Pseudo:</label></td>
                        <td><input disabled type="text" id="pseudo" name="pseudo" value="<?php echo $row2['pseudo']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input disabled type="text" id="email" name="email" value="<?php echo $row2['email']; ?>"></td>
                    </tr>
                </table>

            </form>
        </div>

    </section>

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