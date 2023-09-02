// Example starter JavaScript for disabling form submissions if there are invalid fields
$(function () {
  "use strict";
  var tabla1 = null;

  listarInsumos();

  $("#btn_subir").on("click", function () {
    let archivo = document.getElementById('txt-file').files[0];
    var objData = new FormData();
    objData.append("file", archivo);

    // Mostrar el elemento con la clase loader
    $(".loader").show();
    
    fetch('control/insumosControl.php', {
      method: 'POST',
      body: objData
    }).then(response => response.json()).catch(error => {
      console.log(error);
    }).then(response => {
      $(".loader").hide();
      if (response["codigo"] == "202") {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: response["mensaje"],
          showConfirmButton: false,
          timer: 1700
        })
        listarInsumos();


      } else {
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: response["mensaje"],
          showConfirmButton: false,
          timer: 1700
        })
      }

      $("#txt-file").val("");
    });
  })

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
      var objCheckbox = '  <div class="form-check mb-3" id="check"> <input class="form-check-input" type="checkbox" name="remember"  insumos="'+
      item.idinsumos +
      '"  value=""> </div>'
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

    if (tabla1 != null) {
      $("#tablainsumos").dataTable().fnDestroy();
    }

    tabla1 = $("#tablainsumos").DataTable({
      data: dataSet,
    });

  
  }
  //////////////////////////////////////////////////////////
  $("#tablainsumos").on("click", "#btnEditar", function () {

    $("#contenedor1").attr("style", "Display:bolck");
    $("#contenedor").attr("style", "Display:none");


    var nombre_insumo = $(this).attr("nombreinsumos");
    var descripcion_insumo = $(this).attr("descripcioninsumo");
    var valor_insumo = $(this).attr("valor");

    var idinsumos = $(this).attr("insumos");

    console.log(idinsumos);
    

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
    $("#contenedor1").attr("style", "Display:none");
    $("#contenedor").attr("style", "Display:block");
  })

$("#exit").on("click", function () {
    $("#contenedor1").attr("style", "Display:none");
    $("#contenedor").attr("style", "Display:block");
  })
  $("#tablainsumos").on("click", "#btnEliminar", function () {
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

        listarInsumos();
      });
  });


  var ids = [];

  $("#tablainsumos").on("click", "#editSelectedButton", function () {

    $('#check:checked').each(function() {
      ids.push($(this).attr('insumos'));
      
  });
  console.log(ids);

  });









  
  
  












});
