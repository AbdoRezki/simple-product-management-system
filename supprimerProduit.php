<?php 
    include('connexion.php');
    session_start();
    $ref=$_GET["ref"];
    $con->exec("DELETE from `produit` where `reference`='$ref'");
    echo "<script>location.assign('accueil.php')</script>";
    ?>