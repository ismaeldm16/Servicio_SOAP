<?php
$api_key = "eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJtYXJ0aW51cmJhbm8uc2VyZ2lvQGdtYWlsLmNvbSIsImp0aSI6IjA3OWQxOGVlLTI1OWQtNGZmZi1iNTlkLWIxMjU2MTBmOTg0MCIsImlzcyI6IkFFTUVUIiwiaWF0IjoxNzM3OTgwODg0LCJ1c2VySWQiOiIwNzlkMThlZS0yNTlkLTRmZmYtYjU5ZC1iMTI1NjEwZjk4NDAiLCJyb2xlIjoiIn0.FtkjMPPRzZU6ZLmE3bjhI_kOyydC0LoFed7z6syx-Dk"; // Reemplaza por tu propia API key.
$base_url = "https://opendata.aemet.es/opendata/api/";

// Función para obtener mapa de isobaras
function getIsobaras($api_key, $base_url)
{
    $url = $base_url . "mapasygraficos/analisis?api_key=" . $api_key;
    $response = file_get_contents($url);

    // Verifica si la respuesta fue exitosa
    if ($response === FALSE) {
        die("Error al obtener datos de AEMET.");
    }

    $data = json_decode($response, true);

    if (isset($data["datos"])) {
        return $data["datos"]; // URL de la imagen
    } else {
        die("Error: No se pudieron obtener los datos.");
    }
}

// Función para obtener predicción diaria para Canarias
function getPrediccionCanarias($api_key, $base_url)
{
    $url = $base_url . "prediccion/ccaa/hoy/16?api_key=" . $api_key; // Canarias: CCAA ID 16
    $response = file_get_contents($url);

    if ($response === FALSE) {
        die("Error al obtener datos de AEMET.");
    }

    $data = json_decode($response, true);

    if (isset($data["datos"])) {
        return $data["datos"];
    } else {
        die("Error: No se pudieron obtener los datos.");
    }
}

// Función para obtener predicción para Gran Canaria
function getPrediccionGranCanaria($api_key, $base_url)
{
    $url = $base_url . "prediccion/provincia/manana/35?api_key=" . $api_key; // Gran Canaria: Provincia 35
    $response = file_get_contents($url);

    if ($response === FALSE) {
        die("Error al obtener datos de AEMET.");
    }

    $data = json_decode($response, true);

    if (isset($data["datos"])) {
        return $data["datos"];
    } else {
        die("Error: No se pudieron obtener los datos.");
    }
}

// Manejo de las solicitudes del frontend
$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
switch ($accion) {
    case 'isobaras':
        echo getIsobaras($api_key, $base_url);
        break;
    case 'canarias':
        echo getPrediccionCanarias($api_key, $base_url);
        break;
    case 'gran_canaria':
        echo getPrediccionGranCanaria($api_key, $base_url);
        break;

}


?>