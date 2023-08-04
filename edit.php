<?php
Session_start();
include 'herher.php';
include 'navbar.php';

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
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <div class=card>
           <h1>detaaaaaail de l apprenants <?=$apprenant["nom"]?></h1>
            <p> <?=$apprenant["nom"]?></p>
            <p> <?=$apprenant["prenom"]?></p>
            <p> <?=$apprenant["adresse"]?></p>
        </div>
        <a href="index.php" class="btn btn-success m-2">retour</a>
    </body>
    </html>
