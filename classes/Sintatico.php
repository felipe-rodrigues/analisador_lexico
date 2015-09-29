<?php

/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 14/09/2015
 * Time: 20:04
 */

class Sintatico
{

    private $tokens;
    private $htmlResults;

    public function __construct($tokens){
        $this->tokens=$tokens;
    }

    public function Analisar(){
        $comandosEsperados = array(
            array('PROGRAM','PROGRAM()','VAR'),
            array('VAR','TOP LEVEL()','BEGIN'),
            array('BEGIN','MAIN()','ENDPROGRAM'),
            array('ENDPROGRAM','ENDPROGRAM()')
                                );
      ob_start();
      echo "<pre>";
          for($i=0;$i<count($this->tokens);$i++){
              if(stripos($this->tokens[$i],$comandosEsperados[$i][0])) {
                  echo $comandosEsperados[$i][1];
                  $i = $this->proximaFuncao($i, $comandosEsperados[$i][2]);
                  echo "<h2>    Contador $i</h2>";
              }
          }
      echo "</pre>";
      $this->htmlResults = ob_get_contents();
      ob_end_clean();
    }

    function proximaFuncao($pos,$funcaoesperada){
      for ($i=$pos+1; $i<count($this->tokens) ; $i++) {
          if(stripos($this->tokens[$i],$funcaoesperada)){
            return $i;
            break;
          }

      }
    }

    public function getContens(){
      return $this->htmlResults;
    }


}
