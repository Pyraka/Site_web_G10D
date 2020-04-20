<?php include "../model/configuration.php";
 if(isset($_SESSION['id'])) 
{

      require('../controller/reqAdmin/req.modifyProfile.php');
     


       ?>

   <html>
      <head>
         <title>Modification de profil</title>
         <meta charset="utf-8">
         <link rel="stylesheet" href="css/style.css" />
      </head>
         <?php require "templates/header.php"; ?>
            <h2 class="title">Edition de mon profil</h2>
            <div class="formulaireColonnes">
               <form method="POST" action="" enctype="multipart/form-data">
                  <div class="colonne1">
                     <h3>modification des informations personnelles</h3>
                     <label for="newfirstname">Prénom :</label>
                     <input type="text" name="newfirstname" placeholder="Prénom" value="<?php echo $user['firstName']; ?>" /><br /><br />
                     <label for="newlastname">Nom :</label>
                     <input type="text" name="newlastname" placeholder="Nom" value="<?php echo $user['lastName']; ?>" /><br /><br />
                     <label for="newmail">Mail :</label>
                     <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['email']; ?>" /><br /><br />
                     <label for="newbirthdate"> Date de naissance :</label>
                     <input type="date" name="newbirthdate" value="<?php echo $user['birthDate']; ?>"/><br/><br/>
                     <label for="newgender">genre :</label>
                     <input type="radio" name="newgender" value="homme"/> homme
                     <input type="radio" name="newgender" value="femme"/> femme
                     <input type="radio" name="newgender" value="autre"/> autre <br/><br/>
                  </div>
                  <div class="colonne2">
                     <h3>modification du mot de passe</h3>
                     
                     <label for="newmdp1">Nouveau mot de passe :</label>
                     <input type="password" id="userPassword" name="newmdp1" placeholder="Mot de passe"/><br /><br />
                     <label for="newmdp2">Confirmation - mot de passe :</label>
                     <input type="password" id="mdp_verif" name="newmdp2" placeholder="Confirmation du mot de passe"/>
                     <span id='message'></span>
                     <br /><br />
                     <?php if(isset($msg)) { echo $msg; } ?>
                  </div>
                  <div class="colonne3">
                     <h3>modification de la photo</h3>
                     <p>photo actuelle :</p>
                     <img src="<?php echo $imageprofile['imageDirectory']; ?>" id="photoProfil"/>
                     <br/><br/>
                     <input type="file" name="photoProfil"/> <br/><br/>
                  </div>
                  <input type="submit" value="Mettre à jour le profil !" id="endEdition"/>
                  <a href="manageUser.php" class="linkEdProfil">Revenir à la gestion des utilisateurs</a>
               </form> 
            </div>
            <script type="text/javascript" src="../js/checkPassword.js"></script>

         <?php require "templates/footer.php"; ?>

   <?php   
}
else {
   header("Location: connect.php");
}
?>