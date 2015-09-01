<?php

$codigo = $_POST[codigo];
Analisador($codigo);



function Analisador($string){
    
    
    for($i=0;$i<strlen($string);$i++){
        $i= encontraPalavra($i, $string);
    }
}


function encontraPalavra($j,$code){
            $palavras_reservadas= array("program ;","var","int","if","else","while","float","string","end");
            $operadores = array(">","<","=",">=","<=");
            $pontos = array("(",")",";",",",".","}","{","&&","||");
            $tabela_simbolos=array();
    
       
        $i =0;
        $palavra="";
      !ctype_cntrl($code[$j]) || !ctype_space($code[$j]) ;
        while(!ctype_cntrl($code[$j]) || !ctype_space($code[$j]) ){
            echo "[".strtoupper($i);
            echo  "<b>".strtoupper($code[$j])."</b>]";
            $palavra.= $code[$j];
//            $palavra[$i] = $code[$j];
            $i++;
            $j++;
        }
            echo "<pre>";
//            echo "$palavra-";
            
     
        if(in_array($palavra,$palavras_reservadas)){
            echo "<br>";
            echo "[".$palavra."]";
//            echo $palavra;
        }
//        elseif(is_int($palavra)){
//            echo "<NUM,$palavra>;";
//        }
//        elseif(is_string($palavra)){
//            echo "<LITERAL,$palavra>;";
//        }
//        elseif(in_array($palavra, $GLOBALS[operadores])){
//            echo "<OP,$palavra>;";
//        }
//        elseif(in_array($palavra, $GLOBALS[pontos])){
//            echo "<PT,$palavra>;";
//        }
//        else{
//            $posicao = array_search($palavra, $GLOBALS[tabela_simbolos]);
//            if(!$posicao){
//                $GLOBALS[tabela_simbolos][]= $palavra;
//                echo "<ID,".key($GLOBALS[tabela_simbolos]).">;";
//            }
//            else{
//                echo "<ID,$posicao>;";
//            }
            echo "</pre>";
            return $j;
}






