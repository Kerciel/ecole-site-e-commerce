<?php
session_start();
//traitement dees données sur le formulaire 
require_once('header.php');

if (isset($_POST['submit']))//On a toujours un button pour que le traitement se face.
{
  $pseudo=htmlentities(trim($_POST['pseudo']));
  $mpd=htmlentities(trim($_POST['mpd']));

  if ($pseudo&&$mpd)
  {

   $data= $DB->connexion($pseudo);//recupere les informtions si la valeurs de pseudo correspond bien à un pseudo dans la base
  if($data != NULL) // si l'utilisateur existe
  {
  foreach ($data as $data) 
    {if ($mpd == $data->mpd )// on verifie si le mot de passe inscrit correspond à celui qui a bien été recupere
    {
     header ('Location:http://localhost/'); //nous renvoie à la page d'Acceuil
      echo "connection effectuée";
      $_SESSION['pseudo'] = $pseudo; //recupere la valeurs pour l'utilisers plutart car on a besoin pour que on sache si l'utilisateurs c est connecter ou non par rapport au commande.
      
    }
  }
  }
  else
  {die('Vous apparaisez pas dans nos données. Veillez vous <a href="inscription.php">inscrire</a>');
  }
  
  }else echo "Veuillez Saisir tous les champs";
}

?>

<?php   ?>

<!DOCTYPE html>
<html>
<head>
  <title>connexion</title>
</head>
<body>
<!-- voici le formulaire pour la connexion d'un utilisateur: -->
<div align="center">
<fieldset style="border: 1px Solid Black;padding: 1em;margin: 0.5em;" >
<legend><b>Veuillez vous connecter</b></legend>
<table>
  <div class="col-md-3 order-md-1">
		<form class="needs-validation" method="post" action="connection.php">
		   <div class="mb-11">
          <label >Peudo</label>
          <div class="input-group">
            <input type="text" class="form-control" name="pseudo" placeholder="pseudo" required="">
          </div>
        </div>

        <div class=" mb-3">
            <label >Mot de passe</label>
            <input type="password" class="form-control" id="mpd" name="mpd" placeholder="mot de passe"  required="required">
          </div>
      
            
          <tr>
  		<td></td>
  		<td><input type="submit" name=" submit" value="Valider"></td>
  		</tr>

		</form>
  </div>
	
</table>
</fieldset>
</div>

</body>
<?php   require_once('footer.php');?>
</html>
