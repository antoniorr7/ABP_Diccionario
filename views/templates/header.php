<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Diccionario</title>
</head>
<body>
<nav>
<div>
<h1><a href="index.php">Diccionario</a></h1>
    </div>
    <div>
      <form action="index.php?action=buscarPalabra&controller=palabra" method="POST">
        <input type="text" id="busqueda" name="busqueda" placeholder="Buscar palabras...">
      </form>
    </div>
  </nav>
