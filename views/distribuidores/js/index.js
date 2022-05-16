$(function () {
  //cargar deshabilitado los input
  $("#ruc").attr("readonly", true);

  creardatatable("#example1", 10, 0); //tabla.- index

  // crear distribuidor
  $("#btnperfil").on("click", function () {
    $("#modal-agregar").modal("show");
  });

  $("#modal-agregar").on("shown.bs.modal", function () {
    $("#xruc").focus();
  });

  // guardar cambios
  $("#xbtnguardar").on("click", function () {
    let post = 1; //insert
    let ruc = $("#xruc").val(); //ruc distribuidor
    let razon = $("#xrazon").val(); //razon distribuidor
    let estado = 1; //activo

    if (ruc == null || ruc == "") {
      Swal.fire({
        icon: "info",
        title: "No ha ingresado el RUC del distribuidor",
        text: "Favor de ingresar el RUC para registrar...!!",
        timer: 3000,
        timerProgressBar: true,
        showCancelButton: false,
        showConfirmButton: false,
      });
      return;
    }

    if (ruc.length < 11 || ruc.length > 11) {
      Swal.fire({
        icon: "error",
        title: "No ha ingresado el RUC correctamente",
        text: "RUC contiene 11 dígitos...!!",
        timer: 3000,
        timerProgressBar: true,
        showCancelButton: false,
        showConfirmButton: false,
      });
      return;
    }

    if (razon == null || razon == "") {
      Swal.fire({
        icon: "info",
        title: "No ha ingresado la RAZON SOCIAL del distribuidor",
        text: "Favor de ingresarlo correctamente para registrar...!!",
        timer: 3000,
        timerProgressBar: true,
        showCancelButton: false,
        showConfirmButton: false,
      });
      return;
    }

    Swal.fire({
      title: "Estas seguro de registrar al Distribuidor?",
      text: "Favor de confirmar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#61C250",
      cancelButtonColor: "#ea5455",
      confirmButtonText: "Si, registrar!", //<i class="fa fa-smile-wink"></i>
      cancelButtonText: "No", //<i class="fa fa-frown"></i>
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "/portaldistribuidor/distribuidores/mantenimiento_distribuidor",
          data: {
            post: post,
            ruc: ruc,
            razon: razon,
            estado: estado,
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

  $("#xbtncancelar").on("click", function () {
    $("#modal-agregar").modal("hide");
  });

  // actualizar distribuidor
  $("#example1 tbody").on("click", "a.editar", function () {
    let ruc = $(this).attr("id");
    let razon = $(this).attr("razon");
    let estado = $(this).attr("estado");

    $("#ruc").val("");
    $("#ruc").val(ruc);
    $("#razon").val("");
    $("#razon").val(razon);
    $("#estado").val("");
    $("#estado").val(estado);

    $("#modal-editar").modal("show");
  });

  $("#modal-editar").on("shown.bs.modal", function () {
    $("#razon").focus();
  });

  // actualizar cambios
  $("#btnguardar").on("click", function () {
    let post = 2; //update
    let ruc = $("#ruc").val(); //ruc
    let razon = $("#razon").val(); //razon social
    let estado = $("#estado").val(); //activo

    if (ruc == null || ruc == "") {
      Swal.fire({
        icon: "info",
        title: "No ha ingresado el RUC del distribuidor",
        text: "Favor de ingresar el RUC para registrar...!!",
        timer: 3000,
        timerProgressBar: true,
        showCancelButton: false,
        showConfirmButton: false,
      });
      return;
    }

    if (ruc.length < 11 || ruc.length > 11) {
      Swal.fire({
        icon: "error",
        title: "No ha ingresado el RUC correctamente",
        text: "RUC contiene 11 dígitos...!!",
        timer: 3000,
        timerProgressBar: true,
        showCancelButton: false,
        showConfirmButton: false,
      });
      return;
    }

    if (razon == null || razon == "") {
      Swal.fire({
        icon: "info",
        title: "No ha ingresado la RAZON SOCIAL del distribuidor",
        text: "Favor de ingresarlo correctamente para registrar...!!",
        timer: 3000,
        timerProgressBar: true,
        showCancelButton: false,
        showConfirmButton: false,
      });
      return;
    }

    Swal.fire({
      title: "Estas seguro de actualizar al discribuidor?",
      text: "Favor de confirmar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#61C250",
      cancelButtonColor: "#ea5455",
      confirmButtonText: "Si, actualizar!", //<i class="fa fa-smile-wink"></i>
      cancelButtonText: "No", //<i class="fa fa-frown"></i>
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "/portaldistribuidor/distribuidores/mantenimiento_distribuidor",
          data: {
            post: post,
            ruc: ruc,
            razon: razon,
            estado: estado,
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

  $("#btncancelar").on("click", function () {
    $("#modal-editar").modal("hide");
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

// function numberOnly(id) {
//   var element = document.getElementById(id);
//   element.value = element.value.replace(/[^0-9]/gi, "");
// }

// SOLO LETRAS
function sololetras(event) {
  var regex = new RegExp("^[a-zA-Z ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
}

// SOLO NÚMEROS
function solonumero(event) {
  var regex = new RegExp("^[0-9]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
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
