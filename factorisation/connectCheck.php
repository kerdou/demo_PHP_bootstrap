<?php
//récupération des paramétres de connexion à la base de données
$file = "../../factorisation/connectSettings.php";
if(file_exists($file)) {
    include $file;
} else {
    echo "fichier $file introuvable";
}


?>