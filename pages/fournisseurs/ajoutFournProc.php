<?php 

//vérification de la présence du fichier content les paramétres de connexion à la base
include "../../factorisation/connectCheck.php";

//récupération des valeurs de champs de ajoutFourn.php ou modifFourn.php au moment du clic sur le bouton "Envoyer"
if(isset($_POST['validbutton'])){
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

//cette vérification évite qu'on crée 2 fournisseurs du même nom
$nomFournSelect = 'SELECT nomFourn FROM fournisseurs';
$nomFournResult = $connexion->query($nomFournSelect);
$nomFournFetch = $nomFournResult->fetchAll(PDO::FETCH_ASSOC);
foreach ($nomFournFetch as $value) {
    $nomFournMatch += in_array($nomFourn, $value); //loué soit le saint += qui additionne tous les matchs
}

//vérification des paramétres suivants avant connexion à la base: 
// si un fournisseur du même non existe déjà un message apparaitra et la création du nouveau fournisseur sera empechée
// si le code postal ne contient pas uniquement des chiffres un message apparaitra et la création du nouveau fournisseur sera empechée
// si le nom de la ville contient un caractére spécial interdit ou un chiifre un message apparaitra et la création du nouveau fournisseur sera empechée 
include "../../factorisation/fournChecks.php";

//si toutes les vérifications sont bonnes les données sont envoyées à la base pour la création du fournisseur
if ($nomFournCheck && $cpCheck && $villeCheck == true){            
    $insertContent = $connexion->prepare('INSERT INTO fournisseurs VALUES (NULL, :nomFourn, :adrFourn, :cpFourn, :villeFourn, :commFourn, NOW())');
    $insertContent->bindParam('nomFourn', $nomFourn);
    $insertContent->bindParam('adrFourn', $adrFourn);
    $insertContent->bindParam('cpFourn', $cpFourn);
    $insertContent->bindParam('villeFourn', $villeFourn);
    $insertContent->bindParam('commFourn', $commFourn);
    $insertContent->execute();

    if ($insertContent){
        //si la modification dans la table s'est bien passée 
        echo '<script language="javascript">alert("Ajout du fournisseur confirmé");</script>';
    } else {
        //si la modification dans la table s'est mal passée 
        echo '<script language="javascript">alert("Erreur lors de l\'ajout du fournisseur, veuillez recommencer");</script>';
    }
} else {
    //si nomFournCheck et/ou cpCheck et/ou villeCheck ne sont pas bons, affichage du message d'erreur
    echo '<script language="javascript">alert(alertMessage);</script>';
}

include 'listeFourn.php';

?>