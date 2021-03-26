<?php
require_once('header.php');  ?>

<?php 
	//ici on va recuperer les informations de l'utilisateurs qui sont dans la table client
	$compte = NULL;
	$s = Null;
	if (!isset($_SESSION['pseudo'])) {// si la variable est vide:
			echo '<a style="color:red;"> Vous n etes pas connecter!</a><br><br>';
	}else{
			 $s = $_SESSION['pseudo'];
			 $compte = $DB->connexion($s);//recupere des informations en fonction de la variable s

	}   

	?>
<?php
	//on permet au le client de faire des modifications sur ces données 
	if (isset($_POST['submit']))
{
  $pseudo=htmlentities(trim($_POST['pseudo']));
  $mpd=htmlentities(trim($_POST['mpd']));
  $nom=htmlentities(trim($_POST['nom']));
  $prenom=htmlentities(trim($_POST['prenom']));
  $email=htmlentities(trim($_POST['email']));
  $ville=htmlentities(trim($_POST['ville']));
  $cp=htmlentities(trim($_POST['cp']));
  $adresse=htmlentities(trim($_POST['adresse']));
  if ($pseudo&&$mpd&&$nom&&$prenom&&$email&&$ville&&$cp&&$adresse)
  {

 		
        $insert = $DB->update($compte, $pseudo, $mpd,$nom,$prenom,$email, $ville,$cp,$adresse);//on fait la modification des données
        die('Modification faite!');
        
           
  	


  }else echo "Veuillez saisir tous les champs";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Compte</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

 	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</head>
<body>

      <?php foreach ($compte as $compte):
      	//les informations de l'utilisateurs s'affiche?>
      <div class="modal-body">
      	<form method="post">
      		
      	<div class="form-group">
			 <label for="nom">Nom</label>
			<input type="text"   name="nom" value="<?= $compte->nom ?>">
			</div>
      
      	<hr>
			<div class="form-group">
			<label for="pseudo">Prenom</label>
			<input type="text"   name="prenom" value="<?= $compte->prenom ?>">
			</div>
				
        <hr>
        <div class="form-group">
			<label for="pseudo">Pseudo</label>
		  <input type="text"   name="pseudo" value="<?= $compte->pseudo ?>">
		  	</div>
        <hr>
        <div class="form-group">
			<label for="mpd">Mot de passe</label>
			<input type="text"   name="mpd" value="<?= $compte->mpd ?>">
		</div>
		<hr>
        <div class="form-group">
			<label for="email">E-mail</label>
			<input type="text"   name="email" value="<?= $compte->email ?>">
		</div>

        <hr>
        <div class="form-group">
			<label for="ville">Ville</label>
			<input type="text"   name="ville" value="<?= $compte->ville ?>">
		</div>
        <hr>
        <div class="form-group">
			<label for="adresse">Addresse</label>
			<input type="text"   name="adresse" value="<?= $compte->adresse ?>">
		</div>
        <hr>
        <div class="form-group">
			 <label for="cp">Code Postal</label>
			 <input type="text"   name="cp" value="<?= $compte->cp ?>">
		</div>
		<input type="submit"  name="submit" value="Modifier"><br>
						
	  	</form>
      </div>
  <?php endforeach; ?>
<?php 

if (isset($_POST['ajouter']))
{
	$id = htmlentities(trim($_POST['id']));
  $numero=htmlentities(trim($_POST['numero']));
  $Date=htmlentities(trim($_POST['Date']));
  $crytogramme=htmlentities(trim($_POST['crytogramme']));
  if ($numero&&$Date&&$crytogramme)
  {
  	
  	$DB->payement($id,$numero,$crytogramme);
  	die("mcarte ajouter!");
  }else echo "Veuillez saisir tous les champs";
 }

 $carte = $DB->Affpayement($compte);

 ?>

  <button type="button" class="col-8 btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
  Ajouter une Carte de Payement
</button>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter une carte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form method="post">
    
    	<div class="form-group">
			 
			 <input type="hidden" class="col-8"  name="id" value="<?= $compte->id_client ?>">
		</div>
        <div class="form-group">
			 <label >Numero de carte </label>
			 <input type="text" class="col-8"  name="numero" value="">
		</div>
		<hr>
		<div class="form-group">
			 <label >Date de fin </label>
			 <input type="text" class="col-7"  name="Date" value="">
		</div>
		<hr>
		<div class="form-group">
			 <label >Cyptogramme </label>
			 <input type="text"  class="col-7" name="crytogramme" value="">
		</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit"  name="ajouter" value="Ajouter">
      </div>
      </form>
    </div>
  </div>
</div><br><br><br>

<h1>Vos Cartes</h1>
<?php foreach ($carte as $carte):
  ?>
  <form>
    <input type="text" name="" value="<?= $carte->cartenumero ?>">
    <input type="text" name="" value="<?= $carte->datefin ?>">
    <input type="text" name="" value="<?= $carte->cryptogramme ?>">
  </form>
<?php endforeach;  ?>
 
</body>
</html>

<?php require_once('footer.php');  ?>