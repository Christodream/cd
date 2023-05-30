<?php

$host = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "form";


try {
  $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
  $pdo = new PDO($dsn, $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $nom = $_POST["nom"];
  $prenom = $_POST["prenom"];
  $entreprise = $_POST["entreprise"];
  $numeroCompte = $_POST["numero-compte"];
  $email = $_POST["email"];
  $telephone = $_POST["telephone"];
  $objet = $_POST["objet"];
  $commentaire = $_POST["commentaire"];


  $sql = "INSERT INTO formulaire (nom, prenom, entreprise, numero_compte, email, telephone, objet, commentaire)
          VALUES (:nom, :prenom, :entreprise, :numeroCompte, :email, :telephone, :objet, :commentaire)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(":nom", $nom);
  $stmt->bindParam(":prenom", $prenom);
  $stmt->bindParam(":entreprise", $entreprise);
  $stmt->bindParam(":numeroCompte", $numeroCompte);
  $stmt->bindParam(":email", $email);
  $stmt->bindParam(":telephone", $telephone);
  $stmt->bindParam(":objet", $objet);
  $stmt->bindParam(":commentaire", $commentaire);

  try {
    $stmt->execute();
    echo "Form data submitted successfully!";
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>
