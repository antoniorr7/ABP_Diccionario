<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Borrado</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div id="confirmacionBorrado">
<form id="confirmacionForm" action="index.php?action=eliminarTraduccion&controller=traduccion&idTraduccion=<?php echo $_GET['idTraduccion']; ?>" method="POST">
        <p>¿Estás seguro de que deseas borrar esta traduccion?</p>
        <input type="hidden" name="palabra" value="<?php echo ($_GET['palabra']); ?>">
        <input type="hidden" name="idPalabra" value="<?php echo ($_GET['idPalabra']); ?>">
        <label for="confirmarSi">Sí</label>
        <input type="radio" id="confirmarSi" name="confirmarBorrado" value="si">
        <label for="confirmarNo">No</label>
        <input type="radio" id="confirmarNo" name="confirmarBorrado" value="no">
        <input type="submit">
       </form>
</div>
