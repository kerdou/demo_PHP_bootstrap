<?php

//si la référence existe déjà un message apparaitra
if($refProdMatch){
    echo '<script language="javascript">alertMessage += "Cette référence existe déjà dans la base\n"</script>';
} else {
    $refProdCheck = true;
}

//si la quantitié inclue autre chose que des chiffres égaux à zéro ou positifs un message apparaitra
if((!is_numeric($qteProd)) || ($qteProd < 0)){
    echo '<script language="javascript">alertMessage += "La quantité ne doit comporter que des chiffres\n"</script>';
} else {
    $qteProdCheck = true;
}

//si aucun fournisseur n'a été selectionné un message apparaitra
if (empty($idFourn)){
    echo '<script language="javascript">alertMessage += "Veuillez selectionner un fournisseur\n"</script>';
} else {
    $idFournCheck = true;
}

?>
