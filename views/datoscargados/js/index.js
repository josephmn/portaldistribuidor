$(function () {
  //cargar deshabilitado los input
  $("#codigo").attr("readonly", true);

  creardatatable("#example1", 100, 0); //tabla.- index

  $("#example1 tbody").on("click", "a.eliminar", function () {
    let post = 3; //delete
    let id = $(this).attr("id"); //correlativo identity
    let ruc = $(this).attr("ruc"); //ruc

    Swal.fire({
      title: "Estas seguro de eliminar el registro duplicado?",
      text: "Favor de confirmar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#61C250",
      cancelButtonColor: "#ea5455",
      confirmButtonText: "Si, eliminar!", //<i class="fa fa-smile-wink"></i>
      cancelButtonText: "No", //<i class="fa fa-frown"></i>
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "POST",
          url: "/portaldistribuidor/datoscargados/mantenimiento_duplicados",
          data: {
            post: post,
            id: id,
            ruc: ruc,
          },
          success: function (res) {
            if (res.icase < 5) {
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

  $("#btnmasivo").on("click", function () {
    let post = 4; //delete masivo por ruc
    let id = 0; //correlativo identity (no se usa aqui)
    let ruc = $("#ruc2").val(); //ruc

    // console.log(ruc);

    if (ruc == "" || ruc == null || ruc == "00000000000") {
      Swal.fire({
        icon: "info",
        title: "No ha seleccionado un distribuidor para eliminar",
        text: "Favor de seleccionar uno!",
        timer: 3000,
        timerProgressBar: true,
      });
      return;
    }

    Swal.fire({
      title:
        "Estas seguro de eliminar todos los registros duplicado del distribuidor con RUC: " +
        ruc +
        "?",
      text: "Favor de confirmar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#61C250",
      cancelButtonColor: "#ea5455",
      confirmButtonText: "Si, eliminar!", //<i class="fa fa-smile-wink"></i>
      cancelButtonText: "No", //<i class="fa fa-frown"></i>
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "POST",
          url: "/portaldistribuidor/datoscargados/mantenimiento_duplicados",
          data: {
            post: post,
            id: id,
            ruc: ruc,
          },
          beforeSend: function () {
            $("#modal-insert").modal("show");
            var n = 0;
            var l = document.getElementById("number");
            window.setInterval(function () {
              l.innerHTML = n;
              n++;
            }, 2000);
            // setting a timeout
            // $(placeholder).addClass("loading");
          },
          success: function (res) {
            $("#modal-insert").modal("hide");
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

  $("#btnfull").on("click", function () {
    let post = 5; //delete total duplicados sin restriccion de ruc
    let id = 0; //correlativo identity (no se usa aqui)
    let ruc = ""; //ruc

    Swal.fire({
      title:
        "Estas seguro de eliminar todos los registros duplicados de la base de datos?",
      text: "Favor de confirmar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#61C250",
      cancelButtonColor: "#ea5455",
      confirmButtonText: "Si, eliminar!", //<i class="fa fa-smile-wink"></i>
      cancelButtonText: "No", //<i class="fa fa-frown"></i>
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "POST",
          url: "/portaldistribuidor/datoscargados/mantenimiento_duplicados",
          data: {
            post: post,
            id: id,
            ruc: ruc,
          },
          beforeSend: function () {
            $("#modal-insert").modal("show");
            var n = 0;
            var l = document.getElementById("number");
            window.setInterval(function () {
              l.innerHTML = n;
              n++;
            }, 2000);
            // setting a timeout
            // $(placeholder).addClass("loading");
          },
          success: function (res) {
            $("#modal-insert").modal("hide");
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
