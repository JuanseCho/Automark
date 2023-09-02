// Example starter JavaScript for disabling form submissions if there are invalid fields
$(function () {
    "use strict";

    var tabla2 = null;

  
    listarTServicio();
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
  
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    var forms = document.querySelectorAll("#form_R_TServicio");
  
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
  
            var tiposervicio = $("#txt_servicio").val();
            alert(tiposervicio);
            var objData = new FormData();
            objData.append("regTiposervicio", tiposervicio);
  
            fetch("control/tipoServicioCtr.php", {
              method: "POST",
              body: objData,
            })
              .then((response) => response.json())
              .catch((error) => {
                console.log(error);
              })
              .then((response) => {
                alert(response["mensaje"]);
                $("#txt_servicio").val("");
                listarTServicio();
                
              });
          }
        },
        false
      );
    });
  
    function listarTServicio() {
      var objData = new FormData();
      objData.append("listarTiposServicio", "ok");
      fetch("control/tipoServicioCtr.php", {
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
  
      response.forEach(listarDatosTS);
  
      function listarDatosTS(item, index) {
        var objBotonesS = '<div class="btn-group">';
        objBotonesS +=
          '<button id="btnEditarTS" type="button" class="btn btn-warning ocultarFormRegitro" tiposervicio="' +
          item.idtipo_servicio +
          '" nombretiposervicio="' +
          item.nombre_tipo_servicio +
          '"  data-bs-target="#form_E_TServicio">Editar</button>';
          objBotonesS +=
          '<button id="btnEliminar" type="button" class="btn btn-danger" tiposervicio="' +
          item.idtipo_servicio +
          '">Eliminar</button>';
          objBotonesS += "</div>";
  
        dataSet.push([item.nombre_tipo_servicio, objBotonesS]);
      }
  
      if (tabla2 != null) {
        $("#tablaservicios").dataTable().fnDestroy();
      }
  
      tabla2 = $("#tablaservicios").dataTable({
        data: dataSet,
      });

      $("#tablaservicios").on("click", "#btnEditarTS", function () {
        var nombre_TServicio = $(this).attr("nombretiposervicio");
        var idtipo_servicio = $(this).attr("tiposervicio");
    
        $("#txt_Edit_servicio").val(nombre_TServicio);
    
        $("#Btn_Edit_Servio").attr("tiposervicio", idtipo_servicio);
      });
      
      var formularioEditar = document.querySelectorAll("#form_E_TServicio");
  
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
              var nombreTservicio = $("#txt_Edit_servicio").val();
    
              var idTservicio = $("#Btn_Edit_Servio").attr("tiposervicio");
    
              var objData = new FormData();
              objData.append("editNombreTservicio", nombreTservicio);
    
              objData.append("editId", idTservicio);
    
              fetch("control/tipoServicioCtr.php", {
                method: "POST",
                body: objData,
              })
                .then((response) => response.json())
                .catch((error) => {
                  console.log(error);
                })
                .then((response) => {
                  alert(response["mensaje"]);
                  $("#txt_Edit_servicio").val("");
                  listarTServicio();
                });
                
            }
          },
          false
        );
      });
      $("#tablaservicios").on("click", "#btnEliminar", function () {
        var id = $(this).attr("tiposervicio");
        var objData = new FormData();
        objData.append("eliminarTipoServicio", id);
    
        fetch("control/tipoServicioCtr.php", {
          method: "POST",
          body: objData,
        })
          .then((response) => response.json())
          .catch((error) => {
            console.log(error);
          })
          .then((response) => {
            alert(response["mensaje"]);
            listarTServicio();
          });
      });
      
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////

  });
  