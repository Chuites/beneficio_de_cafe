<div class="height-100 bg-light" style="padding:7%;" id="cargamentos_div">
    <div id="listadoCargamentos">
        <div class="row">
            <div class="col-md-6">
                <input type="number" class="form-control" id="id_cargamento" name="id_cargamento" placeholder="Ingrese numero de cargamento" required>
            </div>
            <div class="col-md-6">
                <a href="#" class="btn btn-primary form-control" id="btnConfirmarCuenta" name="btnConfirmarCuenta"><i class="fa-solid fa-file-circle-check"></i>&nbsp;Confirmar Cuenta</a>
            </div>
        </div>
        <br>
        <h3>Cargamentos Creados</h3>
        <table class="table table-striped table-dark" id="tabla-dinamica">
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
