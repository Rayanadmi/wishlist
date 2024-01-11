<?php
session_start();

if ($_SESSION['logged'] !== true) {
    header('Location: connect.php');
    exit(); // Assurez-vous de terminer l'exécution du script après la redirection
}


include("connexionBDD.php");

$sql = "SELECT * FROM user_article WHERE id_user = :id_user";
$query = $db->prepare($sql);
$query->bindValue(':id_user', $_SESSION["id"], PDO::PARAM_INT);
$query->execute();
$verifs = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["unlike"])) {
    $sqlunlike="DELETE FROM `user_article`  WHERE `id_user` = :id_user AND  id_article = :id_article";
    $queryunlike = $db->prepare($sqlunlike);
    $queryunlike->bindValue(':id_user', $_SESSION["id"], PDO::PARAM_INT);
    $queryunlike->bindValue(':id_article', $_POST["unlike"], PDO::PARAM_INT); // ESt ce que ici la valeur :id_article prendra la valeur du bouton post ?
    $queryunlike->execute();
    header("Location: index.php");
    
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes produits like</title>
</head>
<body>
    <?php include("header.php");?>
    <main>
    <?php 
    
    foreach ($verifs as $verif) {
        $sql_article = "SELECT * FROM `article` WHERE id = :id_article";
        $query_article = $db->prepare($sql_article);
        $query_article->bindValue(':id_article', $verif["id_article"], PDO::PARAM_INT);
        $query_article->execute();
        $article = $query_article->fetch(PDO::FETCH_ASSOC);
        echo '<div class="article">';
        echo $article["nom"].'<br>'.$article["description"].'<br>'.$article["prix"].'€<br><img src="'.$article["image"].'" alt="imageproduit" height=300px><br>' ;
        echo '<form action="" method="post">
                    <button type="submit" name="unlike" value="'.$article['id'].'"><img src="images/coeurplein.svg" alt="test" height="20px"></button>
                    </form></div>';
    }?>
    </main>
</body>
</html>

