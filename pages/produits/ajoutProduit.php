<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajout de produit</title>
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

        <form action="ajoutProduitProc" method="post" class="w-75 px-0 mx-auto">
            <h2>Ajout de produit</h2>
            <div class="form-group row">         
                <label for="nomProd" class="col-3 col-form-label">Nom :</label>
                <div class="col-5"> 
                    <input type="text" id="nomProd" name="nomProd"  class="form-control"placeholder="Nom du produit"
                        maxlength="45" autofocus autocomplete required />
                </div>
            </div>
            <div class="form-group row">
                <label for="refProd" class="col-3 col-form-label">Référence :</label>
                <div class="col-5"> 
                    <input type="text" id="refProd" name="refProd"  class="form-control"placeholder="Référence du produit"
                    maxlength="5"  autocomplete required />
                </div>
            </div>
            <div class="form-group row">
                <label for="qteProd" class="col-3 col-form-label">Quantité :</label>
                <div class="col-5">
                    <input type="text" id="qteProd" name="qteProd"  class="form-control"placeholder="Quantité"
                    maxlength="11" autocomplete required />
                </div>
            </div>
            <div class="form-group row">
                <label for="idFournSelect" class="col-3 col-form-label">Fournisseur</label>
                <div class="col-5">
                    <select name="idFournSelect" id="idFournSelect" class="form-control">
                        <option value="">Veuillez choisir le fournisseur</option>
                        <?php
                            //récupération des idFourn et nomFourn depuis la table fournisseurs
                            $nomFournSelect = "SELECT idFourn, nomFourn FROM fournisseurs";
                            $nomFournResult = $connexion->query($nomFournSelect);
                            $nomFournFetch = $nomFournResult->fetchAll(PDO::FETCH_ASSOC);
                            // création des <options> du <select> avec idFourn en value et nomFourn en texte affiché pour chacun d'entre-eux
                            foreach ($nomFournFetch as $value) {
                                $elementNumberAndContent = $value["idFourn"].",".$value["nomFourn"];
                                echo "<option value=".$value["idFourn"].">".$value["nomFourn"]."</option>";
                            }    
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="commProd" class="col-3 col-form-label">Commentaire :</label>
                <div class="col-5">
                    <textarea id="commProd" name="commProd"  class="form-control" maxlength="45"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-3 col-form-label"></label>
                <div class="col-5">
                    <input type="reset"class="btn btn-secondary"> <input type="submit" name="validbutton" class="btn btn-secondary"/>
                </div>
            </div>                 
        </form>
    </div>
</body>

</html>