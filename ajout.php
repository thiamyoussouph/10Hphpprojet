<?php
Session_start();
    
include 'herher.php';


if($_POST){
    if(isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['prenom']) && !empty($_POST['prenom'])
    && isset($_POST['adresse']) && !empty($_POST['adresse'])){
require_once 'cone.php';
        $nom = strip_tags($_POST['nom']);
        $prenom = strip_tags($_POST['prenom']);
        $adresse = strip_tags($_POST['adresse']);
        $sql = "INSERT INTO apprenants(nom,prenom,adresse) VALUES(:nom,:prenom,:adresse)";
        $query = $db->prepare($sql);
        $query->bindValue(':nom',$nom,PDO::PARAM_STR);
        $query->bindValue(':prenom',$prenom,PDO::PARAM_STR);
        $query->bindValue(':adresse',$adresse,PDO::PARAM_STR);
        $query->execute();
        $_SESSION['message'] = "apprenant ajouté";
        header('Location: index.php');
    }else{
        $_SESSION['erreur'] = "le formulaire est incomplet";
    }
}

?>
<div class="row">
<?php
if(!empty($_SESSION['erreur'])){
    echo '<div class="alert alert-danger" role="alert">
    '.$_SESSION['erreur'].'
  </div>';
    $_SESSION['erreur']="";
}
?>
    <div class="col-8 m-2">
    <form method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">nom</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nom">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Prenom</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="prenom">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">adresse email</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="adresse">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
</div>