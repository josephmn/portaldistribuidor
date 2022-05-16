$(function () {
  creardatatable("#example1", 15, 0, "desc"); //tabla.- index

  // CARGAR ARCHIVO IMAGEN
  $("#btnsubir").on("click", function () {
    var formData = new FormData();
    let documento = $("#documento")[0].files[0];
    let fecha = $("#fecha").val();
    formData.append("documento", documento);
    formData.append("fecha", fecha);
    $.ajax({
      url: "/portaldistribuidor/subirventas/cargar_datos",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
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
        // JSON.stringify(res.dato);
        // console.log(res.dato);
        // console.log(res.count);
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
  });
});

// crear tabla
function creardatatable(nombretabla, row, orden, asde) {
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
    order: [[orden, asde]],
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
