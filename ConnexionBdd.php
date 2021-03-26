<?php
class Connect
{
    //connexion a la base de donnees
    private $db = '';
    private $connec_host = '';
    private $connec_dbname = '';
    private $connec_pseudo = '';
    private $connec_mdp = '';

    public function __construct ($connec_host = 'localhost' , $connec_dbname = 'p.m.u' , $connec_pseudo = 'root', $connec_mdp = '' ){
        try {
            $this->db = new PDO('mysql:host='.$connec_host.';dbname='.$connec_dbname, $connec_pseudo, $connec_mdp);
            $this->db->exec("SET CHARACTER SET utf8");
            $this->db->exec("SET NAMES utf8");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        catch(PDOException $e) {
            die('<h3>Erreur impossible de se connecter à la base de donnée !</h3> <br/> <a href="../index.php">Retour</a>');
        }
    }

    //affiche la liste des arricles
    public function Listproduit($sql , $data = array() ){
        $req = $this->db->prepare($sql);
        $req->execute(($data));
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    //inscrire un client
    public function Inscrire(){
        if(!isset($_SESSION)){
            session_start();
        }
        $req = $this->db->prepare("INSERT INTO client (id_client, pseudo, mpd, nom, prenom, email, ville, cp, adresse) VALUES (NULL, '$_POST[pseudo]', '$_POST[mpd]', '$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[ville]', '$_POST[cp]', '$_POST[adresse]')");
        $req->execute();
    }

    //affiche la liste des conseils
    public function Affconsiel(){
        $req = $this->db->prepare('SELECT * FROM consiel');
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
    
    //recherche d'un article
    public function Rechproduit($recherche){
        $req = $this->db->prepare('SELECT * FROM produit JOIN listecategorie ON listecategorie.id_categorie = produit.id_categorie WHERE listecategorie.categorie = "'.$recherche.'" or produit.description = "'.$recherche.'"');
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }


    //verifie que le login ou le mail n'existe pas deja pour la creation d un nouveau client
    public function verifDoublon($pseudo, $email)
      {
        $q = $this->db->prepare('SELECT pseudo,email from client where pseudo = "'.$pseudo.'" or email = "'.$email.'"');
        $q->execute();
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        
        if($donnees == false){
          return $donnees;
        }else{
        return $donnees;
        }
    }


    //recupere les informations sur la connexion pour la verifier
    public function connexion($pseudo)
    {
        
        $q = $this->db->prepare('SELECT * FROM client WHERE pseudo="'.$pseudo.'" ');
        $q->execute();
        $donnees = $q->fetchAll(PDO::FETCH_OBJ);
        
        if($donnees == false){
          return $donnees;
        }else{
        return ($donnees);
        }
    }

    public function listecategorie(){
        $req = $this->db->prepare('SELECT * FROM listecategorie');
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function Rechcategorie($c){
         $req = $this->db->prepare('SELECT * FROM produit JOIN listecategorie ON listecategorie.id_categorie = produit.id_categorie WHERE listecategorie.categorie = "'.$c.'"');
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function update($compte,$pseudo, $mpd,$nom,$prenom,$email, $ville,$cp,$adresse){
    $q =  $this->db->prepare( ' UPDATE client SET pseudo = "'.$pseudo.'", mpd = "'.$mpd.'" ,nom = "'.$nom.'" ,prenom = "'.$prenom.'" ,email = "'.$email.'" ,ville = "'.$ville.'" ,cp = "'.$cp.'" ,adresse = "'.$adresse.'" WHERE id_client = "'.$compte[0]->id_client.'" ');
    $q->execute();
    
  }

  //ajoute les coordonnées de payement pour le client
  public function payement($id,$numero,$crytogramme){
    
    $req = $this->db->prepare("INSERT INTO payment (id_payment, id_client, cartenumero, datefin, cryptogramme ) VALUES (NULL, ".$id.",".$numero." ,'$_POST[Date]' ,".$crytogramme.")");
    $req->execute();

  }

  //recupere les données de la table payment en fonction de l'utilisateur
  public function Affpayement($id){
    $req = $this->db->prepare('SELECT * FROM payment  WHERE  id_client = "'.$id->id_client.'"');
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);

  }

}

?>
