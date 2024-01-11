<?php 
include ("connexionBDD.php");





if (isset($_POST["sub"])) {
    if (!empty($_POST['nom']) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["mdp"]))  {
        $verifmail="SELECT * FROM user WHERE email = :email";
        $requeteverif = $db->prepare($verifmail);
        $requeteverif->bindValue(":email",$_POST["email"],PDO::PARAM_STR);
        $requeteverif->execute();
        $result = $requeteverif->fetch(PDO::FETCH_ASSOC);
        
}
}






?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exam</title>
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
<body><?php include("header.php"); ?>

    <form action="" method="post">
        <div>
            <input type="text" name="nom" id="nom" placeholder="Entrez votre nom">
        </div>
        <div>  
            <input type="text" name="prenom" id="prenom" placeholder="Entrez votre prenom">
        </div>  
        <div>    
            <input type="email" name="email" id="email" placeholder="Entrez votre email">
        </div>   
        <div>
            <input type="password" name="mdp" id="mdp" placeholder="Entrez votre mdp">
        </div>
        <button type="submit" name="sub">Envoyez</button>
        <?php
            if ($result === false) {
                $mdp = $_POST['mdp'];
                $motdepassehash = password_hash($mdp, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `user`(`nom`, `prenom`, `email`, `mdp`) VALUES (:nom , :prenom , :email , :mdp)";
                $query = $db->prepare($sql);
                $query->bindValue(":nom", $_POST["nom"], PDO::PARAM_STR);
                $query->bindValue(":prenom", $_POST["prenom"], PDO::PARAM_STR);
                $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
                $query->bindValue(":mdp", $motdepassehash , PDO::PARAM_STR);
                $query->execute();
            }else if($_POST){
                echo '<p class="error">Adresse e-mail déjà utilisée</p>';
            }
        ?>
    </form>
</body>
</html>