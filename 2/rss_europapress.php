<?php
// URL del RSS de EuropaPress
$rss_url = "https://www.europapress.es/rss/rss.aspx?ch=00066";

// Cargar XML del RSS
$rss = simplexml_load_file($rss_url);
if ($rss === false) {
    die("Error al cargar el canal RSS.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias EuropaPress</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        th {
            background: #0077cc;
            color: #fff;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        tr:hover {
            background: #ddd;
            transition: 0.3s;
        }

        a {
            text-decoration: none;
            color: #0077cc;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Últimas Noticias de EuropaPress</h1>

    <table border="1">
        <tr>
            <th>Noticia</th>
            <th>Descripción</th>
            <th>Link</th>
        </tr>

        <?php foreach ($rss->channel->item as $item): ?>
            <tr>
                <td><?php echo $item->title; ?></td>
                <td><?php echo $item->description; ?></td>
                <td><a href="<?php echo $item->link; ?>" target="_blank">Ver noticia</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
