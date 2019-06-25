<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste de produits</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../../factorisation/styles.css">  

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>    
</head>

<body class="bg-light">
    <div id="container" class="mx-auto">
        <?php 
        //récupération du header propre aux produits
        include "../../factorisation/headers/produitsheader.html";
        //vérification de la présence du fichier content les paramétres de connexion à la base
        include "../../factorisation/connectCheck.php";
        ?>

        <table class="table table-striped">
            <thead>
                <tr class="table-active">
                    <th class="align-middle">Modèles</th>
                    <th class="align-middle">Références</th>
                    <th class="text-center align-middle">Quantités</th>            
                    <th class="align-middle">Fournisseurs</th>             
                    <th class="align-middle">Commentaires</th>
                    <th class="align-middle text-center"></th>
                    <th class="align-middle text-center"></th>
                </tr>
            </thead> 
            <tbody>   
                <?php
                    //récupération de toutes les données de la table produits et réupération des idFourn et nomFourn de la table fournisseurs
                    //liaison de idFourn entre les 2 tables pour que le nom du fournisseur puisse apparaitre dans le tableau et non son numéro d'ifFourn
                    $requestProduits = 'SELECT produits.*, fournisseurs.idFourn, fournisseurs.nomFourn FROM produits, fournisseurs WHERE produits.idFourn = fournisseurs.idFourn ORDER BY nomFourn, nomProd';
                    $resultProduits = $connexion->query($requestProduits);
                    $recupProduits = $resultProduits->fetchAll(PDO::FETCH_ASSOC);

                    //Création d'une ligne par produit avec une case par information
                    //création des boutons de modification et suppression
                    foreach($recupProduits as $valueProduits) {
                        echo '<tr>';
                            echo '<td class="align-middle">'.$valueProduits["nomProd"].'</td>';                    
                            echo '<td class="align-middle">'.$valueProduits["refProd"].'</td>';
                            echo '<td class="align-middle text-center">'.$valueProduits["qteProd"].'</td>';                        
                            echo '<td class="align-middle">'.$valueProduits["nomFourn"].'</td>';
                            echo '<td class="align-middle">'.$valueProduits["commProd"].'</td>';
                            echo '<td class="align-middle">   
                                    <form action="modifProduit" method="post">
                                        <button type="submit" name="modifButton" class="btn btn-link" value='.$valueProduits["idProd"].'><i class="far fa-edit fa-2x" style="color:#ABABAB;"></i></button>
                                    </form>
                                </td>';
                            echo '<td class="align-middle">
                                    <form action="supprProduitProc" method="post">
                                        <button type="submit" name="supprButton" class="btn btn-link" value='.$valueProduits["idProd"].'><i class="fas fa-trash fa-2x" style="color:#ABABAB;"></i></button>
                                    </form>
                                </td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>    
</body>

</html>