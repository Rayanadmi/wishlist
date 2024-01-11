<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("connexionBDD.php");
if (isset($_POST["envoi"])) {
    

$sql = "INSERT INTO `article`(`nom`, `description`, `image`, `prix`) VALUES (:nom , :descriptions , :images , :prix)";
                $query = $db->prepare($sql);
                $query->bindValue(":nom", $_POST["nom"], PDO::PARAM_STR);
                $query->bindValue(":descriptions", $_POST["description"], PDO::PARAM_STR);
                $query->bindValue(":images", $_POST["image"], PDO::PARAM_STR);
                $query->bindValue(":prix", $_POST["prix"] , PDO::PARAM_STR);
                $query->execute();
            }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>


        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        div {
            margin-bottom: 15px;
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php include("header.php");?>
    <form action="" method="post">
        <div>
            <label for="nom">Nom du produit</label><br>
            <input type="text" name="nom" required>
        </div>
        <div>
            <label for="description">Description du produit</label><br>
            <input type="textarea" name="description" required>
        </div>
        <div>
            <label for="image">Lien vers l'image du produit</label><br>
            <input type="text" name="image" required>
        </div>
        <div>
            <label for="prix">Prix du produit</label><br>
            <input type="text" name="prix" required>
        </div>
        <div><button type="submit" name="envoi">Crée le nouveau produit</button></div>
    </form>

</body>
</html>