<?php echo $_GET['compt']; //valeur de s et aussi le pseudo de l'utilisateur connecter ?>
<?php require_once('header.php'); 
if ($_GET['compt'] != NULL) // ici si compt est different de NULL
{
	

	if (isset($_GET['id_produit'])) {// si il y a  bien une valeur  
	 	$produit = $DB->Listproduit('SELECT id_produit FROM produit WHERE id_produit=:id_produit', array('id_produit' => $_GET['id_produit']));
	 	if (empty($produit)) {
	 		die('Le produit n existe pas');
	 	}
	 	$Panier->AjoutPanier($produit[0]->id_produit); // on ajoute le produit au panier:
	 	$message = "L'article a bien été ajouter dans votre panier";// ce message sera affichier 
	 	?>
	 	<div class="alert alert-success">
	 		<a class="close" href="index.php">X</a>
	 		<?php echo $message;  ?>
	 	</div>
	 	<?php unset($message);  ?>
<?php  	 
	}
	 else {
	 	die('Vous n avez pas sélectionner de produit à ajouter aux panier' );
	 }
}
else{ // si on est pas connecte c'est à dire que compt n'a pas de valeurs 
		die('Il faut avoir <a href="inscription.php"> un compte</a> pour ajouter des produits dans votre panier');
}

?>