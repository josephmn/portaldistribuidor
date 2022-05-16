$(function () {
  //cargar deshabilitado los input
  $("#codigo").attr("readonly", true);

  creardatatable("#example1", 100, 0); //tabla.- index

  // boton para modal
  $("#btnfiltro").on("click", function () {
    $("#fechainicio").flatpickr({
      enableTime: false,
      dateFormat: "Y-m-d",
      defaultDate: Date.now(),
    });

    $("#fechafin").flatpickr({
      enableTime: false,
      dateFormat: "Y-m-d",
      defaultDate: Date.now(),
    });

    $("#modal-filtro").modal("show");
  });

  // array de selet2
  var arrdistribuidor = [];

  $(".distribuidor").change(function () {
    arrdistribuidor = $(this).val();
  });

  // boton cancelar
  $("#btncancelar").on("click", function () {
    $("#modal-filtro").modal("hide");
  });

  // filtro por fechas
  $("#btnfiltrofecha").on("click", function () {
    // console.log(arrdepartamento);
    // console.log(arrdistrito);
    // console.log(arrdistribuidor);

    let post = 1; //filtro por fecha
    let finicio = $("#finicio").val(); //fechainicio
    let ffin = $("#ffin").val(); //fechafin
    let distribuidor = "";

    Swal.fire({
      title: "Estas seguro de cargar las ventas con los filtros seleccionados?",
      text: "Favor de confirmar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#61C250",
      cancelButtonColor: "#ea5455",
      confirmButtonText: "Si, cargar!", //<i class="fa fa-smile-wink"></i>
      cancelButtonText: "No", //<i class="fa fa-frown"></i>
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "/portaldistribuidor/reportestock/filtro",
          data: {
            post: post,
            finicio: finicio,
            ffin: ffin,
            distribuidor: distribuidor,
          },
          beforeSend: function () {
            $("#btnfiltrofecha").attr("disabled", "disabled");
            $("#btnfiltrofecha").html(
              "<span class='spinner-border spinner-border-sm'></span> \
                                  <span class='ml-25 align-middle'>Cargando reporte...</span>"
            );
          },
          success: function (res) {
            $("#btnfiltrofecha").prop("disabled", false);
            $("#btnfiltrofecha").html("Filtrar fechas");

            $("#example1").dataTable().fnDestroy();
            $("#table").html("");
            $("#table").append(res.datatable);
            creardatatable("#example1", 100, 0);

            $("#modal-filtro").modal("hide");
          },
        });
      }
    });
  });

  // filtro personalizado
  $("#btnaceptar").on("click", function () {
    // console.log(arrdistribuidor);

    let post = 2; //filtro personalizado
    let finicio = $("#fechainicio").val(); //fechainicio
    let ffin = $("#fechafin").val(); //fechafin
    let distribuidor = arrdistribuidor; //array de distribuidor

    Swal.fire({
      title: "Estas seguro de cargar las ventas con los filtros seleccionados?",
      text: "Favor de confirmar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#61C250",
      cancelButtonColor: "#ea5455",
      confirmButtonText: "Si, cargar!", //<i class="fa fa-smile-wink"></i>
      cancelButtonText: "No", //<i class="fa fa-frown"></i>
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "/portaldistribuidor/reportestock/filtro",
          data: {
            post: post,
            finicio: finicio,
            ffin: ffin,
            distribuidor: distribuidor,
          },
          beforeSend: function () {
            $("#btnaceptar").attr("disabled", "disabled");
            $("#btnaceptar").html(
              "<span class='spinner-border spinner-border-sm'></span> \
                                <span class='ml-25 align-middle'>Cargando reporte...</span>"
            );
          },
          success: function (res) {
            $("#btnaceptar").prop("disabled", false);
            $("#btnaceptar").html("Cargar datos");

            $("#example1").dataTable().fnDestroy();
            $("#table").html("");
            $("#table").append(res.datatable);
            creardatatable("#example1", 100, 0);

            $("#modal-filtro").modal("hide");
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
