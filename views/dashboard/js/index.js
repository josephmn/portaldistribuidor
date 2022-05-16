$(function () {
  creardatatable("#example1"); //tabla.- dashboard
  // $(".carousel").attr("data-interval", "10000");
});

function removeElement(id) {
  var elem = document.getElementById(id);
  return elem.parentNode.removeChild(elem);
}

// crear tabla
function creardatatable(nombretabla) {
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
    lengthMenu: [[4], ["4"]],
    order: [[0, "asc"]],
  });
  return tabla;
}

function clickpuesto(string) {
  $.ajax({
    type: "POST",
    url: "/portaldistribuidor/dashboard/publicacion_detalle",
    data: { codigo: string },
    beforeSend: function () {
      $("#div-00").html("");
      $("#div-00").append(
        "<div id='div-00'>\
            <div class='d-flex justify-content-center my-1'>\
                <div class='spinner-border' role='status' aria-hidden='true'></div>\
            </div>\
          </div>"
      );
    },
    success: function (res) {
      $("#div-00").html("");
      $("#div-00").append(res.data);
    },
  });

  if (screen.width < 850) {
    var dest = $("#div-00").offset().top;
    $("html, body").animate({ scrollTop: dest }, 300);
  }
}

// click en postularme
function clickpostularme(string) {
  Swal.fire({
    title: "Estas seguro de postular al siguiente puesto?",
    text: "No olvides que tiene que cargar o subir tu CV!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#61C250",
    cancelButtonColor: "#ea5455",
    confirmButtonText: "Si, postularme!", //<i class="fa fa-smile-wink"></i>
    cancelButtonText: "No", //<i class="fa fa-frown"></i>
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "/portaldistribuidor/dashboard/postulacion",
        data: { puesto: string },
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
      // Swal.fire({
      //   title: "Gracias, pronto nos contactaremos contigo",
      //   html:
      //   'Puedes hacer el seguimiento de la postulacion en la pestaña de ' +
      //   '<a href="http://localhost:8080/portaldistribuidor/index/index">seguimientos</a> ',
      //   icon: "success",
      //   timer: 7000,
      //   timerProgressBar: true,
      //   showCancelButton: false,
      //   showConfirmButton: false,
      // })
    }
  });
}

// padres
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

// hijos
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
