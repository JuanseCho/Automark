// Example starter JavaScript for disabling form submissions if there are invalid fields
/*$(function () {
    "use strict";
    var tabla4 = null;

    listarInsumos();

  
    var forms = document.querySelectorAll("#formRegitroInsumos");
  
    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms).forEach(function (form) {
      form.addEventListener(
        "submit",
        function (event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add("was-validated");
          } else {
            event.preventDefault();
  
            var nombreInsumos = $("#txt_nombreInsumos").val();
            var descripcionInsumo = $("#txt_descripcionInsumo").val();
            var valorInsumo = $("#txt_PrecioInsumo").val();
  
            var objData = new FormData();
            objData.append("regNombreInsummo", nombreInsumos);
            objData.append("regDescripcionInsumo", descripcionInsumo);
            objData.append("regValorInsumo", valorInsumo);
  
            fetch("control/insumosControl.php", {
              method: "POST",
              body: objData,
            })
              .then((response) => response.json())
              .catch((error) => {
                console.log(error);
              })
              .then((response) => {
                alert(response["mensaje"]);
                $("#txt_nombreInsumos").val("");
                $("#txt_descripcionInsumo").val("");
                $("#txt_PrecioInsumo").val("");
                listarInsumos();
              });
          }
        },
        false
      );
    });
    function listarInsumos() {
      var objData = new FormData();
      objData.append("listarInsumos", "ok");
      fetch("control/insumosControl.php", {
        method: "POST",
        body: objData,
      })
        .then((response) => response.json())
        .catch((error) => {
          console.log(error);
        })
        .then((response) => {
          cargarDatos(response);
        });
    }
    function cargarDatos(response) {
      console.log(response);
      var dataSet = [];
  
      response.forEach(listarDatos);
  
      function listarDatos(item, index) {
        var objBotones = '<div class="btn-group">';
        objBotones +=
          '<button id="btnEditar" type="button" class="btn btn-warning ocultarFormRegitro" insumos="' +
          item.idinsumos +
          '" nombreinsumos="' +
          item.nombre_insumo +
          '" descripcioninsumo="' +
          item.descripcion_insumo +
          '"  valor="' +
          item.valor_insumo +
          '"  data-bs-target="#formEditarInsumos">Editar</button>';
        objBotones +=
          '<button id="btnEliminar" type="button" class="btn btn-danger" insumos="' +
          item.idinsumos +
          '">Eliminar</button>';
        objBotones += "</div>";
  
        dataSet.push([
          item.nombre_insumo,
          item.descripcion_insumo,
          item.valor_insumo,
          objBotones,
        ]);
      }
  
      if (tabla4 != null) {
        $("#tablaTipo_vehiculo").dataTable().fnDestroy();
      }
  
      tabla4 = $("#tablaTipo_vehiculo").DataTable({
        data: dataSet,
      });
    }
    //////////////////////////////////////////////////////////
    $("#tablaTipo_vehiculo").on("click", "#btnEditar", function () {
      $("#contenedor").html("");
      var objEditar =
        '<form action="" class="needs-validation" id="formEditarInsumos" novalidate>';
      objEditar += '<h1 class="title">Editar insumos</h1>';
      objEditar += "<label>";
      objEditar += '<i class="fa-solid fa-user"></i>';
      objEditar +=
        '<input placeholder="nombre insumos" class="form-control" type="text" id="txt_EdtnombreInsumos" required>';
      objEditar += '<div class="valid-feedback">correcto</div>';
      objEditar += '<div class="invalid-feedback">error rellena el campo</div>';
      objEditar += "</label>";
      objEditar += "<label>";
      objEditar += '<i class="fa-solid fa-lock"></i>';
      objEditar +=
        '<input placeholder="Descripcion de insumos" class="form-control" type="text" id="txt_EdtdescripcionInsumo" required>';
      objEditar += ' <div class="valid-feedback"> correcto </div>';
      objEditar += "</label>";
      objEditar += "<label>";
      objEditar += '<i class="fa-solid fa-lock"></i>';
      objEditar +=
        '<input placeholder="precio" class="form-control" type="text" id="txt_EdtPrecioInsumo" required>';
      objEditar += '<div class="valid-feedback"> correcto </div>';
      objEditar += "</label>";
      objEditar +=
        '<button type="submit" id="Bt_editarInsumo" idInsumo="">editar insumo</button>';
      objEditar += '</form>"';
  
      $("#contenedor").html(objEditar);
      var nombre_insumo = $(this).attr("nombreinsumos");
      var descripcion_insumo = $(this).attr("descripcioninsumo");
      var valor_insumo = $(this).attr("valor");
  
      var idinsumos = $(this).attr("insumos");
  
      //console.log(idinsumos);
  
      $("#txt_EdtnombreInsumos").val(nombre_insumo);
      $("#txt_EdtdescripcionInsumo").val(descripcion_insumo);
      $("#txt_EdtPrecioInsumo").val(valor_insumo);
  
      $("#Bt_editarInsumo").attr("idInsumo", idinsumos);
    });
  
    var formularioEditar = document.querySelectorAll("#formEditarInsumos");
  
    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(formularioEditar).forEach(function (form) {
      form.addEventListener(
        "submit",
        function (event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add("was-validated");
          } else {
            event.preventDefault();
            var nobre_insumos = $("#txt_EdtnombreInsumos").val();
            var descripcion_insumo = $("#txt_EdtdescripcionInsumo").val();
            var valor_insumo = $("#txt_EdtPrecioInsumo").val();
  
            var idinsumos = $("#Bt_editarInsumo").attr("idInsumo");
  
            var objData = new FormData();
            objData.append("editnobre_insumos", nobre_insumos);
            objData.append("editDescripcion_insumos", descripcion_insumo);
            objData.append("editValor_insumos", valor_insumo);
  
            objData.append("editId", idinsumos);
  
            fetch("control/insumosControl.php", {
              method: "POST",
              body: objData,
            })
              .then((response) => response.json())
              .catch((error) => {
                console.log(error);
              })
              .then((response) => {
                alert(response["mensaje"]);
  
                listarInsumos();
              });
          }
        },
        false
      );
    });
    $("#Bt_editarInsumo").on("click", function () {
      $("#contenedor").html("");
      var objEditar =
        '<form action="" class="needs-validation" id="formRegitroInsumos" novalidate>';
      objEditar += '<h1 class="title">Insumos</h1>';
      objEditar += "<label>";
      objEditar += '<i class="fa-solid fa-user"></i>';
      objEditar +=
        '<input placeholder="nombre insumos" class="form-control" type="text" id="txt_nombreInsumos" required>';
      objEditar += '<div class="valid-feedback">correcto</div>';
      objEditar += '<div class="invalid-feedback">error rellena el campo</div>';
      objEditar += "</label>";
      objEditar += "<label>";
      objEditar += '<i class="fa-solid fa-lock"></i>';
      objEditar +=
        '<input placeholder="Descripcion de insumos" class="form-control" type="text" id="txt_descripcionInsumo" required>';
      objEditar += ' <div class="valid-feedback"> correcto </div>';
      objEditar += "</label>";
      objEditar += "<label>";
      objEditar += '<i class="fa-solid fa-lock"></i>';
      objEditar +=
        '<input placeholder="precio" class="form-control" type="text" id="txt_PrecioInsumo" required>';
      objEditar += '<div class="valid-feedback"> correcto </div>';
      objEditar += "</label>";
      objEditar +=
        '<button type="submit" id="BTlogin" href="#">Agregar insumo</button>';
      objEditar += '</form>"';
  
      $("#contenedor").html(objEditar);
    });
    $("#tablaTipo_vehiculo").on("click", "#btnEliminar", function () {
      var id = $(this).attr("insumos");
      var objData = new FormData();
      objData.append("idEliminar_insumo", id);
  
      fetch("control/insumosControl.php", {
        method: "POST",
        body: objData,
      })
        .then((response) => response.json())
        .catch((error) => {
          console.log(error);
        })
        .then((response) => {
          alert(response["mensaje"]);
          listarInsumos();
        });
    });
    // Obtener referencia al elemento de entrada de insumos
  
    var inputinsumo = document.getElementById("txt_EdtnombreInsumos");
    // Realizar una solicitud para obtener la lista de los insumos
    fetch("control/insumosControl.php", {
      method: "POST",
      body: new FormData().append("listarInsumos", "ok"),
    })
      .then((response) => response.json())
      .then((response) => {
        // Generar las opciones del select basado en los datos recibidos
        var selectOptions = response.map((insumo) => {
          return "<option>" + insumo.nobre_insumos + "</option>";
        });
  
        // Insertar las opciones en el select
        inputinsumo.innerHTML = selectOptions.join("");
      })
      .catch((error) => {
        console.log(error);
      });
  
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
  });
  */