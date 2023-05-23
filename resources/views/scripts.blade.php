<script src="{{ secure_asset('jquery/jquery.js') }}"></script>
<script src="{{ secure_asset('js/bootstrap.js') }}"></script>
<script src="{{ secure_asset('js_icons/all.js') }}"></script>

<script>

    $(document).ready(function() {
        $('#bienvenida_div').show();
        $('#cargamentos_div').hide();
        $('#piloto_div').hide();
        $('#transporte_div').hide();
        $('#agricultores_div').hide();
    });

    $("#btn_cargamentos").click(function(e) {
        $('#cargamentos_div').show();
        $('#piloto_div').hide();
        $('#transporte_div').hide();
        $('#agricultores_div').hide();
        $('#bienvenida_div').hide();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: modifyURLScheme("{{ route('listadoCargamentos') }}", "https"),
            data: {
                "id": "testid"
            },
            dataType: 'json',
            success: function(data) {
                // Construir la tabla dinámica con los datos recibidos
                var tbody = $('#tabla-dinamica tbody');
                tbody.empty();
                // Recorrer los datos y agregar filas a la tabla
                $.each(data, function(index, data) {
                    var row = $('<tr>');
                    row.append($('<td>').text(data.id_cargamento));
                    row.append($('<td>').text(data.id_agricultor));
                    row.append($('<td>').text(data.peso));
                    row.append($('<td>').text(data.parcialidades));
                    row.append($('<td>').text(data.id_estado_cargamento));
                    var btn = $('<button>').text('Acción').addClass('btn btn-outline-success');
                    row.append($('<td>').append(btn));
                    tbody.append(row);
                });
            },
            error: function(data) {
                console.log(data);
                alert('Error al consultar los datos');
            }
        });
    });

    function modifyURLScheme(url, scheme) {
        return url.replace(/^http:/i, scheme + ":");
    }

    $("#btn_piloto").click(function(e){
        $('#piloto_div').show();
        $('#cargamentos_div').hide();
        $('#transporte_div').hide();
        $('#agricultores_div').hide();
        $('#bienvenida_div').hide();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: modifyURLScheme("{{route('listadoPilotos')}}", "https"),
            data: {
                "id": "testid"
            },
            dataType: 'json',
            success: function(data) {
                // Construir la tabla dinámica con los datos recibidos
                var tbody = $('#tabla-dinamica tbody');
                tbody.empty();
                // Recorrer los datos y agregar filas a la tabla
                $.each(data, function(index, data) {
                    var row = $('<tr>');
                    row.append($('<td>').text(data.nombre_completo));
                    row.append($('<td>').text(data.telefono));
                    row.append($('<td>').text(data.dpi));
                    row.append($('<td>').text(data.id_estado_piloto));
                    var btn = $('<button>').text('Acción').addClass('btn btn-outline-success');
                    row.append($('<td>').append(btn));
                    tbody.append(row);
                });
            },
            error: function(data) {
                console.log(data);
                alert('Error al consultar los datos');
            }
        });
    });

    $("#btn_transporte").click(function(e){
        $('#transporte_div').show();
        $('#piloto_div').hide();
        $('#cargamentos_div').hide();
        $('#agricultores_div').hide();
        $('#bienvenida_div').hide();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: modifyURLScheme("{{route('listadoTransportes')}}", "https"),
            data: {
                "id": "testid"
            },
            dataType: 'json',
            success: function(data) {
                // Construir la tabla dinámica con los datos recibidos
                var tbody = $('#tabla-dinamica tbody');
                tbody.empty();
                // Recorrer los datos y agregar filas a la tabla
                $.each(data, function(index, data) {
                    var row = $('<tr>');
                    row.append($('<td>').text(data.nombre));
                    row.append($('<td>').text(data.placa));
                    row.append($('<td>').text(data.marca));
                    row.append($('<td>').text(data.modelo));
                    row.append($('<td>').text(data.color));
                    row.append($('<td>').text(data.id_estado_transporte));
                    var btn = $('<button>').text('Acción').addClass('btn btn-outline-success');
                    row.append($('<td>').append(btn));
                    tbody.append(row);
                });
            },
            error: function(data) {
                console.log(data);
                alert('Error al consultar los datos');
            }
        });
    });

    $("#btn_bienvenida").click(function(e){
        $('#bienvenida_div').show();
        $('#transporte_div').hide();
        $('#piloto_div').hide();
        $('#cargamentos_div').hide();
        $('#agricultores_div').hide();
    });

    $("#btn_agricultores").click(function(e){
        $('#agricultores_div').show();
        $('#transporte_div').hide();
        $('#piloto_div').hide();
        $('#cargamentos_div').hide();
        $('#bienvenida_div').hide();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: modifyURLScheme("{{route('listadoAgricultores')}}", "https"),
            data: {
                "id": "testid"
            },
            dataType: 'json',
            success: function(data) {
                // Construir la tabla dinámica con los datos recibidos
                var tbody = $('#tabla-dinamica tbody');
                tbody.empty();
                // Recorrer los datos y agregar filas a la tabla
                $.each(data, function(index, data) {
                    var row = $('<tr>');
                    row.append($('<td>').text(data.id));
                    row.append($('<td>').text(data.name));
                    row.append($('<td>').text(data.email));
                    row.append($('<td>').text(data.id_estado_agricultor));
                    var btn = $('<button>').text('Acción').addClass('btn btn-outline-success');
                    row.append($('<td>').append(btn));
                    tbody.append(row);
                });
            },
            error: function(data) {
                console.log(data);
                alert('Error al consultar los datos');
            }
        });
    });

    // Mostrar la alerta durante 5 segundos
    setTimeout(function() {
        document.getElementById('alerta_success').style.transition = "opacity 2s";
        document.getElementById('alerta_success').style.opacity = "0";

        document.getElementById('alerta_error').style.transition = "opacity 2s";
        document.getElementById('alerta_error').style.opacity = "0";

        setTimeout(function() {
            document.getElementById('alerta_success').remove();
            document.getElementById('alerta_error').remove();
        }, 2000);
    }, 5000);
</script>
