<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajout de fournisseur</title>
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
        ?> 

        <form action="ajoutFournProc" method="post" class="w-75 px-0 mx-auto">
            <h2>Ajout de fournisseur</h2>
            <div class="form-group row">
                <label for="nomFourn" class="col-3 col-form-label">Société :</label> 
                <div class="col-5">
                    <input type="text" id="nomFourn" name="nomFourn" class="form-control" placeholder="Nom du fournisseur"
                    maxlength="45" autofocus autocomplete required />                    
                </div>            
            </div>    
            <div class="form-group row">
                <label for="adrFourn" class="col-3 col-form-label">Adresse :</label>
                <div class="col-5">
                    <input type="text" id="adrFourn" name="adrFourn" class="form-control" placeholder="Adresse du fournisseur"
                    maxlength="45" autocomplete required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="cpFourn" class="col-3 col-form-label">Code postal :</label>
                <div class="col-5">
                    <input type="text" id="cpFourn" name="cpFourn" class="form-control" placeholder="Code postal du fournisseur"
                    minlength="5" maxlength="5" autocomplete required />                   
                </div>
            </div>
            <div class="form-group row">
            <label for="villeFourn" class="col-3 col-form-label">Ville :</label>
                <div class="col-5">
                    <input type="text" id="villeFourn" name="villeFourn" class="form-control" placeholder="Ville du fournisseur"
                    autocomplete required />
                </div>
            </div>
            <div class="form-group row">
                <label for="commFourn" class="col-3 col-form-label">Commentaire :</label>
                <div class="col-5">
                    <textarea id="commFourn" name="commFourn" maxlength="45" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="n" class="col-3 col-form-label"></label>
                <div class="col-5">
                    <input type="reset" class="btn btn-secondary"> <input type="submit" name="validbutton" class="btn btn-secondary"/> 
                </div>
            </div>            
        </form>
    </div>
</body>

</html>