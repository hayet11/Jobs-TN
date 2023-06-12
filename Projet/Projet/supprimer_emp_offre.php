<?php
if (isset($_GET['id_offre']) && isset($_GET['internaute'])) {
    $id_offre = $_GET['id_offre'];
    echo $id_offre;
    $code = $_GET['internaute'];
    echo $code;
    $dsn = "mysql:host=localhost;dbname=projetpweb;charset=utf8mb4";
    $username = "root";
    $password = "";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    try {
        $pdo = new PDO($dsn, $username, $password, $options);
        $stmt = $pdo->prepare("DELETE FROM offre WHERE id_offre = ?");
        $stmt->execute([$id_offre]);
       
        // redirect user to offres_emp.php
        header("Location: offres_emp.php?internaute=$code");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}
?>

