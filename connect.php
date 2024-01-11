<?php
include("connexionBDD.php");

        if (!empty($_POST['email']) && !empty($_POST['mdp'])) {
            $sql = "SELECT * FROM `user` WHERE email = :email";
            $query = $db->prepare($sql);
            $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
            $query->execute();
            $verifEmail = $query->fetch(PDO::FETCH_ASSOC);
            
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
            width:40%;
            display:flex;
            flex-direction:column;
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
            margin: 20px 60px 0;
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
<?php include("header.php"); ?>
    <form action="" method="post">
        <div><input type="email" name="email" id="email" placeholder="Entrez votre adresse mail" required></div>
        <div><input type="password" name="mdp" id="mdp" placeholder="Entrez votre mot de passe (123)" required></div>
        <button type="submit" name="subc">Connexion</button><br>
        
        <?php
        
        if ($verifEmail && password_verify($_POST["mdp"], $verifEmail['mdp'])) {

            echo "Reussie";

            session_start();
            $_SESSION["id"] = $verifEmail['id'];
            $_SESSION["prenom"] = $verifEmail['prenom'];
            $_SESSION["nom"] = $verifEmail['nom'];
            $_SESSION["admin"] = $verifEmail['admin'];

            $_SESSION["logged"] = true;


            header("Location: listedesouhait.php");
        }else if (!empty($_POST['email']) && !empty($_POST['mdp'])) {
            echo "<p class=error>Info incorrect</p>";
        }
            
        
        
        
        ?>
    </form>
</body>
</html>