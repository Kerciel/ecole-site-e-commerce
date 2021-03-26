
<?php
session_start();
//traitement des données inscrit sur le formulaire et apres cliquer sur le boutton d'inscription
require_once('ConnexionBdd.php');
if (isset($_POST['submit']))
{
  $pseudo=htmlentities(trim($_POST['pseudo']));
  $mpd=htmlentities(trim($_POST['mpd']));
  $repeatpassword=htmlentities(trim($_POST['repeatpassword']));
  $nom=htmlentities(trim($_POST['nom']));
  $prenom=htmlentities(trim($_POST['prenom']));
  $email=htmlentities(trim($_POST['email']));
  $ville=htmlentities(trim($_POST['ville']));
  $cp=htmlentities(trim($_POST['cp']));
  $adresse=htmlentities(trim($_POST['adresse']));
  if ($pseudo&&$mpd&&$repeatpassword&&$nom&&$prenom&&$email&&$ville&&$cp&&$adresse)
  {
  	
  	if ($mpd==$repeatpassword) // on verifie que le mot de passe est bien le meme
  	{
   
        $base = new connect();
        $verif = $base->verifDoublon($pseudo, $email);// verifie si il existe pas d'utilisateurs qui possede le meme mail ou le meme pseudo lorsque un utilisateurs cherche à s inscrire 
        if ($verif = NULL) {
          $insert = $base->Inscrire();//insert les données dans la basse
        die('Inscription terminée. <a href="connection.php">connectez vous </a>');
        }else echo '<a style="color:red; border: 1px Solid red;padding: 3em;margin: 3em; ">le peudo ou l email sont déjà utiliser</a>';
           
  	}else echo "Les mots de passe ne sont pas identiques";



  }else echo "Veuillez saisir tous les champs";
}

?>
<?php require_once('header.php');  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
</head>





<body>

<fieldset style="border: 1px Solid Black;padding: 1em;margin: 0.5em;">
	<legend><b>Inscription</b></legend>
<table>

	<?   //voici le formulaire ?>

	<div class="col-md-8 order-md-1">
      <h4 class="mb-3">Completez les champs</h4>
      <form class="needs-validation"  method="POST" action="inscription.php">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label >Nom</label>
            <input type="text" class="form-control" name="nom" placeholder="" value="" required="">
            <div class="invalid-feedback">
              Entrer un Nom valide.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label >Prenom</label>
            <input type="text" class="form-control" name="prenom" placeholder="" value="" required="">
          </div>
        </div>

        <div class="mb-3">
          <label >Peudo</label>
          <div class="input-group">
            <input type="text" class="form-control" name="pseudo" placeholder="pseudo" required="">
          </div>
        </div>

         <div class=" mb-3">
            <label >Mot de passe</label>
            <input type="password" class="form-control" id="mpd" name="mpd" placeholder="mot de passe"  required="required">
          </div>

		<div class=" mb-3">
            <label >confirmation Mot de passe</label>
            <input type="password" class="form-control" name="repeatpassword" placeholder="confirmation mot de passe"  required="required">
          </div>          

        <div class="mb-3">
          <label for="email">Email </label>
          <input type="email" class="form-control" name="email" placeholder="you@example.com">
        </div>

        <div class="mb-3">
          <label for="address">Addresse</label>
          <input  type="text" class="form-control" name="adresse" placeholder="1234 Main St" required="">
        </div>

         <div class="mb-3">
          <label for="address">Ville</label>
          <input  type="text" class="form-control" name="ville" placeholder="Paris" required="">
        </div>
        
         <div class="mb-3">
          <label for="address">Code Postale</label>
          <input  type="text" class="form-control" name="cp" placeholder="93000" required="">
        </div>

         <tr>
		<td></td>
		<td><input type="submit" value="S'inscrire" name="submit"></td>
		</tr>

      </form>
    </div>

</table>
</fieldset>

<br><br/>
</body>
<?php require_once('footer.php');  ?>
</html>