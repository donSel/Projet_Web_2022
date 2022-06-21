<!DOCTYPE html><!--HTML5-->
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>registration</title>
        <link href="css/style.css" rel="stylesheet">
        
        <?php
            require_once('php/database.php');
            include ('php/constants.php');
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
        <header id="firstHeader">
            <div id="logo">
                <img src="images/logo.png" alt="logo officiel" width="200" height="99">
            </div>
            
            <h1 id="site_name">Catch Your Messi</h1>
            <div id="box3"></div>
        </header>
        
        <div class="pageContent">
            <div class="titleCreation margin-auto">Création</div>
            <form action="registration.php" method="post">
                <div class="mainCreation margin-auto">
                    <div class="mainCreation-form margin-auto">
                        <div class="form-item">
                            <label for="text_field">nom :</label>
                            <input type="text" name="lastName" class="text_field">
                        </div>
                        <div class="form-item">
                            <label for="text_field">prénom :</label>
                            <input type="text" name="firstName" class="text_field">
                        </div>
                        <div class="form-item">
                            <label for="text_field">ville :</label>
                            <input type="text" name="town" class="text_field">
                        </div>
                        <div class="form-item">
                            <label for="text_field">chemin relatif de la photo (optionnel) : </label>
                            <input type="text" name="photoUrl" class="text_field">
                        </div>
                        <div class="form-item">
                            <label for="text_field">mail : </label>
                            <input type="email" name="mail" class="text_field">
                        </div>
                        <div class="form-item">
                            <label for="text_field">mot de passe : </label>
                            <input type="password" name="password" class="text_field">
                        </div>
                        <div class="form-item">
                            <label for="text_field">confirmer mot de passe : </label>
                            <input type="password" name="passwordConf" class="text_field">
                        </div>
                    </div>
                </div>
                <div class="buttons margin-auto">
                    <button type="submit" class="button" name="connect">M'inscrire et me connecter</button><br><br>
                    <button type="submit" class="button" formaction="index.php" class="button">Retour</button>
                </div>
            </form>
        
            <div class="buttons margin-auto">
                <?php
                    if (isset($_POST['connect'])){
                        // Checking of all the informations where entered
                        if (empty($_POST['lastName']) || empty($_POST['firstName']) || empty($_POST['town']) || empty($_POST['mail']) || empty($_POST['password']) || empty($_POST['passwordConf'])){
                            echo "<div class='alert danger-alert'>Remplissez tout les champs !</div>";
                        }
                        else {
                            //getting informations
                            $lastName = $_POST['lastName'];
                            $firstName = $_POST['firstName'];
                            $town = $_POST['town'];
                            /*if (empty($_POST['photoUrl'])){
                                $photoUrl = "images/default_avatar.jpg"; 
                            }
                            else {
                                $photoUrl = $_POST['photoUrl']; 
                            }*/
                            $photoUrl = $_POST['photoUrl'];
                            $mail = $_POST['mail'];
                            $password = $_POST['password'];
                            $passwordConf = $_POST['passwordConf'];
                                                  
                            if (isStringSame($password, $passwordConf)){ //check if informations correct
                                if (mailExists($db, $mail)){ //check if the mail already is in the DB
                                    echo "mail already exists<br>";
                                    echo "<div class='alert danger-alert'>L'adresse mail rentrée existe déjà !</div>";
                                } else {
                                    // Adding the new user
                                    registerNewUser($db, $lastName, $firstName, $photoUrl, $town, $mail, $password);
                                    // Success message                    
                                    echo "<div class='alert success-alert'>Vous vous avez créez votre compte avec succès !</div>";
                                    // session creation
                                    $userInfo = getUser($db, $mail);
                                    $_SESSION['mail']= $mail;
                                    $_SESSION['nom'] = $userInfo['0']['first_name'];
                                    $_SESSION['prenom'] = $userInfo['0']['last_name'];
                                    //redirect to search.html
                                    redirectSearchPage();
                                }
                            } else {
                                echo "<div class='alert danger-alert'>Les mots de passes ne correspondent pas!</div>"; 
                            }
                        }
                    }
                ?>
            </div>
        </div>
        
        <footer>
            <p>All content copyright &copy; 2022.</p>
        </footer>
        
        <!--<script src="script.js"></script>-->
    </body>
</html>