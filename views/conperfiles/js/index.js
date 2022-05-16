$(function () {
  //cargar deshabilitado los input
  $("#codigo").attr("readonly", true);

  creardatatable("#example1", 10, 0); //tabla.- index

  $("#example1 tbody").on("click", "a.editar", function () {
    let id = $(this).attr("id");
    let nombre = $(this).attr("nombre");
    let estado = $(this).attr("estado");

    $("#idtabla").html("");
    $("#idtabla").html(id);

    $("#codigo").val("");
    $("#codigo").val(id);
    $("#nombre").val("");
    $("#nombre").val(nombre);
    $("#estado").val("");
    $("#estado").val(estado);

    $("#modal-editar").modal("show");
  });

  $("#modal-editar").on("shown.bs.modal", function () {
    $("#nombre").focus();
  });

  $("#btncancelar").on("click", function () {
    $("#modal-editar").modal("hide");
  });

  // guardar cambios
  $("#btnguardar").on("click", function () {
    let post = 2; //update
    let nombre = $("#nombre").val(); //nombre del perfil
    let estado = $("#estado").val(); //activo
    let perfil = $("#codigo").val(); //se lleva el id perfil a actualizar

    if (nombre == null || nombre == "") {
      Swal.fire({
        icon: "info",
        title: "No ha ingresado un nombre de perfil",
        text: "Favor de ingresar un nombre para registrar...!!",
        timer: 3000,
        timerProgressBar: true,
        showCancelButton: false,
        showConfirmButton: false,
      });
      return;
    }

    Swal.fire({
      title: "Estas seguro de actualizar el siguiente perfil?",
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
          url: "/portaldistribuidor/conperfiles/mantenimiento_perfil",
          data: {
            post: post,
            nombre: nombre,
            estado: estado,
            perfil: perfil,
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

  // crear perfil
  $("#btnperfil").on("click", function () {
    $("#modal-agregar").modal("show");
  });

  // guardar cambios
  $("#xbtnguardar").on("click", function () {
    let post = 1; //insert
    let nombre = $("#xnombre").val(); //nombre del perfil
    let estado = 1; //activo
    let perfil = 3; //se crea como 3

    if (nombre == null || nombre == "") {
      Swal.fire({
        icon: "info",
        title: "No ha ingresado un nombre de perfil",
        text: "Favor de ingresar un nombre para registrar...!!",
        timer: 3000,
        timerProgressBar: true,
        showCancelButton: false,
        showConfirmButton: false,
      });
      return;
    }

    Swal.fire({
      title: "Estas seguro de crear el siguiente perfil?",
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
          url: "/portaldistribuidor/conperfiles/mantenimiento_perfil",
          data: {
            post: post,
            nombre: nombre,
            estado: estado,
            perfil: perfil,
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
      }
    });
  });

  $("#modal-agregar").on("shown.bs.modal", function () {
    $("#xnombre").focus();
  });

  $("#xbtncancelar").on("click", function () {
    $("#modal-agregar").modal("hide");
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
    lengthMenu: [row],
    order: [[orden, "asc"]],
  });
  return tabla;
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
