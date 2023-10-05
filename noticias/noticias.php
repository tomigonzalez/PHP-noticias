<?php

require 'database.php';

$query = $conn->prepare("SELECT * FROM noticias ORDER BY fecha DESC LIMIT 10");
$query->execute();
$noticias = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>