<?php

date_default_timezone_set("America/Santo_Domingo");

function signo_zodiaco($fecha){ 

    $zodiaco = ''; 
          
    list ( $ano, $mes, $dia ) = explode ( "-", $fecha ); 
    
    if     ( ( $mes == 1 && $dia > 19 )  || ( $mes == 2 && $dia < 19 ) )  { $zodiaco = "Acuario"; }
    elseif ( ( $mes == 2 && $dia > 18 )  || ( $mes == 3 && $dia < 21 ) )  { $zodiaco = "Piscis"; } 
    elseif ( ( $mes == 3 && $dia > 20 )  || ( $mes == 4 && $dia < 20 ) )  { $zodiaco = "Aries"; } 
    elseif ( ( $mes == 4 && $dia > 19 )  || ( $mes == 5 && $dia < 21 ) )  { $zodiaco = "Tauro"; } 
    elseif ( ( $mes == 5 && $dia > 20 )  || ( $mes == 6 && $dia < 21 ) )  { $zodiaco = "Géminis"; } 
    elseif ( ( $mes == 6 && $dia > 20 )  || ( $mes == 7 && $dia < 23 ) )  { $zodiaco = "Cáncer"; } 
    elseif ( ( $mes == 7 && $dia > 22 )  || ( $mes == 8 && $dia < 23 ) )  { $zodiaco = "Leo"; } 
    elseif ( ( $mes == 8 && $dia > 22 )  || ( $mes == 9 && $dia < 23 ) )  { $zodiaco = "Virgo"; } 
    elseif ( ( $mes == 9 && $dia > 22 )  || ( $mes == 10 && $dia < 23 ) ) { $zodiaco = "Libra"; } 
    elseif ( ( $mes == 10 && $dia > 22 ) || ( $mes == 11 && $dia < 22 ) ) { $zodiaco = "Escorpio"; } 
    elseif ( ( $mes == 11 && $dia > 21 ) || ( $mes == 12 && $dia < 22 ) ) { $zodiaco = "Sagitario"; } 
    elseif ( ( $mes == 12 && $dia > 21 ) || ( $mes == 1 && $dia < 20 ) )  { $zodiaco = "Capricornio"; } 
 
    return $zodiaco; 
 
 }
 
 echo signo_zodiaco('1989-10-03'); // Imprime: Libra

function getSsPage($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function MostrarDatos(){
    $url = "https://randomuser.me/api/?results=30";
    $datos = getSsPage($url);
    $datos = json_decode($datos);
    $rs = $datos->results;
    $num=1;

    foreach($rs as $persona){
        $fecha = strtotime($persona->dob->date);
        $zodiaco = signo_zodiaco(date('Y-m-d', $fecha));
        $fecha = date('d - m - Y', $fecha);
        echo "<tr>
        <td>{$num}</td>
        <td><img src='{$persona->picture->thumbnail}'></td>
        <td>{$persona->gender}</td>
        <td>{$persona->name->first}</td>
        <td>{$persona->name->last}</td>
        <td>{$persona->email}</td>
        <td>{$fecha}</td>
        <td>{$zodiaco}</td>
        <td>{$persona->dob->age}</td>
        <td>{$persona->nat}</td>
        <tr>";
        $num++;
    }
}

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="widh=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatibe" content="ie=edge">
        <title>Muestra datos de personas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <div class "container">
            <h3>Aqui estan tus datos</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>num.</th>
                        <th>Foto</th>
                        <th>Genero</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Fecha nac</th>
                        <th>Zodiaco</th>
                        <th>Edad</th>
                        <th>Nacionalidad</th>
                    </tr>
                </thead>
                <tbody>
                <?php MostrarDatos();?>
                </tbody>
            </table>
        </div>
    </body>
    </html>