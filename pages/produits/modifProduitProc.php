<?php
//vérification de la présence du fichier content les paramétres de connexion à la base
include "../../factorisation/connectCheck.php";

//récupération des valeurs des champs de la page modifProduit.php au moment du clic sur le bouton Envoyer
if(isset($_POST['validbutton'])){
    $idProd = $_POST['idProd'];
    $refProd = $_POST['refProd'];   
    $nomProd = $_POST['nomProd'];
    $qteProd = $_POST['qteProd'];
    $idFournSelectExplode = explode(',',$_POST['idFournSelect']);
    $idFourn = $idFournSelectExplode[0];
    $commProd = $_POST['commProd']; 

    //création des variables d'absence de doublons de references, de vérification de la quantité et du choix du produit
    $refProdMatch = false;
    $refProdCheck = false;
    $qteProdCheck = false;
    $idFournCheck = false;   
}

//péparation du message de statut
echo '<script language="javascript">var alertMessage = ""</script>';

//récupération des références produits depuis la table produits
//puis vérification pour voir si une référence existe déjà
$refProdSelect = 'SELECT refProd FROM produits WHERE idProd != "'.$idProd.'"';
$refProdResult = $connexion->query($refProdSelect);
$refProdFetch = $refProdResult->fetchAll(PDO::FETCH_ASSOC);
foreach ($refProdFetch as $value) {
    $refProdMatch += in_array($refProd, $value); //loué soit le saint += qui additionne tous les matchs
}    

//vérification des paramtères suivants avant connexion à la base: 
//si la référence existe déjà un message apparaitra
//si la quantitié inclue autre chose que des chiffres égaux à zéro ou positifs un message apparaitra
//si aucun fournisseur n'a été selectionné un message apparaitra
include "../../factorisation/produitChecks.php";

if ($refProdCheck && $qteProdCheck && $idFournCheck == true){
    //Si les 3 vérifications sont bonnes alors la modification du produit dans la table est lancé
    $updateContent = $connexion->prepare('UPDATE produits SET refProd= :refProd, nomProd= :nomProd, qteProd= :qteProd, commProd= :commProd, idFourn= :idFourn , modiftime= NOW() WHERE produits.idProd = :idProd');
    $updateContent->bindParam('idProd', $idProd);    
    $updateContent->bindParam('refProd', $refProd);
    $updateContent->bindParam('nomProd', $nomProd);
    $updateContent->bindParam('qteProd', $qteProd);
    $updateContent->bindParam('commProd', $commProd);
    $updateContent->bindParam('idFourn', $idFourn);       
    $updateContent->execute();
    
    if ($updateContent){
        //Si la modification dans la table s'est bien passé
        echo '<script language="javascript">alert("Modification du produit confirmée");</script>';
    } else{
        //Si la modification dans la table s'est mal passé
        echo '<script language="javascript">alert("Erreur lors de la modification du produit, veuillez recommencer");</script>';
    }

} else {
    //Si au moins une des 2 vérifications n'est pas bonne alors un message apparait
    echo '<script language="javascript">alert(alertMessage);</script>';
}

include 'listeProduit.php';

?>