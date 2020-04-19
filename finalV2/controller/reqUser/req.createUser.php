<?php require('../model/configuration.php'); require ('../controller/functions.php');


if (isset($_SESSION['id'])){
    header("Location: profil.php?id=".$_SESSION['id']);
}
if (isset($_POST['submit']) && isset($_POST['firstName']) AND isset($_POST['lastName']) AND isset($_POST['email']) AND isset($_POST['userPassword']) AND isset($_POST['birthDate']) AND isset($_POST['gender']) AND (htmlspecialchars($_POST['mdp_verif']))==(htmlspecialchars($_POST['userPassword']))) {
    
    try {

        // on vérifie que l'email n'est pas déjà utilisée
        $requser = $bdd->prepare("SELECT * FROM user WHERE email = ?");
        $requser->execute(array($_POST['email']));

        $userexist = $requser->rowCount();
        if($userexist != 0) {
            echo "Cette adresse email est deja utilisé...";
        }

        else{

            // on ajoute s'il n'y a pas deja cette adresse mail dans la bdd
            $requser1 = $bdd->prepare("INSERT INTO user(firstName, lastName, email, birthDate, gender, userPassword, subDate, age, idImage, allow) VALUES(?, ?, ?, ?, ?, ?, NOW(), ?, 1, 0)");
            $requser1->execute(array($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['birthDate'], $_POST['gender'], md5($_POST['userPassword']), age($_POST['birthDate'])));

            // On refait une requete maintenant que l'utilisateur a été ajouté
            $requser->execute(array($_POST['email']));
            $utilisateur = $requser->fetch();

            // on connecte directement l'utilisateur grace aux variables de session
            $_SESSION['id'] = $utilisateur['idUser'];
            $_SESSION['email'] = $utilisateur['email'];
            $_SESSION['photo'] = $utilisateur['idImage'];
           // header("Location: profil.php?id=".$_SESSION['id']);

            /*
             //on envoie un mail de confirmartion
            $head="MIME-Version: 1.0\r\n";
            $head.='From:"medy-sys.com'."\n";
            $head.='Content-Type:text/html; charset="uft-8"'."\n";
            $head.='Content-Transfer-Encoding: 8bit';

            $message='
            <html>
                <body>
                    <div align="center">

                    <a href="http://localhost/espaceMembre/confirmation.php">lien de confirmation </a>
                    </div>
                </body>
            </html>
            ';

            mail($utilisateur['email'], "CONTACT - medy-sys.com", $message, $head);*/

           header("Location: profil.php?id=".$_SESSION['id']);

        }

        
        
    }catch (PDOException $error) {
        echo $error->getMessage();
    }
}
else{
    if (isset($_POST['submit'])) {
        echo("Les mots de passe ne sont pas identiques");
    }
    
}
?>