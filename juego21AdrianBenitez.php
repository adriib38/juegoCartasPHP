<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego21</title>

    <meta http-equiv="expires" content="Sat, 07 feb 2016 00:00:00 GMT">

    <link rel="stylesheet" href="styles\style.css">
</head>
    <body>
        <?php
            include("cabecera.inc.php");
        
            include('array21.php');

            $cartas_ = array();
            $jugadores = [
                ["nombre"=>"Banca", "cartas_"=>$cartas_, "puntos"=>0, "estado"=>0], 
                ["nombre"=>"Albert", "cartas_"=>$cartas_, "puntos"=>0, "estado"=>0], 
                ["nombre"=>"Armin", "cartas_"=>$cartas_, "puntos"=>0, "estado"=>0], 
                ["nombre"=>"Rick", "cartas_"=>$cartas_, "puntos"=>0, "estado"=>0], 
                ["nombre"=>"Carles", "cartas_"=>$cartas_, "puntos"=>0, "estado"=>0], 
                ["nombre"=>"Laura", "cartas_"=>$cartas_, "puntos"=>0, "estado"=>0], 
            ];

            shuffle($cartas);

            //Repartir
            foreach($jugadores as $jugador){
                //A jugadores
                if($jugador["nombre"]!="Banca"){
                    for ($i = 0; $i < 2; $i++) {
                        $jugador["cartas_"][] = array_pop($cartas);
                    }
                }else{ //A banca
                    for ($i = 0; $i < 2; $i++) {
                        $jugador["cartas_"][] = array_pop($cartas);
                    }
                    
                }
                //Vamos añadiendo a cada jugador a la nueva lista.
                $j[] = $jugador; 
                        
            }  
            calcularPuntos($j);

            function calcularPuntos($j){
                global $cartas;
                foreach($j as $jugador){
                    $puntos = 0;

                    for ($i = 0; $i <= count($jugador["cartas_"])-1; $i++) {
                        $cartaJugador = ($jugador["cartas_"][$i]);
                        
                        /*
                        Si es AS; Si los puntos que llevamos es menor a 10:
                            AS vale 11;
                        Si no: AS vale 1;
                        */
                        if($cartaJugador["valor"] == 11){
                            if($puntos <= 10){
                                $puntos = $puntos + 11;
                            }else{
                                $puntos = $puntos + 1;
                            }
                        }else{
                            $puntos = $puntos + $cartaJugador["valor"];
                        }
                        
                        //Añadir otra carta si tiene menos de 14 puntos          
                        //&& $jugador["nombre"] != "Banca"          
                        if($puntos < 14 ){ 
                            $jugador["cartas_"][] = array_pop($cartas);
                        }

                    }
                    $jugador["puntos"] = $puntos;
                    
                    $j_[] = $jugador;
                }
                verCartas($j_);
            }

            function verCartas($j){
                foreach($j as $jugador) {
                    $estadoJugador = 0;

                    $puntosBanca = ($j[0]["puntos"]);

                    if($jugador["puntos"] > 21){
                        $jugador["estado"] = 0;
                    }else{
                        //Comparar puntos jugador con puntos banca

                        if($jugador["nombre"] == "Banca"){
                            if($jugador["puntos"] > 21) $jugador["estado"] = 0;
                            if($jugador["puntos"] <= 21) $jugador["estado"] = 1;
                            
                        }else{
                            if($jugador["puntos"] > $puntosBanca) $jugador["estado"] = 1; //GANA JUGADOR
                            if($j[0]["puntos"] > 21){
                                if($jugador["puntos"] < $puntosBanca) $jugador["estado"] = 1; //GANA JUGADOR
                                if($jugador["puntos"] > $puntosBanca) $jugador["estado"] =  0; //PIERDE JUGADOR
                            }
                            if($jugador["puntos"] == $puntosBanca) $jugador["estado"] = 2; //EMPATA JUGADOR
                        }
                    }
                    
                    //Mostrar las cartas que tiene cada jugador
                    echo ' <div class="'.classDeck($jugador).' deck-bg"> ';
                    echo ' <p>Jugador: '.$jugador["nombre"].' ';
                    echo ' '.$jugador["puntos"].' ';
                    echo ' <br> ';
                    for ($i = 0; $i <= count($jugador["cartas_"])-1; $i++) {
                        $cartaJugador = ($jugador["cartas_"][$i]);
                        echo ' <img src="baraja/'.$cartaJugador["imagen"].'" class="card" >';              
                    }
                    echo "</p><br></div>";
                }
            } 
            
            function classDeck($jugado){
                if($jugado["nombre"] == "Banca"){
                    if($jugado["estado"] == 0) return 'jugador-pierde';
                    if($jugado["estado"] != 0) return '';
                }

                if($jugado["estado"] == 0) return 'jugador-pierde';
                if($jugado["estado"] == 1) return 'jugador-gana';
                if($jugado["estado"] == 2) return 'jugador-empate';
            }

        ?>
    
    </body>
</html>