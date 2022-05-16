$(function () {
  //cargar input solo lectura
  $("#email").attr("readonly", true);

  //validar correo
  $("#btnvalidar").on("click", function () {
    let correo = $("#ecorreo").val();

    $.ajax({
      type: "POST",
      url: "/portaldistribuidor/index/correoexiste",
      data: { correo: correo },
      beforeSend: function () {
        // setting a timeout
        $("#btnvalidar").attr("disabled", "disabled");
        $("#btnvalidar").html(
          "<span class='spinner-border spinner-border-sm'></span> \
                            <span class='ml-25 align-middle'>Enviando...</span>"
        );
      },
      success: function (res) {
        console.log(res.dato);
        switch (res.dato) {
          case 1: // correo enviado
            $("#modal-validar").modal("show"); // ir a clic del boton validar para revisar los datos
            $("#email").val("");
            $("#email").val(correo);

            $("#modal-validar").on("shown.bs.modal", function () {
              $("#codigo").focus();
            });
            break;
          case 2: // no se encontro correo en la base de datos
            Swal.fire({
              icon: "info",
              title: "Correo no existe",
              text: "Correo no encontrado en la base de datos..!!",
              timer: 3000,
              timerProgressBar: true,
              showCancelButton: false,
              showConfirmButton: false,
            });
            $("#btnvalidar").prop("disabled", false);
            $("#btnvalidar").html("Validar correo");
            break;
          case 3: // no ha ingresado correo
            Swal.fire({
              icon: "info",
              title: "Correo no ingresado",
              text: "No ha ingresado un correo..!!",
              timer: 3000,
              timerProgressBar: true,
              showCancelButton: false,
              showConfirmButton: false,
            });
            $("#btnvalidar").prop("disabled", false);
            $("#btnvalidar").html("Validar correo");
            break;
          case 4: //error al enviar correo
            Swal.fire({
              icon: "info",
              title: "Error al enviar correo",
              text: "Correo no enviado, intentelo en unos minutos..!!",
              timer: 4000,
              timerProgressBar: true,
              showCancelButton: false,
              showConfirmButton: false,
            });
            $("#btnvalidar").prop("disabled", false);
            $("#btnvalidar").html("Validar correo");
            break;
        }
      },
    });
  });

  $("#btnvalidacion").on("click", function () {
    var codigo = $("#codigo").val();
    var email = $("#email").val();

    if (codigo == null || codigo == "") {
      Swal.fire({
        icon: "info",
        title: "Código vacío",
        text: "No ha ingresado el código válido..!!",
        timer: 3000,
        timerProgressBar: true,
        // showCancelButton: false,
        // showConfirmButton: false,
      });
    } else {
      $.ajax({
        type: "POST",
        url: "/portaldistribuidor/index/validarcodigo",
        data: { codigo: codigo, email: email },
        beforeSend: function () {
          // setting a timeout
          $("#btnvalidacion").attr("disabled", "disabled");
          $("#btnvalidacion").html(
            "<span class='spinner-border spinner-border-sm'></span> \
                                <span class='ml-25 align-middle'>Validando...</span>"
          );
        },
        success: function (res) {
          // alert(res.validacion);
          switch (res.validacion) {
            case 0: //codigo incorrecto
              Swal.fire({
                icon: "error",
                title: "Codigo incorrecto",
                text: "Favor de ingresar el código correcto enviado a su correo..!!",
                timer: 4000,
                timerProgressBar: true,
                // showCancelButton: false,
                // showConfirmButton: false,
              });
              $("#btnvalidar").prop("disabled", false);
              $("#btnvalidar").html("Validar");
              break;
            case 1: //codigo correcto
              Swal.fire({
                icon: "success",
                title: "Correo Validado",
                text: "Favor de inciar sesion con su correo y clave, gracias..!!",
                timer: 4000,
                timerProgressBar: true,
                showCancelButton: false,
                showConfirmButton: false,
              });
              $("#modal-agregar").modal("hide");
              var id = setInterval(function () {
                location.href = "http://localhost:81/portaldistribuidor/index/index";
                clearInterval(id);
              }, 4000);
              break;
          }
        },
      });
    }
  });
});
