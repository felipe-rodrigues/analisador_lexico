<?php

/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 14/09/2015
 * Time: 20:02
 */
class Lexico
{
    private $codigo;
    private $tokens=array();
    private $tableSimbolos=array();
    private $contents_resultado;
    private  $palavras_reservadas= array("program","begin","endprogram","var","int","if","else","while","float","string","end");
    private  $operadores = array("<=",">=","!=","<",">","=");
    private  $pontos = array("(",")",";",",",".","}","{","&&","||");


    function __construct($codigo){
        $pontos = array('(',')',';',',','.','}','{','&&','||','>=','<=','!=','>','<','=','+i','-i','di');
        $pontos_espacados = array(' ( ',' ) ',' ; ',' , ',' . ',' } ',' { ',' && ',' || ','+i','-i','di',' > ',' < ',' = ',' >= ',' <= ',' != ');
        $this->codigo = str_replace($pontos,$pontos_espacados , $codigo);
    }

    function Analisador(){
        ob_start();
        echo "<pre>";
        for($i=0;$i<strlen($this->codigo);$i++){
            if(!ctype_space($this->codigo[$i]) && !ctype_cntrl($this->codigo[$i]))
                $i= $this->encontraPalavra($i, $this->codigo);
        }
        echo "</pre>";

        echo "<pre>";
        echo "Tabela de Símbolos<hr>";
        print_r($this->tableSimbolos);
        echo "</pre>";
        $this->contents_resultado = ob_get_contents();
        ob_end_clean();
    }

  private  function encontraPalavra($j,$code){
        $i =0;
        $palavra="";
        while(!ctype_space($code[$j]) && !ctype_cntrl($code[$j])  && $j<strlen($code)){
            $palavra.= $code[$j];
            $i++;
            $j++;
        }

        if(in_array($palavra,$this->palavras_reservadas)){
            echo "[".strtoupper($palavra)."]";
            $this->tokens[]="[".strtoupper($palavra)."]";
        }
        elseif(ctype_digit($palavra)){
            echo "[NUM,$palavra]";
            $this->tokens[]="[NUM,$palavra]";
        }
        elseif(in_array($palavra, $this->operadores)){
            echo "[OP,$palavra]";
            $this->tokens[]="[OP,$palavra]";
        }
        elseif(in_array($palavra, $this->pontos)){
            echo "[PT,'$palavra']";
            $this->tokens[]="[PT,'$palavra']";
        }
        elseif(ctype_alpha($palavra)){
            $posicao = array_search($palavra, $this->tableSimbolos);
            if($posicao===false){
                $c = count($this->tableSimbolos);
               $this->tableSimbolos[$c]= $palavra;
                echo "[ID,".$c."]";
                $this->tokens[]="[ID,".$c."]";
            }
            else{
                echo "[ID,$posicao]";
                $this->tokens[]="[ID,$posicao]";
            }
        }
        elseif(is_string($palavra)){
            echo "[LITERAL,$palavra]";
            $this->tokens[]="[LITERAL,$palavra]";
        }

        return $j;
    }

    public  function getContens(){
        return $this->contents_resultado;
    }

    public function getTabelaSimbolos(){
        return $this->tableSimbolos;
    }

    public  function getTokens(){
        return $this->tokens;
    }
}
