<?php
session_start();
include("connexionBDD.php");
if (isset($_SESSION['logged']) && $_SESSION['logged'] !== true) {
    header('Location: connect.php');
    exit;
}
// Récupérer tous les articles
$sql_all_articles = "SELECT * FROM article";
$query_all_articles = $db->prepare($sql_all_articles);
$query_all_articles->execute();
$all_articles = $query_all_articles->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les articles likés par l'utilisateur
$sql_liked_articles = "SELECT * FROM user_article WHERE id_user = :id_user";
$query_liked_articles = $db->prepare($sql_liked_articles);
$query_liked_articles->bindValue(':id_user', $_SESSION["id"], PDO::PARAM_INT);
$query_liked_articles->execute();
$liked_articles = $query_liked_articles->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["like"])) {

    $sqllike="INSERT INTO `user_article` ( `id_user`, `id_article`, `aime`) VALUES (:id_user , :id_article , :aime)";
    $querylike = $db->prepare($sqllike);
    $querylike->bindValue(':id_user', $_SESSION["id"], PDO::PARAM_INT);
    $querylike->bindValue(':id_article', $_POST["like"], PDO::PARAM_INT); // ESt ce que ici la valeur :id_article prendra la valeur du bouton post ?
    $querylike->bindValue(':aime', 1 , PDO::PARAM_INT);
    $querylike->execute();
    header("Location: listedesouhait.php");
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes produits like</title>
</head>
<body>
    <?php include("header.php"); ?>
    <main>
<?php
    // Afficher les articles non likés
    foreach ($all_articles as $article) {
        $liked = false;
        foreach ($liked_articles as $liked_article) {
            if ($liked_article["id_article"] == $article["id"]) {
                $liked = true;
                break;
            }
        }

        if (!$liked) {
            echo '<div class="article">';
            echo $article["nom"].'<br>'.$article["description"].'<br>'.$article["prix"].'€<br><img src="'.$article["image"].'" alt="imageproduit" height=300px><br>' ;
            echo '<form action="" method="post">
                    <button type="submit" name="like" value="'.$article['id'].'"><img src="images/coeurvide.svg" alt="test" height="20px"></button>
                    </form></div>';
        }
    }
    ?>
    </main>
</body>
</html>
