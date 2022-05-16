$(function () {
  //cargar deshabilitado los input
  $("#codigo,#nombres,#apellidos,#clavecon,#postpara").attr("readonly", true);

  creardatatable("#example1", 10, 0); //tabla.- index

  /* REGISTRAR USUARIO */
  $("#btnusuario").on("click", function () {

    $("#xnombres").val("");
    $("#xapellidos").val("");
    $("#xcorreo").val("");
    $("#xpassword").val("");

    $("#modal-agregar").modal("show");
  });

  $("#modal-agregar").on("shown.bs.modal", function () {
    $("#xnombres").focus();
  });

  $("#xbtnguardar").on("click", function () {
    let post = 1; //registrar
    let codigo = 0; //no existe
    let nombres = $("#xnombres").val();
    let apellidos = $("#xapellidos").val();
    let correo = $("#xcorreo").val();
    let password = $("#xpassword").val();
    let estado = 1; // activo
    let perfil = 3; // usuario
    let confirmar = 1; //confirmado

    let espacios = false;
    let cont = 0;

    while (!espacios && cont < password.length) {
      if (password.charAt(cont) == " ") espacios = true;
      cont++;
    }

    if (nombres == "") {
      Swal.fire({
        icon: "info",
        title: "Ingrese sus nombres...",
        timer: 2000,
      });
      return false;
    }

    if (apellidos == "") {
      Swal.fire({
        icon: "info",
        title: "Ingrese sus apellidos...",
        timer: 2000,
      });
      return false;
    }

    if (validarcorreo(correo) == false) {
      Swal.fire({
        icon: "info",
        title: "Ingrese un correo válido...",
        timer: 2000,
      });
      return false;
    }

    if (password == "" || password.length == 0) {
      Swal.fire({
        icon: "info",
        title: "Contraseña no puede estar vacía...",
        timer: 2000,
      });
      return false;
    } else if (password.length < 8) {
      Swal.fire({
        icon: "info",
        title: "Contraseña no puede tener menos de 8 dígitos...",
        timer: 2000,
      });
      return false;
    } else if (espacios) {
      Swal.fire({
        icon: "info",
        title: "Contraseña no puede tener espacios en blanco...",
        timer: 2000,
      });
      return false;
    } else if (validar_clave(password) == true) {
      $("#xbtnguardar").attr("disabled", true);
      $("#xbtnguardar").html("Registrando...");
      $.ajax({
        type: "POST",
        url: "/portaldistribuidor/conusuarios/mantenimiento_usuarios",
        data: {
          post: post,
          codigo: codigo,
          nombres: nombres,
          apellidos: apellidos,
          correo: correo,
          password: password,
          estado: estado,
          perfil: perfil,
          confirmar: confirmar,
        },
        success: function (res) {
          if (res.icase != 4) {
            Swal.fire({
              icon: res.vicon,
              title: res.vtitle,
              text: res.vtext,
              timer: res.itimer,
              timerProgressBar: res.vprogressbar,
              showCancelButton: false,
              showConfirmButton: false,
            });
            var id = setInterval(function () {
              location.reload();
              clearInterval(id);
            }, res.itimer);
            $("#modal-agregar").modal("hide");
          } else {
            Swal.fire({
              icon: res.vicon,
              title: res.vtitle,
              text: res.vtext,
              timer: res.itimer,
              timerProgressBar: res.vprogressbar,
              showCancelButton: false,
              showConfirmButton: false,
            });
          }
        },
      });
    } else {
      Swal.fire({
        icon: "info",
        title: "Contraseña no segura, ingrese mayúsculas y números...",
        timer: 4000,
      });
      return false;
    }
  });

  $("#xbtncancelar").on("click", function () {
    $("#modal-agregar").modal("hide");
  });

  $("#example1 tbody").on("click", "a.editar", function () {
    let post = 2; // consultar por id
    let id = $(this).attr("id");

    $("#idtabla").html("");
    $("#idtabla").html(id);

    $.ajax({
      type: "POST",
      url: "/portaldistribuidor/conusuarios/consulta_usuario",
      data: { post: post, id: id },
      success: function (res) {
        $("#codigo").val(res.icodigo);
        $("#nombres").val(res.vnombre);
        $("#apellidos").val(res.vapellido);
        $("#correo").val(res.vcorreo);
        $("#estado").val(res.iestado);
        comboperfil(res.iperfil);
        $("#confirmar").val(res.iconfirmar);
        $("#clavecon").val(res.iclaveconfirmacion);
        $("#foto").html("");
        $("#foto").attr("src", res.vfoto);
      },
    });

    $("#modal-editar").modal("show");
  });

  $("#modal-editar").on("shown.bs.modal", function () {
    $("#correo").focus();
  });

  $("#btncancelar").on("click", function () {
    $("#modal-editar").modal("hide");
  });

  // guardar cambios
  $("#btnguardar").on("click", function () {
    let post = 2; //update
    let codigo = $("#codigo").val(); //id del usuario
    let nombres = $("#nombres").val();
    let apellidos = $("#apellidos").val();
    let correo = $("#correo").val();
    let password = ""; // password no se usa
    let estado = $("#estado").val(); //activo
    let perfil = $("#perfil").val(); //se lleva el id perfil a actualizar
    let confirmar = $("#confirmar").val(); //se lleva el id perfil a actualizar

    Swal.fire({
      title:
        "Estas seguro de actualizar los datos del usuario " +
        nombres +
        " " +
        apellidos +
        "?",
      text: "Favor de confirmar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#61C250",
      cancelButtonColor: "#ea5455",
      confirmButtonText: "Si, guardar!", //<i class="fa fa-smile-wink"></i>
      cancelButtonText: "No", //<i class="fa fa-frown"></i>
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "/portaldistribuidor/conusuarios/mantenimiento_usuarios",
          data: {
            post: post,
            codigo: codigo,
            nombres: nombres,
            apellidos: apellidos,
            correo: correo,
            password: password,
            estado: estado,
            perfil: perfil,
            confirmar: confirmar,
          },
          success: function (res) {
            if (res.icase != 4) {
              Swal.fire({
                icon: res.vicon,
                title: res.vtitle,
                text: res.vtext,
                timer: res.itimer,
                timerProgressBar: res.vprogressbar,
                showCancelButton: false,
                showConfirmButton: false,
              });
              var id = setInterval(function () {
                location.reload();
                clearInterval(id);
              }, res.itimer);
              $("#modal-editar").modal("hide");
            } else {
              Swal.fire({
                icon: res.vicon,
                title: res.vtitle,
                text: res.vtext,
                timer: res.itimer,
                timerProgressBar: res.vprogressbar,
                showCancelButton: false,
                showConfirmButton: false,
              });
            }
          },
        });
      }
    });
  });

  // modal enviar correo
  $("#example1 tbody").on("click", "a.correo", function () {
    let post = 3; // consultar con formato para enviar correo por id
    let id = $(this).attr("id");

    $("#postasunto").val("");
    $("#mensaje").val("");

    $.ajax({
      type: "POST",
      url: "/portaldistribuidor/conusuarios/consulta_usuario",
      data: { post: post, id: id },
      success: function (res) {
        $("#postnombre").html(res.vnombre);
        $("#postpara").val(res.vcorreo);
        combocorreos(4, id);
      },
    });

    $("#modal-correo").modal("show");
  });

  $("#modal-correo").on("shown.bs.modal", function () {
    $("#postasunto").focus();
  });

  $("#btncancelarcorreo").on("click", function () {
    $("#modal-correo").modal("hide");
  });

  var arr = [];
  // seleccion de correo
  $(".select2").change(function () {
    arr = $(this).val();
    // arr = {id:$(this).val()};
    // datosaci.push({ id: countaci, acciones: accion, resultados: resultado });
    // console.log(arr);
    // console.log(JSON.stringify(arr));
  });

  // enviar correo
  $("#btnenviarcorreo").on("click", function () {
    let cnombre = $("#postnombre").text();
    let cpara = $("#postpara").val();
    let ccopia = arr;
    let casunto = $("#postasunto").val();
    let cmensaje = $("#mensaje").val();

    Swal.fire({
      title: "Estas seguro de enviar el correo al usuario " + cnombre + "?",
      text: "Favor de confirmar!",
      icon: "info",
      showCancelButton: true,
      confirmButtonColor: "#61C250",
      cancelButtonColor: "#ea5455",
      confirmButtonText: "Si, enviar!", //<i class="fa fa-smile-wink"></i>
      cancelButtonText: "No", //<i class="fa fa-frown"></i>
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "/portaldistribuidor/conusuarios/enviarcorreo",
          data: {
            cnombre: cnombre,
            cpara: cpara,
            ccopia: ccopia,
            casunto: casunto,
            cmensaje: cmensaje,
          },
          beforeSend: function () {
            // setting a timeout
            $("#btnenviarcorreo").attr("disabled", "disabled");
            $("#btncancelarcorreo").attr("disabled", "disabled");
            $("#btnenviarcorreo").html(
              "<span class='spinner-border spinner-border-sm'></span> \
                                <span class='ml-25 align-middle'>Enviando...</span>"
            );
            // $('#modal-correo').css('opacity', '.2');
          },
          success: function (res) {
            if ((res.correo = 1)) {
              Swal.fire({
                icon: "success",
                title: "Envio de correo",
                text: "Correo enviado correctamente",
                timer: 2000,
                timerProgressBar: true,
                showCancelButton: false,
                showConfirmButton: false,
              });
              var id = setInterval(function () {
                location.reload();
                clearInterval(id);
              }, 2000);
              $("#modal-correo").modal("hide");
            } else {
              Swal.fire({
                icon: "error",
                title: "Error al enviar correo",
                text: "Correo no enviado, intentelo mas tarde",
                timer: 3000,
                timerProgressBar: true,
                showCancelButton: false,
                showConfirmButton: false,
              });
              var id = setInterval(function () {
                location.reload();
                clearInterval(id);
              }, 3000);
              $("#modal-correo").modal("hide");
            }
          },
        });
      }
    });
  });
});

