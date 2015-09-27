<?php

die('A');
require 'Lexico.php';
$codigo = $_POST[codigo];
$lexico = new Lexico($codigo);
$lexico->Analisador();
$results = $lexico->getContens();

echo $results;












