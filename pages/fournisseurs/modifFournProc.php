<?php

//vérification de la présence du fichier content les paramétres de connexion à la base
include "../../factorisation/connectCheck.php";

if(isset($_POST['validbutton'])){
$idFourn = $_POST['idFourn'];
$nomFourn = $_POST['nomFourn'];   
$adrFourn = $_POST['adrFourn'];
$cpFourn = $_POST['cpFourn'];
$villeFourn = $_POST['villeFourn'];
$commFourn = $_POST['commFourn'];

//création des variables de vérification des champs nomFourn, cpFourn et villeFourn
//$pregForVille contient la liste des caractéres spéciaux et des chiffres interdits dans les noms de villes
$nomFournMatch = false;
$nomFournCheck = false;
$cpCheck = false;
$pregForVille = '/[\'\/~`\!@#\$%\^&\*\(\)_\+=\{\}\[\]\|;:"\<\>,\.\?\\\]|[0-9]/';
$villeCheck = false;
}

// création du message de statut qui apparaitra dans une fenetre  
echo '<script language="javascript">var alertMessage = ""</script>';

//cette vérification évite qu'on ait 2 fournisseurs du même nom
$nomFournSelect = 'SELECT nomFourn FROM fournisseurs WHERE idFourn != "'.$idFourn.'"';
$nomFournResult = $connexion->query($nomFournSelect);
$nomFournFetch = $nomFournResult->fetchAll(PDO::FETCH_ASSOC);
foreach ($nomFournFetch as $value) {
    $nomFournMatch += in_array($nomFourn, $value); //loué soit le saint += qui additionne tous les matchs
}

// vérification des paramétres suivants avant connexion à la base: 
// si un fournisseur du même non existe déjà un message apparaitra et la création du nouveau fournisseur sera empechée
// si le code postal ne contient pas uniquement des chiffres un message apparaitra et la création du nouveau fournisseur sera empechée
// si le nom de la ville contient un caractére spécial interdit ou un chiifre un message apparaitra et la création du nouveau fournisseur sera empechée 
include "../../factorisation/fournChecks.php";

//si toutes les vérifications sont bonnes les données sont envoyées à la base pour la modification du fournisseur
if ($nomFournCheck && $cpCheck && $villeCheck == true){    
    $updateContent = $connexion->prepare('UPDATE fournisseurs SET nomFourn= :nomFourn, adrFourn= :adrFourn, cpFourn= :cpFourn, villeFourn= :villeFourn, commFourn= :commFourn, modiftime= NOW() WHERE idFourn = :idFourn');
    $updateContent->bindParam('idFourn', $idFourn);    
    $updateContent->bindParam('nomFourn', $nomFourn);
    $updateContent->bindParam('adrFourn', $adrFourn);
    $updateContent->bindParam('cpFourn', $cpFourn);
    $updateContent->bindParam('villeFourn', $villeFourn);
    $updateContent->bindParam('commFourn', $commFourn);       
    $updateContent->execute();
    
    if ($updateContent){
        //si la modification dans la table s'est bien passée 
        echo '<script language="javascript">alert("Modification du fournisseur confirmée");</script>';
    } else {
        //si la modification dans la table s'est mal passée 
        echo '<script language="javascript">alert("Erreur lors de la modification du fournisseur, veuillez recommencer");</script>';
    }
} else {
    //si cpCheck et/ou villeCheck ne sont pas bons, affichage du message d'erreur
    echo '<script language="javascript">alert(alertMessage);</script>';
}

include 'listeFourn.php';

?>