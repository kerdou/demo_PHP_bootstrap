<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ"
        crossorigin="anonymous">
    <link rel="stylesheet" href="factorisation/styles.css">  

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>

</head>

<body class="bg-light">
    <div id="container" class="mx-auto">
            
        <?php 
        include 'factorisation/headers/indexheader.html';

        //récupération des paramétres de connexion à la base de données
        $file = "factorisation/connectSettings.php";
        if(file_exists($file)) {
            include $file;
        } else {
            echo "fichier $file introuvable";
        }

        ?>
        <h2>Liste des 5 derniers modèles modifiés</h2>
        <table class="table table-striped">
            <thead>
                <tr class="table-active">
                    <th>Modèles</th>
                    <th>Références</th>
                    <th class="text-center">Quantités</th>            
                    <th>Fournisseurs</th>             
                    <th>Commentaires</th>
                </tr>
            </thead>
            <tbody>    
                <?php
                    //récupération de toutes les données de la table produits et réupération des idFourn et nomFourn de la table fournisseurs
                    //liaison de idFourn entre les 2 tables pour que le nom du fournisseur puisse apparaitre dans le tableau et non son numéro d'ifFourn
                        
                    $requestProduits = 'SELECT produits.*, fournisseurs.idFourn, fournisseurs.nomFourn FROM produits, fournisseurs WHERE produits.idFourn = fournisseurs.idFourn ORDER BY modiftime DESC LIMIT 5';
                    $resultProduits = $connexion->query($requestProduits);
                    $recupProduits = $resultProduits->fetchAll(PDO::FETCH_ASSOC);

                    //Création d'une ligne par produit avec une case par information
                    //création des boutons de modification et suppression
                    foreach($recupProduits as $valueProduits) {
                        echo '<tr>';
                            echo '<td>'.$valueProduits["nomProd"].'</td>';                    
                            echo '<td>'.$valueProduits["refProd"].'</td>';
                            echo '<td class="text-center">'.$valueProduits["qteProd"].'</td>';                        
                            echo '<td>'.$valueProduits["nomFourn"].'</td>';
                            echo '<td>'.$valueProduits["commProd"].'</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
        <br>
            
        <h2>Liste des 5 derniers fournisseurs modifiés</h2>
        <table class="table table-striped">
            <thead>
                <tr class="table-active">
                    <th>Sociétés</th>
                    <th>Adresses</th>
                    <th class="text-center">Codes postaux</th>             
                    <th>Villes</th>
                    <th>Commentaires</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // récupération de toutes les données de la table fournisseurs
                    $requestFourn = "SELECT * FROM fournisseurs ORDER BY modiftime DESC LIMIT 5";
                    $resultFourn = $connexion->query($requestFourn);
                    $recupFourn = $resultFourn->fetchAll(PDO::FETCH_ASSOC);

                    // affichage de toutes les données de la table fournisseurs sauf le idFourn qui n'est pas necessaire pour les users. 
                    // Le idFourn sert uniquement aux boutons de modification et de suppression.
                    foreach($recupFourn as $valueFourn) {
                        echo '<tr>';
                            echo '<td>'.$valueFourn["nomFourn"].'</td>';
                            echo '<td>'.$valueFourn["adrFourn"].'</td>';
                            echo '<td class="text-center">'.$valueFourn["cpFourn"].'</td>';
                            echo '<td>'.$valueFourn["villeFourn"].'</td>';
                            echo '<td>'.$valueFourn["commFourn"].'</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>