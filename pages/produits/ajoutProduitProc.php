<?php

//vérification de la présence du fichier content les paramétres de connexion à la base
include "../../factorisation/connectCheck.php";

//récupération des données depuis la base ajoutProduit.php au moment du clic sur "Envoyer"
if(isset($_POST['validbutton'])){
    $refProd = $_POST['refProd'];   
    $nomProd = $_POST['nomProd'];
    $qteProd = $_POST['qteProd'];
    $idFournSelectExplode = explode(',',$_POST['idFournSelect']);
    $idFourn = $idFournSelectExplode[0];
    $commProd = $_POST['commProd']; 

    //création des variables de vérification des differents référence, quantité et idFourn champs
    $refProdMatch = false;
    $refProdCheck = false;
    $qteProdCheck = false;
    $idFournCheck = false;   
}

//Préparation du message de statut
echo '<script language="javascript">var alertMessage = ""</script>';

//récupération des références produits depuis la table produits
//puis vérification pour voir si une référence existe déjà
$refProdSelect = 'SELECT refProd FROM produits';
$refProdResult = $connexion->query($refProdSelect);
$refProdFetch = $refProdResult->fetchAll(PDO::FETCH_ASSOC);
foreach ($refProdFetch as $value) {
    $refProdMatch += in_array($refProd, $value); //loué soit le saint += qui additionne tous les matchs
}    

//vérification des paramétres suivants avant connexion à la base: 
//si la référence existe déjà un message apparaitra
//si la quantitié inclue autre chose que des chiffres égaux à zéro ou positifs un message apparaitra
//si aucun fournisseur n'a été selectionné un message apparaitra
include "../../factorisation/produitChecks.php";

if ($qteProdCheck && $idFournCheck && $refProdCheck == true){
    //Si les 3 vérifications sont bonnes alors l'ajout du produit dans la table est lancé 
    $insertContent = $connexion->prepare('INSERT INTO produits VALUES (NULL, :refProd, :nomProd, :qteProd, :commProd, :idFourn, NOW())');
    $insertContent->bindParam('refProd', $refProd);
    $insertContent->bindParam('nomProd', $nomProd);
    $insertContent->bindParam('qteProd', $qteProd);
    $insertContent->bindParam('commProd', $commProd);
    $insertContent->bindParam('idFourn', $idFourn);       
    $insertContent->execute();
    
    if($insertContent){
        //Si l'ajout dans la table s'est bien passé
        echo '<script language="javascript">alert("Ajout du produit est confirmé");</script>';
    } else{
        //Si l'ajout dans la table s'est mal passé
        echo '<script language="javascript">alert("Erreur lors de l\'ajout du produit, veuillez recommencer");</script>';
    }
} else {
    //Si au moins une des 3 vérifications n'est pas bonne alors un message apparait
    echo '<script language="javascript">alert(alertMessage);</script>';
}

include 'listeProduit.php';

?>