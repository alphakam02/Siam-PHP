<?php
if (isset($_GET['username'])) {
  // Connexion à la base de données SQLite
  try {
    $db = new PDO('sqlite:../datas/data_base.db');
  } catch (PDOException $e) {
    echo "Échec de la connexion", $e->getMessage();
    $db = null;
    exit();
  }
  // Préparation et exécution de la requête
  $query = "SELECT * FROM User WHERE Username = :username";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':username', $_GET['username'], SQLITE3_TEXT);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  // Renvoi de la réponse
  if ($user) {
    echo "true";
  } else {
    echo "false";
  }
  // Fermeture de la connexion à la base de données
  $db = null;
}
else {
  echo "La requête n'est pas valide.";
}
?>