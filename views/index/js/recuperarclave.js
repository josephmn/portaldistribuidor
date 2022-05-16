$(function () {
  $("#enviarclave").on("click", function () {
    var correo = $("#ecorreo").val();

    if (validarcorreo(correo) == false) {
      Swal.fire({
        icon: "info",
        title: "Correo no tiene formato adecuado...",
        text: "Ingrese un correo válido!",
        timer: 3000,
        timerProgressBar: true,
        showCancelButton: false,
        showConfirmButton: false,
      });
      return;
    }

    $.ajax({
      type: "POST",
      url: "/portaldistribuidor/index/enviarcorreo",
      data: { correo: correo },
      beforeSend: function () {
        // setting a timeout
        $("#enviarclave").attr("disabled", "disabled");
        $("#enviarclave").html(
          "<span class='spinner-border spinner-border-sm'></span> \
                            <span class='ml-25 align-middle'>Enviando...</span>"
        );
      },
      success: function (res) {
        switch (res.dato) {
          case 0: // NO INGRESO CORREO
            $("#enviarclave").prop("disabled", false);
            $("#enviarclave").html("Enviar correo");
            Swal.fire({
              icon: "info",
              title: "No ha ingresado su correo...",
              text: "Vuelva a intentarlo!",
              timer: 3000,
              timerProgressBar: true,
              showCancelButton: false,
              showConfirmButton: false,
            });
            $("#ecorreo").focus();
            break;
          case 1: // SE ENVIO CORREO CORRECTAMENTE
            Swal.fire({
              //   position: "top-end",
              icon: "success",
              title: "Correo enviado, favor de revisar su bandeja de entrada.",
              timer: 3000,
              timerProgressBar: true,
              showCancelButton: false,
              showConfirmButton: false,
            });
            $("#correo").val("");
            $("#enviarclave").prop("disabled", false);
            $("#enviarclave").html("Enviar correo");
            setInterval(function () {
              location.href = "http://localhost:81/portaldistribuidor/index/index";
            }, 4000);
            break;
          case 2: // CORREO NO ENCONTRADO EN LA BASE DE DATOS
            $("#enviarclave").prop("disabled", false);
            $("#enviarclave").html("Enviar correo");
            Swal.fire({
              icon: "error",
              title: "Correo no encontrado en la base de datos...",
              text: "Vuelva a ingresar un correo válido!",
              timer: 4000,
              timerProgressBar: true,
              showCancelButton: false,
              showConfirmButton: false,
            });
            $("#ecorreo").focus();
            break;
          case 3:
            $("#enviarclave").prop("disabled", false);
            $("#enviarclave").html("Enviar correo");
            Swal.fire({
              icon: "error",
              title: "Erro al enviar correo",
              text: "Favor de volver a intentarlo en unos minutos..!",
              timer: 4000,
              timerProgressBar: true,
              showCancelButton: false,
              showConfirmButton: false,
            });
            $("#ecorreo").focus();
            break;
        }
      },
    });
  });
});

function validarcorreo(correo) {
  var expReg =
    /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;
  var valor = expReg.test(correo);
  if (valor == true) {
    return true;
  } else {
    return false;
  }
}

function valideKey(evt) {
  // code is the decimal ASCII representation of the pressed key.
  var code = evt.which ? evt.which : evt.keyCode;

  if (code == 8) {
    // backspace.
    return true;
  } else if (code >= 48 && code <= 57) {
    // is a number.
    return true;
  } else {
    // other keys.
    return false;
  }
}
