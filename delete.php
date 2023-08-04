<?php
Session_start();
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
        die();
    }
    $sql = 'DELETE  FROM apprenants WHERE id = :id';
    $query = $db->prepare($sql);
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();
    $_SESSION['message'] = "apprenant supprimé";
    header('Location: index.php');
}else{
    $_SESSION['erreur'] = "l'identifiant n'existe pas";
   header('Location: index.php'); 
}
  

