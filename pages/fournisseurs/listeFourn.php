<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des fournisseurs</title>
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
        //récupération du header propre aux fournisseurs
        include "../../factorisation/headers/fournheader.html"; 
        //vérification de la présence du fichier content les paramétres de connexion à la base
        include "../../factorisation/connectCheck.php";
        ?>

        <table class="table table-striped">
            <thead>
                <tr class="table-active">
                    <th class="align-middle">Sociétés</th>
                    <th class="align-middle">Adresses</th>
                    <th class="text-center align-middle">Codes postaux</th>             
                    <th class="align-middle">Villes</th>
                    <th class="align-middle">Commentaires</th>
                    <th class="align-middle text-center"></th>
                    <th class="align-middle text-center"></th>
                </tr>
            </thead>
            <tbody>    
                <?php
                    // récupération de toutes les données de la table fournisseurs
                    $requestFourn = "SELECT * FROM fournisseurs ORDER BY nomFourn";
                    $resultFourn = $connexion->query($requestFourn);
                    $recupFourn = $resultFourn->fetchAll(PDO::FETCH_ASSOC);

                    // afficaage de toutes les données de la table fournisseurs sauf le idFourn qui n'est pas necessaire pour les users. 
                    // Le idFourn sert uniquement aux boutons de modification et de suppression.
                    foreach($recupFourn as $valueFourn) {
                            echo '<tr>';
                            echo '<td class="align-middle">'.$valueFourn["nomFourn"].'</td>';
                            echo '<td class="align-middle">'.$valueFourn["adrFourn"].'</td>';
                            echo '<td class="align-middle text-center">'.$valueFourn["cpFourn"].'</td>';
                            echo '<td class="align-middle">'.$valueFourn["villeFourn"].'</td>';
                            echo '<td class="align-middle">'.$valueFourn["commFourn"].'</td>';
                            echo '<td class="align-middle">   
                                    <form action="modifFourn" method="post">
                                        <button type="submit" name="modifButton" class="btn btn-link" value='.$valueFourn["idFourn"].'><i class="far fa-edit fa-2x" style="color:#ABABAB;"></i></button>
                                    </form>
                                </td>';
                            echo '<td class="align-middle">
                                    <form action="supprFournProc" method="post">
                                        <button type="submit" name="supprButton" class="btn btn-link" value='.$valueFourn["idFourn"].'><i class="fas fa-trash fa-2x" style="color:#ABABAB;"></i></button>
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