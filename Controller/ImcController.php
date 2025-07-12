<?php

namespace Controller;

use Model\Imcs;
use Exception;
class ImcController{

    private $imcsModel;

    public function __construct(){
        $this->imcsModel = new Imcs();
}
    //CALCULO E CLASSIFICAÇÃO
    public function calculateImc($weight, $height){
        try{

            /*
            $result = [
            "imc": 22.82,
            "BMIrange": "Sobrepeso"
            ]; 
            */

            $result = []; 
            if(isset($weight) and isset($height)){
                if($weight> 0 and $height > 0){

                    $imc = round($weight / ($height * $height), 2);
                    $result["imc"] = $imc;
                        
                    $result["BMIrange"] = match (true){
                        $imc < 18.5 => "Baixo Peso",
                        $imc >= 18.5 and $imc < 25 => "Peso normal",
                        $imc >= 25 and $imc < 30 => "Sobrepeso",
                        $imc >= 30 and $imc < 35 => "Obesidade grau I",
                        $imc >= 35 and $imc < 40 => "Obesidade grau II",
                        default => "Obesidade grau III"};

                    } else {
                        $result["BMIrange"] = "O peso e a altura devem conter valor positivos.";
                    }

                } else {
                    $result["BMIrange"] = "Informe peso e altura para obter o seu IMC.";
                } 
                return $result;
            }  catch(Exception $error){
            echo "Erro ao calcular IMC: " . $error->getMessage();
            return false;
            }

        }

    public function saveImc($weight, $height, $IMCresult ){
        return $this->imcsModel->createImc($weight, $height, $IMCresult);

    }

}
?>