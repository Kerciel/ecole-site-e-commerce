<?php
session_start();
 require_once('header.php');?>
<?php 
//
if (isset($_GET['del'])) {
    $Panier->del($_GET['del']);
}
  ?>
<div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Mon Panier:</span>
      </h4>

      <?php
      //lorsque de l'ajouter d'un produit dans le panier 
      $id_produit = array_keys($_SESSION['panier']);
      if (empty($id_produit)) {
        $produit = array();
      }
      else{
       $produit = $DB->Listproduit('SELECT * FROM produit WHERE id_produit IN ('.implode(',', $id_produit).')');}
        ?>
      <ul class="list-group mb-3">
        <?php foreach ($produit as $produit):
          // on va afficher les produits ou un produit ?>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><?= $produit->description ?></h6>
            <small class="text-muted"><?php echo '<img    src="'.$produit->image.'"  alt=""/><br><br>'; ?></small>
          </div>
          <span class="text-muted"><?= number_format($produit->prix,2,',',' ')."€"?></span><br><b></b>
          <span><?= $_SESSION['panier'][$produit->id_produit]; ?></span>
        </li>
       <a href="Panier.php?del=<?= $produit->id_produit; ?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-excel" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
        <path fill-rule="evenodd" d="M5.18 4.616a.5.5 0 0 1 .704.064L8 7.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 8l2.233 2.68a.5.5 0 0 1-.768.64L8 8.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 8 5.116 5.32a.5.5 0 0 1 .064-.704z"/>
      </svg></a>
      <?php endforeach; ?>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (USD)</span>
          <strong><?= number_format($Panier->Total(),2,',',' ')."€"?></strong>
        </li>
        <?php  
        if (!isset($_SESSION['pseudo'])) {
          echo '<a style="color:red;"> Il faut etre connecter pour commander!</a><br><br>';
        }else{
            $_SESSION['pseudo'];
            echo '<button type="button" class="btn btn-success">Commander</button>';
        }?>
        
      </ul>
</div>

<?php require_once('footer.php');?>