<?php

//vérification de la présence du fichier content les paramétres de connexion à la base
include "../../factorisation/connectCheck.php";

//récupération de l'idFourn depuis la page listeProduits.php
$idProd= $_POST['supprButton'];

//requete de suppression du produits ayant l'idProd demandé et connexion à la base
$delQuery = "DELETE FROM produits WHERE idProd='$idProd'";
$cnxQuery = $connexion->exec($delQuery);

if ($cnxQuery) {
    echo '<script language="javascript">alert("Suppression confirmée");</script>';
} else {
    echo '<script language="javascript">alert("Erreur lors de la suppression, veuillez recommencer");</script>';
}
   
include 'listeProduit.php'; 
?>