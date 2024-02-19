<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Borrado</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div id="confirmacionBorrado">
<form id="confirmacionForm" action="index.php?action=eliminarPalabra&controller=palabra&idPalabra=<?php echo $_GET['idPalabra']; ?>" method="POST">
        <p>¿Estás seguro de que deseas borrar esta palabra?</p>
        <label for="confirmarSi">Sí</label>
        <input type="radio" id="confirmarSi" name="confirmarBorrado" value="si">
        <label for="confirmarNo">No</label>
        <input type="radio" id="confirmarNo" name="confirmarBorrado" value="no">
        <input type="submit">
       </form>
</div>
