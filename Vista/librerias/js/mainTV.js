// Example starter JavaScript for disabling form submissions if there are invalid fields
$(function () {
    "use strict";

    var tabla3 = null;
    listarTVehiculo();

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    var forms = document.querySelectorAll("#form_R_TVehiculo");
  
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
  
            var tipoVehiculo = $("#txt_Veiculo").val();
  
            var objData = new FormData();
            objData.append("regTipovehiculo", tipoVehiculo);
  
            fetch("control/tipoVehiculoCtr.php", {
              method: "POST",
              body: objData,
            })
              .then((response) => response.json())
              .catch((error) => {
                console.log(error);
              })
              .then((response) => {
                alert(response["mensaje"]);
                $("#txt_Veiculo").val("");
  
                listarTVehiculo();
              });
          }
        },
        false
      );
    });
    function listarTVehiculo() {
      var objData = new FormData();
      objData.append("listarTiposVehiculo", "ok");
      fetch("control/tipoVehiculoCtr.php", {
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
  
      response.forEach(listarDatosTV);
  
      function listarDatosTV(item, index) {
        var objBotones = '<div class="btn-group">';
        objBotones +=
          '<button id="btnEditarTV" type="button" class="btn btn-warning ocultarFormRegitro" tipovehiculo="' +
          item.idtipo_vehiculo +
          '" nombretipovehiculo="' +
          item.nombre_tipo_vehiculo +
          '"  data-bs-target="#form_Edit_TVehiculo">Editar</button>';
        objBotones +=
          '<button id="btnEliminar" type="button" class="btn btn-danger" tipovehiculo="' +
          item.idtipo_vehiculo +
          '">Eliminar</button>';
        objBotones += "</div>";
  
        dataSet.push([item.nombre_tipo_vehiculo, objBotones]);
      }
  
      if (tabla3 != null) {
        $("#tablaTipo_vehiculo").dataTable().fnDestroy();
      }
  
      tabla3 = $("#tablaTipo_vehiculo").dataTable({
        data: dataSet,
      });
    }
  
    $("#tablaTipo_vehiculo").on("click", "#btnEditarTV", function () {
      var nombre_tipo_vehiculo = $(this).attr("nombretipovehiculo");
      var idtipo_vehiculo = $(this).attr("tipovehiculo");
  
      $("#txt_Edit_Veiculo").val(nombre_tipo_vehiculo);
  
      $("#Btn_Edit_Vehiculo").attr("tipovehiculo", idtipo_vehiculo);
    });
    var formularioEditar = document.querySelectorAll("#form_Edit_TVehiculo");
  
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
            var nombreTvehiculo = $("#txt_Edit_Veiculo").val();
  
            var idTvhiculo = $("#Btn_Edit_Vehiculo").attr("tipovehiculo");
  
            var objData = new FormData();
            objData.append("editNombreTvehiculo", nombreTvehiculo);
  
            objData.append("editId", idTvhiculo);
  
            fetch("control/tipoVehiculoCtr.php", {
              method: "POST",
              body: objData,
            })
              .then((response) => response.json())
              .catch((error) => {
                console.log(error);
              })
              .then((response) => {
                alert(response["mensaje"]);
                $("#txt_Edit_Veiculo").val("");
                listarTVehiculo();
              });
              
          }
        },
        false
      );
    });
    $("#tablaTipo_vehiculo").on("click", "#btnEliminar", function () {
      var id = $(this).attr("tipovehiculo");
      var objData = new FormData();
      objData.append("eliminarTipoVehiculo", id);
  
      fetch("control/tipoVehiculoCtr.php", {
        method: "POST",
        body: objData,
      })
        .then((response) => response.json())
        .catch((error) => {
          console.log(error);
        })
        .then((response) => {
          alert(response["mensaje"]);
          listarTVehiculo();
        });
    });
  });
  