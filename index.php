<?php

require 'classes/Lexico.php';
require 'classes/Sintatico.php';
ini_set('charset','UTF-8');

$lexico = new Lexico($_POST['codigo']);
$lexico->Analisador();
$results = $lexico->getContens();
$token = $lexico->getTokens();
$resultLexio = $lexico->getContens();
echo $resultLexio;

$sintatico = new Sintatico($token);
$sintatico->Analisar();
$results = $sintatico->getContens();
echo $results;
