 <main>
        <p>¡Explora nuestro extenso diccionario y descubre el significado de palabras fascinantes!</p>
        <div class=popup style="box-shadow: 10px 10px 10px 10px rgba(0, 0, 0, 0.5);">
                <form action="index.php?action=listarPalabras&controller=palabra" method="post">
                        <label for="codigo">Introduce tu código de clase</label>
                        <input type="text" name=codigo placeholder="Código Max 5 caracteres">
                        <input type="submit" class="btn btn-info" value="Entrar en la clase">
                       <div > <span style= color:red;><?php echo $retornado ?></span></div>
                </form>
        </div>
</main>