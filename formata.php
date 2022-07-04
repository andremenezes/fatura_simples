<?php

include("ManipulaArquivo.php");


$short = 'f::'; //php tarefa.php -f="caminho do arquivo"
$long = [
    'file::' //php tarefa.php --file="caminho do arquivo"
];

$options = getopt($short,$long);
$comand = array_key_first($options);


switch ($comand){
    case 'f':
    case 'file':
        $cl = new ManipulaArquivo();
        $cl->arquivo = $options[$comand];
        $cl->validaArquivo();
        break;

    default:
        print_r("Comando invalido \n");
}
