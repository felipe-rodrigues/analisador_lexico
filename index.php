<?php

$codigo = $_POST[codigo];

//Gambiarra 
//separa pontuacoes e operadores de strings ex program; = program ;
$pontos = array('(',')',';',',','.','}','{','&&','||','>=','<=','!=','>','<','=','+i','-i','di');
$pontos_espacados = array(' ( ',' ) ',' ; ',' , ',' . ',' } ',' { ',' && ',' || ','+i','-i','di',' > ',' < ',' = ',' >= ',' <= ',' != ');
$tabela_simbolos=array();
$codigo = str_replace($pontos,$pontos_espacados , $codigo);

Analisador($codigo);

function Analisador($string){
        echo "<pre>";
      for($i=0;$i<strlen($string);$i++){
        if(!ctype_space($string[$i]) && !ctype_cntrl($string[$i]))
              $i= encontraPalavra($i, $string);
    }
    echo "</pre>";
    
    echo "<pre>";
    echo "Tabela de Símbolos<hr>";
    print_r($GLOBALS[tabela_simbolos]);
    echo "</pre>";
}



function encontraPalavra($j,$code){
            $palavras_reservadas= array("program","var","int","if","else","while","float","string","end");
            $operadores = array("<=",">=","!=","<",">","=");
            $pontos = array("(",")",";",",",".","}","{","&&","||");
            
        $i =0;
        $palavra="";

        while(!ctype_space($code[$j]) && !ctype_cntrl($code[$j])  && $j<  strlen($code)){
            $palavra.= $code[$j];
            $i++;
            $j++;
        }
            
            
        if(in_array($palavra,$palavras_reservadas)){
            echo "[".strtoupper($palavra)."]";
        }
        elseif(ctype_digit($palavra)){
            echo "[NUM,$palavra]";
        }
        elseif(in_array($palavra, $operadores)){
            echo "[OP,$palavra]";
        }
        elseif(in_array($palavra, $pontos)){
            echo "[PT,'$palavra']";
        }
        elseif(ctype_alpha($palavra)){
            $posicao = array_search($palavra, $GLOBALS[tabela_simbolos]);
            if($posicao===false){
                $c = count($GLOBALS[tabela_simbolos]);
                $GLOBALS[tabela_simbolos][$c]= $palavra;
                echo "[ID,".$c."]";
            }
            else{
                echo "[ID,$posicao]";
            }
        }
         elseif(is_string($palavra)){
            echo "[LITERAL,$palavra]";
        }
         
            return $j;
}






