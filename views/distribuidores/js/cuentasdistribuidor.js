$(function () {
  //cargar deshabilitado los input
  $("#ruc,#razon").attr("readonly", true);

  creardatatable("#example1", 10, 0); //tabla.- index

  //modal agregar
  $("#btnusuarios").on("click", function () {
    $("#modal-agregar").modal("show");
    combocorreos();
  });

  $("#modal-agregar").on("shown.bs.modal", function () {
    $("#xusuarios").focus();
  });

  var arr = [];
  // seleccion de correo
  $(".select2").change(function () {
    arr = $(this).val();
  });

  // guardar cambios
  $("#btnguardar").on("click", function () {
    let post = 2; //update
    let usuario = arr; //array de usuarios
    let ruc = $("#ruc").val(); //ruc
    let razon = $("#razon").val(); //razon

    if (usuario.length == null || usuario.length == "") {
      Swal.fire({
        icon: "info",
        title: "No ha seleccionado a ningun usuario",
        text: "Favor de seleccionar al menos a uno, para guardar...!!",
        timer: 3000,
        timerProgressBar: true,
        showCancelButton: false,
        showConfirmButton: false,
      });
      return;
    }

    Swal.fire({
      title:
        "Estas seguro de asignar al(los) usuario(s) al distribuidor " +
        razon +
        " ?",
      text: "Favor de confirmar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#61C250",
      cancelButtonColor: "#ea5455",
      confirmButtonText: "Si, asignar!", //<i class="fa fa-smile-wink"></i>
      cancelButtonText: "No", //<i class="fa fa-frown"></i>
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "/portaldistribuidor/distribuidores/asignar_distribuidor",
          data: {
            post: post,
            usuario: usuario,
            ruc: ruc,
          },
          beforeSend: function () {
            // setting a timeout
            $("#btnguardar").attr("disabled", "disabled");
            $("#btncancelar").attr("disabled", "disabled");
            $("#btnguardar").html(
              "<span class='spinner-border spinner-border-sm'></span> \
                                <span class='ml-25 align-middle'>Asignando...</span>"
            );
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
              $("#btnguardar").attr("disabled", false);
              $("#btncancelar").attr("disabled", false);
              $("#btnguardar").html("Guardar");
            }
          },
        });
      }
    });
  });

  $("#btncancelar").on("click", function () {
    $("#modal-agregar").modal("hide");
  });

  // eliminar asigancion
  $("#example1 tbody td").on("click", "a.eliminar", function () {
    let post = 3; //delete (update)
    let usuario = $(this).attr("id");; //id de usuario
    let ruc = $("#ruc").val(); //ruc
    let razon = $("#razon").val(); //razon

    Swal.fire({
      title: "Estas seguro de eliminar el usuario del distribuidor: " + razon + " ?",
      text: "Favor de confirmar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#61C250",
      cancelButtonColor: "#ea5455",
      confirmButtonText: "Si, eliminar!", //<i class="fa fa-smile-wink"></i>
      cancelButtonText: "No", //<i class="fa fa-frown"></i>
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "/portaldistribuidor/distribuidores/asignar_distribuidor",
          data: {
            post: post,
            usuario: usuario,
            ruc: ruc,
          },
          success: function (res) {
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
    lengthMenu: [row],
    order: [[orden, "asc"]],
  });
  return tabla;
}

// crear combo menu
function combocorreos() {
  $.ajax({
    type: "POST",
    url: "/portaldistribuidor/distribuidores/combousuarios",
    success: function (res) {
      $("#xusuarios").html("");
      $("#xusuarios").append(res.data);
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
