<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulario de Inicio de Sesión</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="login-container">
    <h2>Inicio de Sesión</h2>
    <form action="index.php?controller=login&action=IniciarSesion" method="post">
        
        <input type="text" name="nombreUsuario" placeholder="Nombre de usuario" >
        <input type="password" name="contrasena" placeholder="Contraseña" >

        <input type="submit" value="Iniciar Sesión">
        <?php echo ($retornado['mensaje'] ?? '') ? "<span style='color: red;'>".$retornado['mensaje']."</span>" : ''; ?>

    

    </form>
    <div class="form-footer">
    
    </div>
</div>

</body>
</html>
