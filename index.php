<?php 
session_start(); 
require_once("header.php");
//on va afficher une Barre de menu pour naviger et sa permet d'utiliser les variable d'initialisation des class
 ?>


<?php 
//recuperation de tout les produits :
$produit = $DB->Listproduit('SELECT * FROM produit');
//lorsque on clic sur Recherche on a cette ces conditions qui s execute :
if (isset($_POST['submit']))
{	$recherche=htmlentities(trim($_POST['recherche']));
	if ($recherche) {
		$produit = $DB->Rechproduit($recherche);
		
	}else echo 'Veuillez saisir le champ'; // lorsque on a pa saisie de valeur dans la barre de recherche 

}elseif (isset($_GET['categorie'])) { //lorsque on clic sur une catégorie sa exécute ce code 
	$q =$_GET['categorie'];
	$produit = $DB->Rechcategorie($q);

}else{ $produit = $DB->Listproduit('SELECT * FROM produit');
}
//ici on va recuperer les catégorie pour les utiliser:
$categorie = $DB->listecategorie();


 ?>

 <?php 

  ?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
 	<title>P.M.U</title>
 	<link rel="stylesheet" type="text/css" href="/PMU/style/style.css">
 	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

 	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</head>
<body >
<div class="corp" style="display: flex; margin: 5px;">
	<form class="needs-validation"  method="POST" action="index.php" style="border: 1px Solid Black;padding: 0.5em;margin: 0em;">
        <div class="row">
          <div class="col-sm-12 ">
            <label for="recherche">Recherche</label>
            <?php // la barre de charche lorque on cherche un produit on peut ecrire le nom ou la catégorie du pruit et la recherche se fait  ?>
            <input type="text" class="form-control" name="recherche" placeholder="Rechcerche" value="" required="">
          </div>
   		 </div>

   		    <tr>
		<td></td>
		<td><input type="submit" value="Rechercher" name="submit"></td>
		</tr><br><br>

		<label>Categorie:</label><br><br>
		<?php 
		//permet d'affivher les catégories qui sont stoker dans la basse de bonnée
		foreach ($categorie as $categorie): ?>
			<a href="index.php?categorie=<?= $categorie->categorie; ?>" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true"><?= $categorie->categorie; ?></a><br><br> 
		<?php endforeach;  ?>
   	</form>

<div > 
<?php 
?>
<?php 
//ici on affiche tout les produits qui sont dans la basse ou les produits qui ont ete rechercher ou encore les produits d'une categorie :
foreach ($produit as $produit): ?>
  <div class="btn" style="border: 1px Solid Black;padding: 1em;margin: 0.5em;">
	<div class="form-group">
		<h3><?= $produit->id_produit.".".$produit->description?></h3>
		<?php echo '<img    src="'.$produit->image.'"  alt=""/><br><br>'; ?>
		<a href="#" style="color: green;"><?= "Prix: ".number_format($produit->prix,2,',',' ')."€ <br><br>"?></a>
		<?php 
		$s = NULL;
		if (!isset($_SESSION['pseudo'])) {
			echo '<a style="color:red;"> Il faut etre connecter pour commander!</a><br><br>';
		}else{
			$s = $_SESSION['pseudo'];
		} ?>
		<a href='AjoutPanier.php?id_produit=<?= $produit->id_produit; ?>&compt=<?= $s ?>'><svg width='3em' height='3em' viewBox='0 0 16 16' class='bi bi-file-plus-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>  <path fill-rule='evenodd' d='M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z'/></svg></a><br><br>
		
		
		<a  style="color: grey;"> <?= "Quantite: ".$produit->quantite."<br>" ?></a>
		<a href="#" style="color: grey;"><?= "Reference Produit: ".$produit->reference?></a>

		<br><br><br>
  	</div>
  </div>
<?php endforeach;?>
</div>
</div>
 </body>
 <?php require_once('footer.php');?>
 </html>



