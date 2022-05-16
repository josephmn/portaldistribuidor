$(function () {
  //tabla.- index
  creardatatable("#example1", 100, 0);

  $("#ruc").on("change", function () {
    let ruc = $("#ruc").val();
    $.ajax({
      type: "POST",
      url: "/portaldistribuidor/equivalencias/combo_productos",
      data: { ruc: ruc },
      success: function (res) {
        $("#producto").html("");
        $("#producto").append(res.cboproduct);
      },
    });
  });

  var Toast = Swal.mixin({
    toast: true,
    position: "top-right",
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
  });

  // let number = 123456789;
  // console.log(new Intl.NumberFormat("en-IN").format(number));

  // filtro por fechas
  $("#btnregistrar").on("click", function () {
    let post = 1; // insert
    let id = 0; // no se usa aqui
    let ruc = $("#ruc").val();
    let estado = 1;
    let razon = $("#ruc option:selected").text();
    let producto = $("#producto").val();
    let verdum = $("#verdum").val();
    let min = $("#minvalor").val();
    let max = $("#maxvalor").val();

    if (ruc == "00000000000" || ruc == null) {
      Toast.fire({
        icon: "error",
        title: "No ha seleccionado un ruc de distribuidor..!!",
      });
      $("#msj-ruc").append("");
      $("#msj-ruc").html(
        "<div class='alert-warning'>Seleccione un distribuidor...!!!</div>"
      );
      setTimeout(function () {
        $("#msj-ruc").html("");
      }, 5000);
      $("#ruc").focus();
      return;
    }

    if (producto == "00000" || producto == null) {
      Toast.fire({
        icon: "error",
        title: "No ha seleccionado un producto del distribuidor..!!",
      });
      $("#msj-producto").append("");
      $("#msj-producto").html(
        "<div class='alert-warning'>Seleccione un producto del distribuidor...!!!</div>"
      );
      setTimeout(function () {
        $("#msj-producto").html("");
      }, 5000);
      $("#producto").focus();
      return;
    }

    if (verdum == "00000" || verdum == null) {
      Toast.fire({
        icon: "error",
        title: "No ha seleccionado un producto de Verdum..!!",
      });
      $("#msj-verdum").append("");
      $("#msj-verdum").html(
        "<div class='alert-warning'>Seleccione un producto de Verdum...!!!</div>"
      );
      setTimeout(function () {
        $("#msj-verdum").html("");
      }, 5000);
      $("#verdum").focus();
      return;
    }

    if (min == "" || min == null) {
      Toast.fire({
        icon: "error",
        title: "No ha ingresado un valor mínimo..!!",
      });
      $("#min-verdum").append("");
      $("#min-verdum").html(
        "<div class='alert-warning'>No ha ingresado un valor mínimo..!!</div>"
      );
      setTimeout(function () {
        $("#min-verdum").html("");
      }, 5000);
      $("#minvalor").focus();
      return;
    }

    if (max == "" || max == null) {
      Toast.fire({
        icon: "error",
        title: "No ha ingresado un valor máximo..!!",
      });
      $("#max-verdum").append("");
      $("#max-verdum").html(
        "<div class='alert-warning'>No ha ingresado un valor máximo..!!</div>"
      );
      setTimeout(function () {
        $("#max-verdum").html("");
      }, 5000);
      $("#maxvalor").focus();
      return;
    }

    Swal.fire({
      html:
        "Estas seguro de guardar la equivalencia para <b>" +
        razon +
        "</b>? \
              <br>\
              <br>\
              <b>" +
        producto +
        "</b> --> <b>" +
        verdum +
        "</b>.",
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
          url: "/portaldistribuidor/equivalencias/mantenimiento_equivalencia",
          data: {
            post: post,
            id: id,
            ruc: ruc,
            estado: estado,
            producto: producto,
            verdum: verdum,
            min: min,
            max: max,
          },
          beforeSend: function () {
            $("#btnregistrar").attr("disabled", "disabled");
            $("#btnregistrar").html(
              "<span class='spinner-border spinner-border-sm'></span> \
                                  <span class='ml-25 align-middle'>Guardando equivalencia...</span>"
            );
          },
          success: function (res) {
            if (res.icase < 4) {
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

  // eliminar registro
  $("#example1 tbody").on("click", "a.delete", function () {
    let post = 3; // delete
    let id = $(this).attr("id");
    let ruc = "";
    let estado = 0;
    let producto = "";
    let verdum = "";
    let min = 0;
    let max = 0;

    Swal.fire({
      title: "Estas seguro de eliminar la dato de equivalencia?",
      text: "Favor de confirmar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#61C250",
      cancelButtonColor: "#ea5455",
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "No",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "/portaldistribuidor/equivalencias/mantenimiento_equivalencia",
          data: {
            post: post,
            id: id,
            ruc: ruc,
            estado: estado,
            producto: producto,
            verdum: verdum,
            min: min,
            max: max,
          },
          success: function (res) {
            if (res.icase < 4) {
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
    lengthMenu: [[row], [row + "rows"]],
    order: [[orden, "asc"]],
    dom: "Bfrtip",
    buttons: [
      "excel",
      // "pdf",
      "print",
      {
        extend: "pdfHtml5",
        orientation: "landscape",
        pageSize: "LEGAL",
      },
    ],
  });
  return tabla;
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
