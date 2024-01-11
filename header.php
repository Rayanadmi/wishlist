

<link rel="stylesheet" href="style.css">
<body>
    <header>
        <div class="logo"><a href="index.php"><img src="images/liste-de-souhaits.png" alt="logo"></a></div>
        <ul>
            <a href="listedesouhait.php"><li>Ma liste de souhait</li></a>
            <a href="connect.php"><li>Me connecter</li></a>
            <a href="inscription.php"><li>M'inscrire</li></a>
            <?php 
        if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
             echo '<a href="deconnect.php"><li><span> Me deconnecter</span></li></a>';

            }
            if ($_SESSION["admin"] === 1) {
                echo '<a href="admin.php"><li style= color:green;>Administrateur</li></a>';
            }?>
        </ul>
    </header>

