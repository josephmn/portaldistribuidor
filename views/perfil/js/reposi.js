// oopcion 1

var countaci = 1;
var datosaci = [];
Dropzone.autoDiscover = false;
var myDropzone = new Dropzone(".dropzone", {
  autoProcessQueue: false,
  maxFilesize: 1,
  acceptedFiles: ".jpeg,.jpg,.png,.pdf",
  parallelUploads: 10, // Number of files process at a time (default 2)
  addRemoveLinks: true,
  dictRemoveFile: "<a class='badge badge-danger' href='#'><i class='fas fa-trash-alt'></i> Eliminar</a>",
  success: function (file) {
    let name = file.name;
    let size = Math.round(file.size / 1024);
    let type = file.type;
    file.previewElement.classList.add("dz-success");
    console.log("Successfully uploaded :" + name);
    datosaci.push({ id: countaci, name: name, size: size, type: type });
    console.log(datosaci);
    // console.log(JSON.stringify(datosaci));

    countaci = countaci + 1;
  },
  // error: function (file, response) {
  //   file.previewElement.classList.add("dz-error"),"Hola";
  // },
  removedfile: function (file) {
    var fileName = file.name;
    $.ajax({
      type: "POST",
      url: "/reclutamiento/perfil/subir_archivos",
      data: { name: fileName, request: "delete" },
      sucess: function (data) {
        console.log("success:" + data);
      },
    });
    var _ref;
    return (_ref = file.previewElement) != null
      ? _ref.parentNode.removeChild(file.previewElement)
      : void 0;
  },
});

$("#uploadfiles").click(function () {
  myDropzone.processQueue();
});

/* html
<form action="/reclutamiento/perfil/subir_archivos" class="dropzone dropzone-area">
<div class="dz-default dz-message">Click o arrastrar archivos (*.jpeg, *.jpg, *.png, *.pdf)</div>
</form>

<br>
<input class="btn btn-warning" type="button" id='uploadfiles' value='Subir Archivos'>
*/

///





//// opcion 2

acceptFiles1.dropzone({
    url: "/reclutamiento/perfil/subir_archivos_img",
    // paramName: "file", // The name that will be used to transfer the file
    // maxFilesize: 10, // MB
    // maxFiles: 10,
    // acceptedFiles: "image/*",
    // addRemoveLinks: true,
    // dictRemoveFile: "<a class='badge badge-danger' href='#'><i class='fas fa-trash-alt'></i> Eliminar</a>",
    paramName: "file",
    maxFilesize: 1,
    maxFiles: 10,
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    addRemoveLinks: true,
    removedfile: function (file) {
      var fileName = file.name;
  
      $.ajax({
        type: "POST",
        url: "/reclutamiento/perfil/subir_archivos_img",
        data: { name: fileName, request: "delete" },
        sucess: function (data) {
          console.log("success:" + data);
        },
      });
  
      var _ref;
      return (_ref = file.previewElement) != null
        ? _ref.parentNode.removeChild(file.previewElement)
        : void 0;
    },
  });
  
  
  
  /* php
          if (isset($_SESSION['usuario'])) {
  
              $uploadDir = 'public/doc/documentos';
  
              if ($_POST['request'] == "add") {
                  if (!empty($_FILES)) {
                   $tmpFile = $_FILES['file']['tmp_name'];
                   $filename = $uploadDir.'/'.$_FILES['file']['name'];
                   move_uploaded_file($tmpFile ,$filename);
                  }
              }else{
                  $fileName = $uploadDir.'/'.$_POST['name'];  
                  unlink($fileName); 
              }
  
          } else {
              $this->redireccionar('index/logout');
          }
    */
////


/// opcion 3

var countaci = 1;
var datosaci = [];
Dropzone.autoDiscover = false;
$("#dZUpload").dropzone({
    url: "/reclutamiento/perfil/subir_archivos",
    maxFilesize: 1, // MB
    maxFiles: 10,
    acceptedFiles: ".jpeg,.jpg,.png,.pdf",
    addRemoveLinks: false,
    success: function (file, response) {
        let name =  file.name;
        let size = Math.round((file.size)/1024);
        let type = file.type;
        file.previewElement.classList.add("dz-success");
        console.log("Successfully uploaded :" + name);
        datosaci.push({ id: countaci, name: name, size: size, type: type });
        console.log(datosaci);
        // console.log(JSON.stringify(datosaci));
    
        countaci = countaci + 1;
    },
    error: function (file, response) {
        file.previewElement.classList.add("dz-error");
    }
});



<div id="dZUpload" class="dropzone dropzone-area">
  <div class="dz-default dz-message">Archivo CV (*.jpeg, *.jpg, *.png, *.pdf)</div>
</div>

///