<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modification de fournisseur</title>
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

            // récupération de l'idFourn depuis la page listeFourn.php
            $idFourn= $_POST["modifButton"];

            // récupération de toutes les données du fournisseur demandé
            $requestFourn = "SELECT * FROM fournisseurs WHERE idFourn = $idFourn";
            $resultFourn = $connexion->query($requestFourn);
            $recupFourn = $resultFourn->fetchAll(PDO::FETCH_ASSOC);
            foreach ($recupFourn as $value) {
                $idFourn = $value["idFourn"];
                $nomFourn = $value["nomFourn"];   
                $adrFourn = $value["adrFourn"];
                $cpFourn = $value["cpFourn"];
                $villeFourn = $value["villeFourn"];
                $commFourn = $value["commFourn"]; 
            }
        ?>                

        <form action="modifFournProc" method="post" class="w-75 px-0 mx-auto">
            <h2>Modification du fournisseur</h2>
            <!-- Affichage des données du fournisseur dans les champs-->
            <input type="text" id="idFourn" name="idFourn" style="display: none" value="<?php if(isset($idFourn)) echo $idFourn; else echo ""?>"/>
            <div class="form-group row">
                <label for="nomFourn" class="col-3 col-form-label">Société :</label> 
                <div class="col-5">
                    <input type="text" id="nomFourn" name="nomFourn" class="form-control" value="<?php if(isset($nomFourn)) echo $nomFourn; else echo ""?>"
                    maxlength="45" autofocus autocomplete required />
                </div>
            </div>
            <div class="form-group row">
                <label for="adrFourn" class="col-3 col-form-label">Adresse :</label>
                <div class="col-5">
                    <input type="text" id="adrFourn" name="adrFourn" class="form-control" value="<?php if(isset($adrFourn)) echo $adrFourn; else echo ""?>"
                    maxlength="45" autocomplete required />
                </div>
            </div>
            <div class="form-group row">
                <label for="cpFourn" class="col-3 col-form-label">Code postal :</label>
                <div class="col-5">
                    <input type="text" id="cpFourn" name="cpFourn" class="form-control" value="<?php if(isset($cpFourn)) echo $cpFourn; else echo ""?>"
                    minlength="5" maxlength="5" autocomplete required />
                </div>
            </div>   
            <div class="form-group row">
                <label for="villeFourn" class="col-3 col-form-label">Ville :</label>
                <div class="col-5">
                    <input type="text" id="villeFourn" name="villeFourn" class="form-control" value="<?php if(isset($villeFourn)) echo $villeFourn; else echo ""?>"
                    maxlength="45" autocomplete required />
                </div>
            </div>     
            <div class="form-group row">
                <label for="commFourn" class="col-3 col-form-label">Commentaire :</label>
                <div class="col-5">
                    <textarea id="commFourn" name="commFourn" class="form-control" maxlength="45"><?php if(isset($commFourn)) echo $commFourn; else echo ""?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="n" class="col-3 col-form-label"></label>
                <div class="col-5">         
                    <input type="reset" class="btn btn-secondary"> <input type="submit" name="validbutton" class="btn btn-secondary"/>
            </div>        
        </form>
    </div>
</body>

</html>