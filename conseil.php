<?php require_once("header.php");?>

<?php  //fonction qui fait appelle a  la table conseil
$consiel = $DB->Affconsiel(); ?>
 <!DOCTYPE html>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Consiel</title>
 	<link href="PMU/style/bootstrap.css"  type="text/css" rel="stylesheet"/>
 	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

 </head>
 <body>
 	<br><br><h1 align="center">Listes des Conseils:</h1>

 	<h2>Les Montages:</h2>
 	<ul align="center">
 			<?php foreach ($consiel as $consiel): // ici on vient afficher les images de chaque montage et sa description(sert d explication) :?>
 				<li class="col-6 bg-secondary py-4" style=" border: 1px Solid Black;padding: 1em;margin: 0.5em;">
 					<?= $consiel->nom.'<br><br>'?> 

 					<?php echo '<img class="rounded"   src="'.$consiel->image.'"  alt=""/><br><br>'; ?>
 					<?= $consiel->description.'<br><br>'?>
 				</li><br><br>
 			<?php endforeach;  ?>
 	</ul>

 </body>
 	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
 </html>
<?php require_once('footer.php');  ?>