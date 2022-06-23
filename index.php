<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Connection</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style2.css" rel="stylesheet">
    
    <?php
        require_once('php/database.php');
        // Enable all warnings and errors.
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        // Database connection.
        $db = dbConnect();
        
        // Session start
        session_start();
    ?>
    
</head>

<body>
    <header id="firstHeader" class="margin-auto">
        <div id="logo">
            <img src="images/logo.png" alt="logo officiel" width="200" height="99">
        </div>

        <h1 id="site_name">Catch Your Messi</h1>
        <div id="box3"></div>
    </header>


    <div class="pageContent">
        <div class="cardTitle margin-auto">J'ai déjà un compte</div>
        <form action="index.php" method="post">
            <div class="cardMain margin-auto">
                <div class="mainCard-form margin-auto">
                    <label for="text_field">Mail :</label>
                    <input type="text" name="mail" class="text_field">
                    <label for="text_field">Mot de passe :</label>
                    <input type="password" name="password" class="text_field">
                </div>
            </div>
            <div class="buttons margin-auto">
                <button type="submit" class="button" name="connect">Se connecter</button><br><br>
                <button type="submit" class="button" formaction="registration.php">Pas de Compte ?</button>
            </div>
        </form>
        <div class="buttons margin-auto">
            <?php
                //faire redirection page inscription
                if (isset($_POST['connect'])){
                    $mail = $_POST['mail'];
                    //echo $mail;
                    $password = $_POST['password'];
                    //echo $password;
                    
                    if (isGoodLogin($db, $mail, $password)){
                        // Creating session
                        $userInfo = getUser($db, $mail);
                        $_SESSION['mail'] = $mail;
                        $_SESSION['nom'] = $userInfo['0']['first_name'];
                        $_SESSION['prenom'] = $userInfo['0']['last_name'];
                        echo "<div class='alert success-alert'>Vous vous êtes connectés avec succès !</div>";
                        //redirect to search.html
                        //sleep(3);
                        redirectSearchPage();
                    } else {
                        echo "<div class='alert danger-alert'>Ce compte n'existe pas!</div>";
                    }
                }
                
            ?>  
        </div>
        
    </div>

    <footer>
        <p>All content copyright &copy; 2022.</p>
    </footer>

    <!-- <script src="script.js"></script> -->
</body>

</html>