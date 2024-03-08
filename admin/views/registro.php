<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulario de Registro</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="login-container">
    <h2>Registrate</h2>
    <form action="index.php?controller=login&action=crearUsuario" method="post">
    <input type="text" name="nombreUsuario" placeholder="Nombre de usuario" >
    <input type="password" name="contrasena" placeholder="Contraseña" >

        <input type="submit" value="Registrate">
        <?php echo ($retornado ?? '') ? "<span style='color: red;'>".$retornado."</span>" : ''; ?>
    </form>
   
</div>

</body>
</html>
