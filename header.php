<?php 
require_once ("ConnexionBdd.php");
require_once('Panier.class.php');
$DB = new connect();
$Panier = new Panier($DB);
//ici on a les initialisations des classes
?>

<?php 
//session_start();
require_once('header.php');  ?>


<!DOCTYPE html>
<html>
	<head>
			<link href="PMU/style/bootstrap.css"  type="text/css" rel="stylesheet"/>
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
	<head>
	<header class="titre" align="center">
			<nav class="navbar navbar-dark bg-dark">
			    <a class="navbar-brand" href="#">Piéce Mecano à l'Unité</a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="navbarText">
				    <ul class="navbar-nav mr-auto">
				      <li class="nav-item active">
				        <a class="nav-link" href="index.php">Acceuil </a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="Conseil.php">Conseil</a>
				      </li>
				      <?php 
						$compte = NULL;
						$s = Null;
						if (!isset($_SESSION['pseudo'])) {
								echo '<li><a style="color:red;"> Vous n etes pas connecter!</a></li>';
						}else{
								 $s = $_SESSION['pseudo'];
								 $compte = $DB->connexion($s);
								 

						}   

						?>
				      <?php if (!isset($_SESSION['pseudo'])) {
				      echo '<li class=nav-item">
				        <a class="nav-link" href="inscription.php">Inscription</a>
				      </li>
				     <li class="nav-item">
				        <a class="nav-link" href="connection.php">Connexion</a>
				      </li>';
				      } 
				      else{
				      echo '<li class="nav-item">
				        <a class="nav-link" href="deconnexion.php">Deconnexion</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="compte.php">Votre compte</a>
				      </li>';
				      }
				      ?>
				        
				      <li class="nav-item">
				      	<a href="Panier.php" style="color: green"><svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-cart4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
						</svg></a>
				      </li>
				    </ul>
				  </div>
			</nav>
	</header>


	<body>
	</body>

</html>
