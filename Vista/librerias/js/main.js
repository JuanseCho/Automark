// Example starter JavaScript for disabling form submissions if there are invalid fields
$(function () {
  "use strict";

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms =$("#formlogin");

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      "submit",
      function (event) {
        event.preventDefault();
        if (!form.checkValidity()) {
          event.stopPropagation();
          form.classList.add("was-validated");
        } else {
          let email = $("#txt_email").val();
          let password = $("#txt_password").val();
          // utilizar funcion FormData
          let objData = new FormData();
          // agregar datos con la propiedad append
          objData.append("email_login", email);
          objData.append("password_login", password);

          fetch("control/loginControl.php", {
            method: "POST",
            body: objData,
          })
            .then((response) => response.json())
            .catch((error) => {
              console.log(error);
            })
            .then((response) => {
              if (response["codigo"] == 200) {
                window.location = response["mensaje"];
              } else {
                alert(response["mensaje"]);
              }
            });
        }
      },
      false
    );
  });

});