// crear tabla
function creardatatable(nombretabla, row, orden) {
  var tabla = $(nombretabla).dataTable({
    lengthChange: true,
    responsive: true,
    autoWidth: false,
    language: {
      decimal: "",
      emptyTable: "No hay información",
      info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
      infoFiltered: "(Filtrado de _MAX_ total entradas)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: "Mostrar _MENU_ Entradas",
      loadingRecords: "Cargando...",
      processing: "Procesando...",
      search: "Buscar:",
      zeroRecords: "Sin resultados encontrados",
      paginate: {
        first: "Primero",
        last: "Ultimo",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
    lengthMenu: [
      [25, 50, 100, -1],
      [25, 50, 100, "All"],
    ],
    order: [[orden, "asc"]],
  });
  return tabla;
}

function validar_clave(contrasenna) {
  if (contrasenna.length >= 8) {
    var mayuscula = false;
    var minuscula = false;
    var numero = false;
    var caracter_raro = false;

    for (var i = 0; i < contrasenna.length; i++) {
      if (contrasenna.charCodeAt(i) >= 65 && contrasenna.charCodeAt(i) <= 90) {
        mayuscula = true;
      } else if (
        contrasenna.charCodeAt(i) >= 97 &&
        contrasenna.charCodeAt(i) <= 122
      ) {
        minuscula = true;
      } else if (
        contrasenna.charCodeAt(i) >= 48 &&
        contrasenna.charCodeAt(i) <= 57
      ) {
        numero = true;
      } else {
        caracter_raro = true;
      }
    }
    if (
      (mayuscula == true && minuscula == true && numero == true) ||
      caracter_raro == true
    ) {
      return true;
    }
  }
  return false;
}

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

$(".char-textarea-mision").on("keyup", function (event) {
  checkTextAreaMaxLength(
    this,
    event,
    ".textarea-counter-value",
    ".char-textarea-mision",
    ".char-count-mision"
  );
  $(this).addClass("active");
});

function checkTextAreaMaxLength(textBox, e, x, y, z) {
  var maxLength = parseInt($(textBox).data("length")),
    counterValue = $(x),
    charTextarea = $(y);

  if (!checkSpecialKeys(e)) {
    if (textBox.value.length < maxLength - 1)
      textBox.value = textBox.value.substring(0, maxLength);
  }
  $(z).html(textBox.value.length);
  // if (textBox.value.length > maxLength) {
  //   counterValue.css("background-color", window.colors.solid.danger);
  //   charTextarea.css("color", window.colors.solid.danger);
  //   charTextarea.addClass("max-limit");
  // } else {
  //   counterValue.css("background-color", window.colors.solid.primary);
  //   charTextarea.css("color", $textcolor);
  //   charTextarea.removeClass("max-limit");
  // }
  return true;
}

function checkSpecialKeys(e) {
  if (
    e.keyCode != 8 &&
    e.keyCode != 46 &&
    e.keyCode != 37 &&
    e.keyCode != 38 &&
    e.keyCode != 39 &&
    e.keyCode != 40
  )
    return false;
  else return true;
}

// crear combo menu
function comboperfil(perfil) {
  $.ajax({
    type: "POST",
    url: "/portaldistribuidor/conusuarios/comboperfil",
    data: { perfil: perfil },
    success: function (res) {
      $("#perfil").html("");
      $("#perfil").append(res.data);
    },
  });
}

// crear combo menu
function combocorreos(post, id) {
  $.ajax({
    type: "POST",
    url: "/portaldistribuidor/conusuarios/combocorreos",
    data: { post: post, id: id },
    success: function (res) {
      $("#postcc").html("");
      $("#postcc").append(res.data);
    },
  });
}

// padres menu
function navegacionmenu(string) {
  $.ajax({
    type: "POST",
    url: "/portaldistribuidor/dashboard/cambiarsession",
    data: { string: string },
  });
  var dato = ""; //cerrado
  $.ajax({
    type: "POST",
    url: "/portaldistribuidor/dashboard/cambiaropen",
    data: { string: dato },
  });
}

// hijos submenu
function clicksub(string) {
  $.ajax({
    type: "POST",
    url: "/portaldistribuidor/dashboard/cambiarsessionsub",
    data: { string: string },
  });
  var dato = "open"; //cerrado
  $.ajax({
    type: "POST",
    url: "/portaldistribuidor/dashboard/cambiaropen",
    data: { string: dato },
  });
}
