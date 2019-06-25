<?php

//si un fournisseur du même non existe déjà un message apparaitra et la création du nouveau fournisseur sera empechée
if($nomFournMatch){
    echo '<script language="javascript">alertMessage += "Ce fournisseur existe déjà dans la base\n"</script>';
} else {
    $nomFournCheck = true;
}

//si le code postal ne contient pas uniquement des chiffres un message apparaitra et la création du nouveau fournisseur sera empechée 
$cpFournNoMinus = strpos($cpFourn, "-");
if((!is_numeric($cpFourn))||(is_numeric($cpFournNoMinus))){
    echo '<script language="javascript">alertMessage += "Le code postal ne doit comporter que des chiffres\n"</script>';
} else {
    $cpCheck = true;
}

//si le nom de la ville contient un caractére spécial interdit ou un chiifre un message apparaitra et la création du nouveau fournisseur sera empechée
if(preg_match($pregForVille, $villeFourn)){
    echo '<script language="javascript">alertMessage += "Le nom de la ville ne doit comporter aucun chiffre ou caractére spécial"</script>';
} else {
        $villeCheck = true;
}

?>