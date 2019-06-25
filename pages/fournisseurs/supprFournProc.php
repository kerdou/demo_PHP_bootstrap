<?php

    //vérification de la présence du fichier content les paramétres de connexion à la base
    include "../../factorisation/connectCheck.php";

    //création du message de statut qui apparaitra dans une fenetre  
    echo '<script language="javascript">var alertMessage = ""</script>';

    //récupération de l'idFourn depuis la page listefourn.php
    $idFourn = $_POST['supprButton'];

    //récupération de données depuis les tables produits et fournisseurs pour savoir combien de produits sont encore rattachés au fournisseur à supprimer
    $prodCheckQuery = "SELECT produits.idFourn, fournisseurs.idFourn, fournisseurs.nomFourn FROM produits, fournisseurs WHERE produits.idFourn = '$idFourn' AND produits.idFourn = fournisseurs.idFourn";
    $resultProdCheck = $connexion->query($prodCheckQuery);
    $recupProdCheck = $resultProdCheck->fetchAll(PDO::FETCH_ASSOC);
    $fournUsedBy = count($recupProdCheck);

    //si au moins 1 produit est rattaché au fournisseur à supprimer alors un message apparait
    if ($fournUsedBy > 0) {
        $actualFourn = $recupProdCheck["0"]["nomFourn"];
        echo '<script language="javascript">alert("Impossible de supprimer ce fournisseur\nNombre de produits rattachés à ce fournisseur: " + '.$fournUsedBy.' + "\nSupprimez ces produits ou rattachez-les à un autre fournisseur avant de supprimer '.$actualFourn.'");</script>';
    } else {
        //si aucun produit n'est rattaché au fournisseur à supprimer alors la procédure de suppression continue 
        $delQuery = "DELETE FROM fournisseurs WHERE idFourn='$idFourn'";
        $cnxQuery = $connexion->exec($delQuery);

        if ($cnxQuery) {
            echo '<script language="javascript">alert("Suppression confirmée");</script>';
        } else {
            echo '<script language="javascript">alert("Erreur lors de la suppression, veuillez recommencer");</script>';
        }
    }

    include 'listeFourn.php';    
?>

