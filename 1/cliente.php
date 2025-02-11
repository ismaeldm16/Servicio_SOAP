<?php
$options = [
    'uri' => 'http://localhost/SOAP/',
    'location' => 'http://localhost/SOAP/1/servicio.php',
    'trace' => 1,
    'exceptions' => true
];

$cliente = new SoapClient(null, $options);

try {
    // Obtener módulo por ID
    $modulo = json_decode($cliente->infoModulo(1), true);

    // Obtener departamentos
    $departamentos = json_decode($cliente->infoDepartamentos(), true);

    // Obtener nomenclaturas
    $nomenclaturas = json_decode($cliente->infoNomenclaturas(), true);

} catch (SoapFault $e) {
    $error = "Error en el servicio SOAP: " . $e->getMessage();
} catch (Exception $e) {
    $error = "Error general: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta SOAP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 20px;
        }

        .container {
            width: 80%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: left;
        }

        h1 {
            color: #0077cc;
        }

        h2 {
            color: #333;
            border-bottom: 2px solid #0077cc;
            padding-bottom: 5px;
        }

        pre {
            background: #eee;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Consulta de Servicio SOAP</h1>

    <div class="container">
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php else: ?>
            <h2>Módulo</h2>
            <?php echo $modulo ? "<pre>" . print_r($modulo, true) . "</pre>" : "<p>No existen datos en el módulo</p>"; ?>

            <h2>Departamentos</h2>
            <?php echo $departamentos ? "<pre>" . print_r($departamentos, true) . "</pre>" : "<p>No existen datos en los departamentos</p>"; ?>

            <h2>Nomenclaturas</h2>
            <?php echo $nomenclaturas ? "<pre>" . print_r($nomenclaturas, true) . "</pre>" : "<p>No existen datos en las nomenclaturas</p>"; ?>
        <?php endif; ?>
    </div>

</body>
</html>
