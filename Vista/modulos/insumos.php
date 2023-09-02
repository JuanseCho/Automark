<div class="container">
  <div class="row">
    <!-- /////////////////////////////////////////////////////////// -->
    <div id="contenedor" class="col-md-3" style="display: block;">
      <form action="" class="needs-validation" id="formRegitroInsumos" novalidate>
        <h1 class="title my-3 py-2">Insumos</h1>
        <label>

          <input placeholder="nombre insumos" class="form-control" type="text" id="txt_nombreInsumos" required>
          <div class="valid-feedback">correcto</div>
          <div class="invalid-feedback">error rellena el campo</div>
        </label>
        <label>

          <input placeholder="Descripcion de insumos" class="form-control" type="text" id="txt_descripcionInsumo" required>
          <div class="valid-feedback"> correcto </div>

        </label>
        <label>

          <input placeholder="precio" class="form-control" type="text" id="txt_PrecioInsumo" required>
          <div class="valid-feedback"> correcto </div>

        </label>

        <button type="submit" id="BTlogin">Agregar insumo</button>
      </form>
    </div>

    <!-- /////////////////////////////////////////////////////////// -->
    <div id="contenedor1" class="col-md-3" style="display: none;">

      <form action="" class="needs-validation" id="formEditarInsumos">

        <!--<i class="btn fa-solid fa-circle-xmark fa-2xl" id="exit"></i>  -->


        <h1 class="title my-3 py-3">Editar </h1>
        <label>


          <input placeholder="nombre insumos" class="form-control" type="text" id="txt_EdtnombreInsumos" required>
          <div class="valid-feedback">correcto</div>
          <div class="invalid-feedback">error rellena el campo</div>
        </label>
        <label>


          <input placeholder="Descripcion de insumos" class="form-control" type="text" id="txt_EdtdescripcionInsumo" required>
          <div class="valid-feedback"> correcto </div>
        </label>
        <label>


          <input placeholder="precio" class="form-control" type="text" id="txt_EdtPrecioInsumo" required>
          <div class="valid-feedback"> correcto </div>
        </label>

        <button id="Bt_editarInsumo" idInsumo="">editar insumo</button>
      </form>
    </div>
    <!-- /////////////////////////////////////////////////////////// -->
    <div class="col md-6 table-responsive">
      <div class="input-group mb-3">
        <input id="txt-file" type="file" class="form-control" id="inputGroupFile02">
        <button id="btn_subir" class="btn btn-danger">Subir Archivo</button>
      </div>

      <h2>Panel Administrativo de los insumos</h2>
      <div id="tablainsumos_wrapper" class="dataTables_wrapper no-footer">
        <table id="tablainsumos" class="table table-dark table-striped ">
          <thead>
            <tr>
              
              <th>Nombres insumo</th>
              <th>Descripcion insumo</th>
              <th>valor</th>
              <th>Acciones</th> 
            </tr>
          </thead>
        </table>

      </div>
      


    </div>

  </div>
  <div style="background-color: rgba(0, 0, 0, 0.549);" class="loader">

    loading

  </div>
</div>