<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    $(document).ready(function() {
        // Función para agregar un nuevo input
        function agregarInput() {
            var nuevoInput = $('<div><input type="text" class="nuevo-significado" placeholder="Nuevo significado"><button class="boton boton-eliminar">Eliminar</button></div>');
            $('.meanings').append(nuevoInput);
            validarBotonAgregar();
        }

        // Botón para agregar un nuevo input
        var botonAgregar = $('<button class="boton boton-agregar">Agregar Significado</button>').css({
            'padding': '8px 16px',
            'background-color': '#4CAF50',
            'color': 'white',
            'border': 'none',
            'border-radius': '4px',
            'cursor': 'pointer',
            'margin-top': '10px'
        });
        botonAgregar.click(function() {
            agregarInput();
        });

        // Agregar el botón al contenedor de significados
        $('.meanings').append(botonAgregar);

        // Validar botón de agregar al inicio
        validarBotonAgregar();

        // Validar inputs vacíos y manejar la creación de nuevos inputs
        $(document).on('input', '.nuevo-significado', function() {
            validarBotonAgregar();
        });

        // Botón para eliminar un input
        $(document).on('click', '.boton-eliminar', function() {
            $(this).parent().remove();
            validarBotonAgregar();
        });

        // Función para validar inputs vacíos
        function validarBotonAgregar() {
            var inputsVacios = $('.nuevo-significado').filter(function() {
                return $(this).val().trim() === '';
            });

            if (inputsVacios.length > 0) {
                botonAgregar.prop('disabled', true).css('background-color', '#cccccc');
            } else {
                botonAgregar.prop('disabled', false).css('background-color', '#4CAF50');
            }
        }
    });

