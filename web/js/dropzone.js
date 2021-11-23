<script type="text/javascript">
    var myDropzone; // Subir objeto de archivo
         var signFileName = []; // La última vez, el nombre del archivo
    var fileUrl = [];
    $(function(){
                 // Prohibir la búsqueda automática de todos los elementos:
        Dropzone.autoDiscover = false;
                 // Control de carga de carga
        $("#my-dropzone").dropzone({
            url: "${webAppPath}/upload_file_json",
            method : "post",
                         paramName: "myFiles", // el valor predeterminado es el archivo
                         paralelos Uploads: 20, // Cantidad máxima de procesamiento paralelo
                         maxFiles: 20, // El límite superior del número de archivos cargados a la vez
                         uploadMultiple: verdadero, // Carga de varios archivos
                         autoProcessQueue: false, // Auto upload predeterminado a true
            maxFilesize : 1, // MB
                         addRemoveLinks: true, // Agregar botón de eliminación
                         acceptFiles: ".jpg, .png, .jpeg.JPG, .PNG, .JPEG", // tipo de carga
                         dictMaxFilesExceeded: "¡Solo puede cargar hasta {{maxFiles}} archivos!",
                         dictResponseError: '¡Error al cargar el archivo!',
                         dictInvalidFileType: "No puede cargar este tipo de archivo, el tipo de archivo solo puede ser * .jpg, *. png, *. jpeg, *. JPG, *. PNG, *. JPEG",
                         dictFallbackMessage: "El navegador no es compatible",
                         dictFileTooBig: "El archivo es demasiado grande ({{}} MB). El tamaño máximo de archivo de carga admitido: {{maxFilesize}} MB.",
                         dictRemoveFile: "Eliminar",
            dictDefaultMessage:"",
            init : function() {
                myDropzone = this;
                this.on("addedfile", function(file) {
                                         // Evento desencadenado al cargar un archivo
                                         //console.log("Add file "+ file.name);
                    var fileName = file.name;
                    if(signFileName != null && signFileName.length > 0){
                        signFileName.push(fileName);
                    }else{
                                                 // El archivo subido existe, elimínelo
                        if(signFileName.join(",").indexOf(fileName) != -1){
                            this.removeFile(file);
                        }else{
                            signFileName.push(fileName);
                        }
                    }
                });
                this.on("queuecomplete", function(file) {
                                         // El método que se activará después de que se complete la carga
                    updateItemImg(signFileName,fileUrl);
                });
                this.on("removedfile", function(file) {
                                         // El método que se activa cuando se elimina el archivo
                    var fileName = file.name;
                    signFileName = $.grep(signFileName, function(value) {
                        return value != fileName;
                    });
                });
                this.on("error", function(file,msg,xhr){
                    console.log("file upload error!!");
 
                });
                this.on("maxfilesexceeded", function(file){
                                         // Ocurre cuando el número de archivos excede el límite
                                         // Eliminar archivos que exceden el límite
                                         layer.alert ("El número de imágenes cargadas no puede exceder las 20 a la vez");
                    this.removeFile(file);
                });
                this.on("success", function(file, result){
                    fileUrl = result.url;
                });
            }
        });
 
    })
    var index = "";
    function uploadAllFile() {
        if(signFileName.length > 0){
                         index = layer.load (0, {sombra: falso}); // 0 representa el estilo de carga, admite 0-2
                         myDropzone.processQueue (); // Enviar archivos en la cola
        }else{
                         layer.alert ("Seleccione primero una imagen");
        }
    }
 
    function updateItemImg(signFileName,fileUrl){
        var itemCodes = "";
        var urls = "";
        for(var i in signFileName){
            itemCodes += signFileName[i].split('\.')[0]+",";
        }
        for(var k in fileUrl){
            urls += fileUrl[k]+",";
        }
        $.ajax({
            url: "${webAppPath}/posItem/updateItemImgUrl",
            method: 'POST',
            dataType: 'json',
            data: {
                "itemCodes":itemCodes,
                "urls":urls
            },
            success: function (data) {
                layer.close(index);
                if(data.flag){
                    layer.alert(data.msg, {
                                                 skin: 'layui-layer-molv' // Nombre de la clase de estilo
                        ,closeBtn: 0
                    }, function(){
                        window.location.href='${webAppPath}'+'/posKeydesc/newList';
                    });
                }else{
                    layer.alert(data.msg)
                }
            }
        })
    }
</script>