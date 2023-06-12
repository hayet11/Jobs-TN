<?php
if(isset($_POST['generate_pdf'])) {
  require_once 'fpdf185/fpdf.php';
  
  // Récupérer les données du formulaire
  $nom = $_POST["nomF"];
  $date_naissance =  $_POST["dateF"];
  $email =  $_POST["emailF"];
  $etat_civil =  $_POST["etatF"];
  $cin =  $_POST["cinF"];
  $niveau_etudes =  $_POST["diplomeF"];
  $competences = $_POST["competenceF"];
  $annees_experience =  $_POST["experiencesF"];
  
  // Générer le CV au format PDF
  $pdf = new FPDF();
  $pdf->SetTitle("CV de $nom");
  
  // Ajouter une page et définir les marges
  $pdf->AddPage();
  $pdf->SetMargins(20, 20, 20);
  
  // Ajouter un titre avec une couleur de texte
  $pdf->SetFont('Arial', 'B', 24);
  $pdf->SetTextColor(0, 128, 128);
  $pdf->Cell(0, 20, "CV de  $nom", 0, 1, 'C');
  $pdf->Ln(20);
  
  // Ajouter les informations personnelles
  $pdf->SetFont('Arial', 'B', 16);
  $pdf->SetTextColor(51, 51, 153);
  $pdf->Cell(60, 10,'Date de naissance :   ');
  $pdf->SetFont('Arial', '', 16);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->Cell(0, 10, $date_naissance);
  $pdf->Ln();
  
  $pdf->SetFont('Arial', 'B', 16);
  $pdf->SetTextColor(51, 51, 153);
  $pdf->Cell(40, 10, 'E-mail :  ');
  $pdf->SetFont('Arial', '', 16);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->Cell(0, 10, $email);
  $pdf->Ln();
  
  $pdf->SetFont('Arial', 'B', 16);
  $pdf->SetTextColor(51, 51, 153);
  $pdf->Cell(40, 10, 'Etat Civil :  ');
  $pdf->SetFont('Arial', '', 16);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->Cell(0, 10, $etat_civil);
  $pdf->Ln();
  
  $pdf->SetFont('Arial', 'B', 16);
  $pdf->SetTextColor(51, 51, 153);
  $pdf->Cell(40, 10, 'CIN :   ');
  $pdf->SetFont('Arial', '', 16);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->Cell(0, 10, $cin);
  $pdf->Ln();
  
  $pdf->SetFont('Arial', 'B', 16);
  $pdf->SetTextColor(51, 51, 153);
  $pdf->Cell(40, 10, 'Niveau : ');
  $pdf->SetFont('Arial', '', 16);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->Cell(0, 10, $niveau_etudes);
  $pdf->Ln(20);
  
  // Ajouter les compétences avec une couleur de texte
  $pdf->SetFont('Arial', 'B', 16);
  $pdf->SetTextColor(51, 51, 153);
  $pdf->Cell(0, 10, 'Competences :');
  $pdf->Ln();
  
  $pdf->SetFont('Arial', '', 16);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->MultiCell(0, 8, $competences);
  $pdf->Ln();
  
  // Ajouter les années d'expérience avec une couleur de texte
  $pdf->SetFont('Arial', 'B', 16);
  $pdf->SetTextColor(51, 51, 153);
  $pdf->Cell(0, 8, 'Experience :  ');
  $pdf->SetFont('Arial', '', 16);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->Cell(0, 8, $annees_experience);
  $pdf->Ln();
  
  // Afficher le PDF
  $pdf->Output();
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobsTN - Liste de candidatures</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="cv.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
   
      <?php
  $internaute = $_GET['code_registre'];
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
 
  if(isset($_GET['code_registre'])) {
    echo '<li><a href="profil_emp.php?code_registre=' . urlencode($_GET['code_registre']) . '"><i class="bx bxs-user-detail"></i> Profil</a></li>';

  }
  echo '</ul></nav></header>';
?>
 <br><br><br><br><br>
       
 <?php
// Connect to database
require_once('config.php');

// Prepare SQL query to retrieve data
$cin = $_GET["cin"];
$sql = "SELECT demandeur.nom as nom, demandeur.cin as cin, demandeur.email as email,cv.diplomes as diplome_dem,cv.universite as universite_dem,cv.experience as exeperience_dem,cv.date_naissance as  date_naissance,cv.etat_civil as etat,cv.competences as competences
              FROM candidature 
              JOIN demandeur ON candidature.cin = demandeur.cin 
              JOIN cv ON cv.cin = :cin";
$stmt = $con->prepare($sql);
$stmt->bindParam(':cin', $cin);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<section class="container">
  <form id="form" method="post" action="">
    <div class="title" style="font-size: 50px;">CV</div>
    <div class="info">
      <div class="input-box">
        <label for="nom">Nom et Prenom</label>
        <input type="text" name="nom" placeholder="Donnez votre nom" id="nom" required value="<?php echo $row['nom']; ?>" disabled>
      </div>
      <div class="input-box">
        <label for="nais">Date de naissance</label>
        <input type="date" name="nais" required id="dat_nais" value="<?php echo $row['date_naissance']; ?>" disabled>
      </div>
      <div class="input-box">
        <label for="mail">E-mail</label>
        <input type="email" name="mail" placeholder="exemple@domaine.com" id="mail" required value="<?php echo $row['email']; ?>" disabled>
      </div>
      <div class="input-box">
        <label for="adress">Etat Civil</label>
        <input type="text" name="adress" placeholder="Donnez votre adresse" id="adress" required value="<?php echo $row['etat']; ?>" disabled>
      </div>
      <div class="input-box">
        <label for="cin">CIN</label>
        <input type="text" name="cin" placeholder="Numéro de carte d'identité" id="cin" required value="<?php echo $row['cin']; ?>" disabled>
      </div>
      <div class="input-box">
        <label for="cin">Niveau d'études</label>
        <input type="text" name="diplome_dem" placeholder="Niveau d'études" id="diplome_dem" required value="<?php echo $row['diplome_dem']; ?>" disabled>
      </div>
      <div class="input-box">
        <label for="cv">Compétences</label>
        <input type="text" name="competences" placeholder="Compétences" id="competences" required value="<?php echo $row['competences']; ?>" disabled>
      </div>
      <div class="input-box">
        <label for="cv">Années d'expéreinces</label>
        <input type="text" name="exeperience_dem" placeholder="Années d'expéreinces" id="exeperience_dem" required value="<?php echo $row['exeperience_dem']; ?>" disabled>
      </div>
    </div>
    <div class="btn">
      <button type="submit" name="generate_pdf" class="btn btn-secondary" >Imprimer cv</button>
    </div>
    <input type="hidden" name="nomF" value="<?php echo $row['nom']; ?>">
    <input type="hidden" name="dateF" value="<?php echo $row['date_naissance']; ?>">
    <input type="hidden" name="emailF" value="<?php echo $row['email']; ?>">
    <input type="hidden" name="etatF" value="<?php echo  $row['etat']; ?>">
    <input type="hidden" name="cinF" value="<?php echo  $row['cin']; ?>">
    <input type="hidden" name="diplomeF" value="<?php echo  $row['diplome_dem']; ?>">
    <input type="hidden" name="competenceF" value="<?php echo  $row['competences']; ?>">
    <input type="hidden" name="experiencesF" value="<?php echo  $row['exeperience_dem']; ?>">
  </form>
</section>