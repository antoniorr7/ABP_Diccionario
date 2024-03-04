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
    <input type="text" name="nombreUsuario" placeholder="Nombre de usuario" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>

        <input type="submit" value="Registrate">
    </form>
    <div class="form-footer">
        <p>¿Tienes una cuenta? <a href="index.php?controller=login&action=mostrarLogin" class="register-link">Inicia Sesión aquí</a></p>
    </div>
</div>

</body>
</html>
