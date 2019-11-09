var imagenes = Array();
var imgFiles = document.getElementById('input-file');
var idRow = 0;

onload = function(){
  document.getElementById('btn-add-image').onclick = imagen.buscar;
  document.getElementById('input-file').onchange = imagen.cargar;
  document.getElementById('btnGrabar').onclick = botones.grabar;
  document.getElementById('btnEliminar').onclick = botones.eliminar;
}

var imagen = {
  buscar: function(){
    var input = document.getElementById('imagen-'+idRow);
    if(input != null )input.remove();
    
    var inputFile = document.createElement('INPUT');
    var divImages = document.getElementById('div-imagenes');
    inputFile.type = "file";
    inputFile.name = "imagen[]";
    inputFile.id = "imagen-"+idRow;
    inputFile.style.display = "none";               
    inputFile.onchange = imagen.cargar;
    divImages.append(inputFile);
    inputFile.click();
  },

  cargar: function(){
    file = document.getElementById('imagen-'+idRow).files;
    if(file[0] != undefined)
    { 
      //imagenes[idRow] = file[0];
      var tbody = document.getElementById('tbody');
      var newRow = tbody.insertRow(tbody.rows.length);
      newRow.id =  "row-"+idRow;
      newRow.innerHTML = `<td>
                            <img class='img-responsive' src="${URL.createObjectURL(event.target.files[0])}"></td>
                          <td class="col-align-left">${file[0].name}<input type="hidden" name="imagenes[]" value="${file[0].name}"/></td>
                          <td class="col-align-center">
                            <input type="radio" id="option-${file[0].name}" name="default-image" data-fila="${file[0].name}" onchange="changeDefaultImage('${file[0].name}')"/>                            
                          </td>
                          <td class="col-align-center">
                            <span onclick="eliminarImagen(${idRow}, true)"><i class="fa fa-trash"></i></span>
                          </td>`;

      idRow++;
    }
  },

  eliminarNueva: function(id){
    document.getElementById('row-'+id).remove();
    if(document.getElementById('imagen-'+id) != null)
      document.getElementById('imagen-'+id).remove();
  },

  eliminarExistente: function(id){
    document.getElementById('row-img'+id).remove();

    var inputFile = document.createElement('INPUT');
    var divImagesDeletes = document.getElementById('div-imagenes-eliminadas');
    inputFile.type = "hidden";
    inputFile.name = "eliminadas[]";
    inputFile.id = "eliminadas-"+id;      
    inputFile.value = id;
    divImagesDeletes.append(inputFile);
    
  },

  changeDefaultImage: function(imagen){
    document.getElementById('imagen_predeterminada').value = imagen;
    
  }
}

function mensaje(){
  alert("cerrado.");
}
var botones = {
  grabar: function(){
      if(confirm('¿Desea grabar el registro?'))
      {
        document.getElementById('form').submit();
      }
          
  },

  eliminar: function(){
      if(confirm('¿Desea eliminar el registro?'))
          document.getElementById('eliminar').submit();
  }
}

function changeDefaultImage(file){
  imagen.changeDefaultImage(file);
}

function eliminarImagen(id, nueva){
  if(nueva){
    imagen.eliminarNueva(id);
  }else{
    imagen.eliminarExistente(id);
  }
}

/*
function preview_images() 
{
 var total_file=document.getElementById("imagenes").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#image_preview').append("<div class='col-md-3'><img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
 }
}

$('#add_more').click(function() {
    "use strict";
    $(this).before($("<div/>", {
      id: 'filediv'
    }).fadeIn('slow').append(
      $("<input/>", {
        name: 'file[]',
        type: 'file',
        id: 'file',
        multiple: 'multiple',
        accept: 'image/*'
      })
    ));
  });

  $('#upload').click(function(e) {
    "use strict";
    e.preventDefault();

    if (window.filesToUpload.length === 0 || typeof window.filesToUpload === "undefined") {
      alert("No files are selected.");
      return false;
    }

    // Now, upload the files below...
    // https://developer.mozilla.org/en-US/docs/Using_files_from_web_applications#Handling_the_upload_process_for_a_file.2C_asynchronously
  });

  deletePreview = function (ele, i) {
    "use strict";
    try {
      $(ele).parent().remove();
      window.filesToUpload.splice(i, 1);
    } catch (e) {
      console.log(e.message);
    }
  }

  $("#file").on('change', function() {
    "use strict";

    // create an empty array for the files to reside.
    window.filesToUpload = [];

    if (this.files.length >= 1) {
      $("[id^=previewImg]").remove();
      $.each(this.files, function(i, img) {
        var reader = new FileReader(),
          newElement = $("<div id='previewImg" + i + "' class='previewBox'><img /></div>"),
          deleteBtn = $("<span class='delete' onClick='deletePreview(this, " + i + ")'>X</span>").prependTo(newElement),
          preview = newElement.find("img");

        reader.onloadend = function() {
          preview.attr("src", reader.result);
          preview.attr("alt", img.name);
        };

        try {
          window.filesToUpload.push(document.getElementById("file").files[i]);
        } catch (e) {
          console.log(e.message);
        }

        if (img) {
          reader.readAsDataURL(img);
        } else {
          preview.src = "";
        }

        newElement.appendTo("#filediv");
      });
    }
  });
  */