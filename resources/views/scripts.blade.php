<script src="{{ secure_asset('jquery/jquery.js') }}"></script>
<script src="{{ secure_asset('js/bootstrap.js') }}"></script>
<script src="{{ secure_asset('js_icons/all.js') }}"></script>

<script>

    $(document).ajaxStart(function() {
        $('#loading-overlay').show();
    });

    $(document).ajaxStop(function() {
        $('#loading-overlay').hide();
    });

    $(document).ready(function() {
        $('#bienvenida_div').show();
        $('#cargamentos_div').hide();
        $('#piloto_div').hide();
        $('#transporte_div').hide();
        $('#agricultores_div').hide();
        $('#reportes_div').hide();

        // Obtener la fecha actual en formato yyyy-MM-dd
        var fechaActual = new Date().toISOString().split("T")[0];

        // Establecer la fecha actual como máximo en los campos de fecha
        document.getElementById("fh_inicio").setAttribute("max", fechaActual);
        document.getElementById("fh_fin").setAttribute("max", fechaActual);
    });

    $("#btn_cargamentos").click(function(e) {
        $('#cargamentos_div').show();
        $('#piloto_div').hide();
        $('#transporte_div').hide();
        $('#agricultores_div').hide();
        $('#bienvenida_div').hide();
        $('#reportes_div').hide();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: modifyURLScheme("{{ route('listadoCargamentos') }}", "https"),
            //url: "{{ route('listadoCargamentos') }}",
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
                    row.append($('<td>').text(data.name));
                    row.append($('<td>').text(data.peso));
                    row.append($('<td>').text(data.parcialidades));
                    row.append($('<td>').text(data.justificacion));
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


    $("#btnConfirmarCuenta").click(function(e){
        if($("#id_cargamento").val() == ''){
            alert('Debe ingresar el No. de Cargamento')
        }else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: modifyURLScheme("{{route('confirmaCuenta')}}", "https"),
                //url: "{{route('confirmaCuenta')}}",
                data: {
                    id_cargamento: $("#id_cargamento").val()
                },
                dataType: 'json',
                success: function(data) {
                    alert(data.mensaje);

                    var url = "{{ route('generarPDF') }}" + $('#id_cargamento').val();
                    window.open(url, '_blank');
                    /* url: modifyURLScheme("{{route('generarPDF')}}", "https"),
                    $('#idCargamentoPDF').val($("#id_cargamento").val());
                    $('#form_generarPDF').submit(); */
                },
                error: function(data) {
                    console.log(data);
                    alert('Error al consultar los datos');
                }
            });
        }
    });

    $("#btn_piloto").click(function(e){
        $('#piloto_div').show();
        $('#cargamentos_div').hide();
        $('#transporte_div').hide();
        $('#agricultores_div').hide();
        $('#bienvenida_div').hide();
        $('#reportes_div').hide();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: modifyURLScheme("{{route('listadoPilotos')}}", "https"),
            //url: "{{route('listadoPilotos')}}",
            data: {
                "id": "testid"
            },
            dataType: 'json',
            success: function(data) {
                // Construir la tabla dinámica con los datos recibidos
                var tbody = $('#tabla-dinamica tbody');
                tbody.empty();
                // Recorrer los datos y agregar filas a la tabla
                console.log(data);
                $.each(data, function(index, data) {
                    var row = $('<tr>');
                    row.append($('<td>').text(data.nombre_completo));
                    row.append($('<td>').text(data.telefono));
                    row.append($('<td>').text(data.dpi));
                    row.append($('<td>').text(data.justificacion));
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
        $('#reportes_div').hide();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: modifyURLScheme("{{route('listadoTransportes')}}", "https"),
            //url: "{{route('listadoTransportes')}}",
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
                    row.append($('<td>').text(data.justificacion));
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
        $('#reportes_div').hide();
    });

    $("#btn_agricultores").click(function(e){
        $('#agricultores_div').show();
        $('#transporte_div').hide();
        $('#piloto_div').hide();
        $('#cargamentos_div').hide();
        $('#bienvenida_div').hide();
        $('#reportes_div').hide();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: modifyURLScheme("{{route('listadoAgricultores')}}", "https"),
            //url: "{{route('listadoAgricultores')}}",
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
                    row.append($('<td>').text(data.justificacion));
                    tbody.append(row);
                });
            },
            error: function(data) {
                console.log(data);
                alert('Error al consultar los datos');
            }
        });
    });

    $("#btn_reportes").click(function(e){
        $('#reportes_div').show();
        $('#agricultores_div').hide();
        $('#transporte_div').hide();
        $('#piloto_div').hide();
        $('#cargamentos_div').hide();
        $('#bienvenida_div').hide();
        $('#tabla_dinamica_reportes').hide();
    });

    $("#btn_mostrar_reportes").click(function(e){
        var fechaInicio = document.getElementById('fh_inicio').value;
        var fechaFin = document.getElementById('fh_fin').value;
        var fechaActual = new Date();

        if (fechaInicio === '' || fechaFin === '') {
            alert('Por favor, completa todos los campos de fecha.');
        } else {
            fechaInicio = new Date(fechaInicio);
            fechaFin = new Date(fechaFin);

            if (fechaInicio > fechaFin) {
                alert('La fecha de inicio debe ser menor que la fecha de fin.');
            } else if (fechaFin > fechaActual) {
                alert('La fecha de fin no puede ser mayor que la fecha actual.');
            } else {
                var fechaInicioFormatted = new Date(fechaInicio).toISOString().split('T')[0];
                var fechaFinFormatted = new Date(fechaFin).toISOString().split('T')[0];
                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: modifyURLScheme("{{ route('listadoCargamentosReporte') }}", "https"),
                //url: "{{ route('listadoCargamentosReporte') }}",
                data: {
                    fh_inicio: fechaInicioFormatted,
                    fh_fin: fechaFinFormatted
                },
                dataType: 'json',
                success: function(data) {

                    if(data.mensaje){
                        alert(data.mensaje);
                    }else{
                        $('#tabla_dinamica_reportes').show();
                        var tbody = $('#tabla_dinamica_reportes tbody');
                        tbody.empty();
                        // Recorrer los datos y agregar filas a la tabla
                        $.each(data, function(index, data) {
                            var row = $('<tr>');
                            row.append($('<td>').text(data.id_cargamento));
                            row.append($('<td>').text(data.name));
                            row.append($('<td>').text(data.peso));
                            row.append($('<td>').text(data.parcialidades));
                            row.append($('<td>').text(data.justificacion));
                            tbody.append(row);
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                    alert('Error al consultar los datos');
                }
            });
            }
        }
    });

    $("#logout").click(function(e){
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "POST",
            url: "{{route('logout')}}",
            data: { "id": "testid" },
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(data) {
                window.location = "{{ url('/') }}";
            },
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
