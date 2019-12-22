function mostrarFoto(file, imagen) {

    var extensions = ['JPG','JPEG'];
    var ex = file.name.split(".");
    if(extensions.includes(ex[1].toUpperCase())){

        //carga la imagen de file en el elemento src imagen
        var reader = new FileReader();
        reader.addEventListener("load", function () {
            
            
            
            var image = new Image();
            image.src = reader.result;
      
        //Validate the File Height and Width.
        image.onload = function () {
          var height = this.height;
          var width = this.width;
          if (height > 1500 || width > 1500) {
            alert("Maximo 1500x1500 px.");
            document.getElementById("foto").value = "";
            return false;
          }
          imagen.src = reader.result;
          return true;
        }; 
            
        });

        reader.readAsDataURL(file);
    }else { window.alert("Tiene que ser un archivo JPG o JPEG salu2 "); 
        document.querySelector("#foto").value="";
    }
        
}

function ready() {
    var fichero = document.querySelector("#foto");
    var imagen  = document.querySelector("#img_foto");
//escuchamos evento selección nuevo fichero.
    fichero.addEventListener("change", function (event) {
        mostrarFoto(this.files[0], imagen);
    });
}

ready();