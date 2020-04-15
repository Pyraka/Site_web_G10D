<html>
<head>
    <link rel="stylesheet" href="style.css">
    <p><strong> Selectionnez les questions à supprimer:</strong></p>
</head>
<body>
<div class="tableau">
    <form method="post" action="supp.php">
        <table border="1" style="overflow-x:hidden;table-layout: fixed;" >
            <tr>
                <td>idQuestion</td>
                <td>Questions</td>
                <td >Cochez</td>
            </tr>

            <?php
            try
            {
                // On se connecte à MySQL
                $bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8',
                    'root','');
            }
            catch(Exception $e)
            {
                // En cas d'erreur, on affiche un message et on arrête tout
                die('Erreur : '.$e->getMessage());
            }
            $reponse = $bdd->query('SELECT * FROM faq WHERE isDeleted = 0');
            $idQuestion=isset($_POST['idQuestion'])?$_POST['idQuestion']: NULL;
            while ($donnees = $reponse->fetch()) {
                echo"<tr><td>".$donnees['idQuestion']."</td>";
                echo"<td>".$donnees['textQuestion']."</td>";
                echo"<td><input type='checkbox' name='delete[", $donnees['idQuestion'], "]' value=", $donnees['idQuestion'], "></td>";
                echo"</tr>";
            }
            $reponse->closeCursor();
            ?>
        </table>

        <input type="submit" style="align-content: center">
    </form>
</div>
<p><a href="accueilAdmin.php">Accueil</a> </p>
</body>
</html>






