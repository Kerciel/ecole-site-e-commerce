<?php 

class panier
{
	private $DB;

	public function __construct($DB)
	{
		if(!isset($_SESSION)){
			session_start();
		}
		if (!isset($_SESSION['panier'])) {
			$_SESSION['panier'] = array();
		}

		$this->DB = $DB;
	}

	//ajouter un article du panier
	public function AjoutPanier($id_produit)
	{
		if (isset($_SESSION['panier'][$id_produit])) {
			$_SESSION['panier'][$id_produit]++;
		}else{
		$_SESSION['panier'][$id_produit] = 1;
		}
	}

	//supprimer un article du panier
	public function del($id_produit){
		unset($_SESSION['panier'][$id_produit]);
	}
	//calcule la somme total pour les articles 
	public function Total(){
		$total = 0;
		$id_produit = array_keys($_SESSION['panier']);
      if (empty($id_produit)) {
        $produit = array();
      }
      else{
       $produit = $this->DB->Listproduit('SELECT id_produit, prix FROM produit WHERE id_produit IN ('.implode(',', $id_produit).')');}
		foreach ($produit as $produit) {
			$total += $produit->prix*$_SESSION['panier'][$produit->id_produit];
		}
		return $total;
	}


}

?>