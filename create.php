<?php

/**
 * Use an HTML form to create a new entry in the
 * utilisateurs table.
 *
 */


if (isset($_POST['submit'])) {
    require "config.php";
    require "common.php";

    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $new_user = array(
            "prenom" => $_POST['prenom'],
            "nom"  => $_POST['nom'],
            "email" => $_POST['email'],
            "mdp"  => md5($_POST['mdp']),
            "borndate"   => $_POST['borndate'],
            "genre"  => $_POST['genre']
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "utilisateurs",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>



<?php if (isset($_POST['submit']) && $statement) { ?>
    > <?php echo $_POST['prenom']; ?> ajouté avec succès.
<?php } ?>


<link rel="stylesheet" href="css/inscriptionflexbox.css">
<div class="background"
     </div>

<div class="container">
    <form method="post">
        <div class="text centre">
            <h6 class="selection-titre">CREER UN COMPTE</h6>

        </div>
        <div class="control prenom">
            <input class="input" type="text" name="prenom" placeholder="Nom" value="" tabindex="2" data-i18n-placeholder autocomplete="Prenom" />
        </div>
        <div class="control nom">
            <input class="input" type="text" name="last_name" placeholder="Prenom" value="" tabindex="3" data-i18n-placeholder autocomplete="Nom" />
        </div>

        <div class="control email">
            <input class="input" type="text" name="email" placeholder="Adresse email" value="" tabindex="6" data-i18n-placeholder autocomplete="email" />
        </div>
        <div class="control motdepasse">
            <input class="input" type="password" name="mdp" placeholder="mot de passe" tabindex="7" data-i18n-placeholder autocomplete="nouveau mot de passe" />
        </div>
        <div class="control mdpconfirmation">
            <input class="input" type="password" name="mdpconfirm" placeholder="Confirmer votre mot de passe" tabindex="8" data-i18n-placeholder autocomplete="0" />
            <p class="password_confirm-tip" data-i18n-text>
                8 caractéres minimum,une lettre et un caractére.
            </p>
        </div>

        <div class="g-recaptcha has-text-centered">

        </div>
        <div class="controle conditions_generales">
            <input type="hidden" name="Conditions_generales" value="0" />
            <input class="input-checkbox" type="checkbox" name="conditions_générales" value="1" />
            <label class="checkbox-label" tabindex="0"></label>

            <div class="description_prive">
                <span data-i18n-key="consentemement_prive">J'accepte les conditions générales de Infinite Measures      </div>
            <div class="clear"></div>
        </div>


        <div class="control">
            <input class="input-checkbox" type="checkbox" name="opt_in" value="1" />
            <label class="checkbox-label" tabindex="0"></label>

            <div class="optin-description">
                <span data-i18n-key="Get Tesla Updates">Mise à jour Infinites Measures: J'accepte de recevoir les nouveautés de la part d'infinite measures</span>

            </div>
            <div class="clear"></div>
        </div>

</div>
<div class="texte centre">
    <button class="button create-button" tabindex="0" data-i18n-key="Create Account">Créer un compte</button>
</div>
<div class="texte centre connexion">
    <span data-i18n-text>Vous avez déjà un compte?</span> <a href="connect.php" tabindex="1" data-i18n-text>Connexion</a>
</div>



        <a href="index.php">Retour à l'accueil</a>

    </form>

</div>



<?php "SELECT DATE_FORMAT(date, '%d/%m/%Y') AS date FROM utilisateurs" ?>

