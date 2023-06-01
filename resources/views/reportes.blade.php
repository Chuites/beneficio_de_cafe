<div class="height-100 bg-light" style="padding:7%;" id="reportes_div">
    <div id="listadoCargamentos">
        <center>
            <h3>Seleccione el rango de fechas</h3>
        </center>
        <div class="row">
            <div class="col-md-6">
                <input type="date" class="form-control" id="fh_inicio" name="fh_inicio"
                    placeholder="Ingrese fecha de inicio" required>
            </div>
            <div class="col-md-6">
                <input type="date" class="form-control" id="fh_fin" name="fh_fin"
                    placeholder="Ingrese fecha de fin" required>
            </div>
        </div>
        <br>
        <center>
            <button class="form-control btn-success" id="btn_mostrar_reportes">Mostrar Cargamentos</button>
        </center>
        <hr>
        <br>
        <h3>Cargamentos Creados</h3>
        <table class="table table-striped table-dark" id="tabla_dinamica_reportes">

            <thead>
                <tr>
                    <th scope="col">No Cargamento</th>
                    <th scope="col">Agricultor</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Parcialidades</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<script>
    function validarFechas() {
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
                alert('Fechas válidas.');
            }
        }
    }
</script>
