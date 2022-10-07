<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta</title>

    <link rel="stylesheet" href="styles\style.css">
</head>
<body>
    <?php
        include("cabecera.inc.php");

        echo '<br>';

        
        include('array.php');
                
      
        $nomJ1 = "Fran";
        $nomJ2 = "Adrian";

        //Barajar
        shuffle($cartas);

        $puntosJ1 = 0;
        $puntosJ2 = 0;

        $cartasJugador1 = [];
        $cartasJugador2 = [];
        for ($i = 0; $i <= 9; $i++) {
            $cartasJugador1[] = array_pop($cartas);
            $cartasJugador2[] = array_pop($cartas);
          
        }

        //JUGADOR 1
        echo $nomJ1;
        echo '<div class="deck">';
        for ($i = 0; $i <= 9; $i++) {
            $img = 'baraja/'.$cartasJugador2[$i]["imagen"].'';
            echo ' <img src="'.$img.'" class="card" ';
            echo '<br>';
        }
        echo '</div>';

        echo '<br>';
        
        //JUGADOR 2
        echo $nomJ2;
        echo '<div class="deck">';
        for ($i = 0; $i <= 9; $i++) {
            $img = 'baraja/'.$cartasJugador1[$i]["imagen"].'';
            echo ' <img src="'.$img.'" class="card" ';
            echo '<br>';
        
        }
        echo '</div>';
      


        //Comparar cartas
        for ($j = 0; $j <= 9; $j++) {
            $valorCartaJ1 = $cartasJugador1[$j]["valor"];
            $valorCartaJ2 = $cartasJugador2[$j]["valor"];
            
            if($valorCartaJ1 == $valorCartaJ2){ 
                $puntosJ1 = $puntosJ1 + 1;
                $puntosJ2 = $puntosJ2 + 1;
            }

            if($valorCartaJ1 > $valorCartaJ2){ 
                $puntosJ1 = $puntosJ1 + 2;
            }

            if($valorCartaJ1 < $valorCartaJ2){ 
                $puntosJ2 = $puntosJ2 + 2;
            }

           
        }

        echo '<h2>Resultado</h2>';
    
        echo ' <p>'.$nomJ1.': '.$puntosJ1.'</p>';
        echo '<br>';
        echo ' <p>'.$nomJ2.': '.$puntosJ2.'</p> ';
        
        echo '<br>';

        if($puntosJ1 > $puntosJ2) echo '<p> Gana: '.$nomJ1.' <p>';
        if($puntosJ1 < $puntosJ2) echo '<p> Gana: '.$nomJ2.' <p>';
                
    ?>
  
</body>
</html>