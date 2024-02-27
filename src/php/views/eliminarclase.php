
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Borrado</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div id="confirmacionBorrado">
<form id="confirmacionForm" action="index.php?action=eliminarClase&controller=clase&id=<?php echo $_GET['id']; ?>" method="POST">
        <p>¿Estás seguro de que deseas borrar esta clase?</p>
       
        <input type="hidden" id="confirmarSi" name="confirmarBorrado" value="si">
        
        <input type="submit" value= Eliminar>
       </form>
       <a  href="index.php?action=listarClases&controller=clase"><img id='atras' src="../img/flecha-izquierda.png" alt=""></a>
</div>

