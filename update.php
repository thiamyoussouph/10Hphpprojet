<?php
Session_start();
    
include 'herher.php';
include 'navbar.php';

if($_POST){
    if(isset($_POST['nom']) && !empty($_POST['nom']) 
    && isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['prenom']) && !empty($_POST['prenom'])
    && isset($_POST['adresse']) && !empty($_POST['adresse'])){
require_once 'cone.php';
        $id = strip_tags($_POST['id']);
        $nom = strip_tags($_POST['nom']);
        $prenom = strip_tags($_POST['prenom']);
        $adresse = strip_tags($_POST['adresse']);
        $sql = "UPDATE apprenants SET nom = :nom, prenom = :prenom, adresse = :adresse WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->bindValue(':nom',$nom,PDO::PARAM_STR);
        $query->bindValue(':prenom',$prenom,PDO::PARAM_STR);
        $query->bindValue(':adresse',$adresse,PDO::PARAM_STR);
        $query->execute();
        $_SESSION['message'] = "apprenant modifier";
        header('Location: index.php');
    }else{
        $_SESSION['erreur'] = "le formulaire est incomplet";
    }
}
if($_GET['id'] && !empty($_GET['id'])){
   
    require_once 'cone.php';
    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM apprenants WHERE id = :id';
    $query = $db->prepare($sql);
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();
    $apprenant = $query->fetch();
    if(!$apprenant){
        $_SESSION['erreur'] = "cet id n'existe pas";
        header('Location: index.php');
    }

    
}else{
    $_SESSION['erreur'] = "l'identifiant n'existe pas";
   header('Location: index.php'); 
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
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nom"value="<?=$apprenant['nom']?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Prenom</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="prenom"value="<?=$apprenant['prenom']?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">adresse email</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="adresse" value="<?=$apprenant['adresse']?>">
  </div>
    <input type="hidden" name="id" value="<?=$apprenant['id']?>">
  
  <button type="submit" class="btn btn-primary">modifier</button>
</form>
    </div>
</div>