function validar(){
    
    var hayErrores = false;
    document.getElementById("panel-errores").innerHTML="";
    
    
    var marca = document.getElementById("marca").value;
    
    if (marca.length < 5 || marca.length > 30) {
        //alert("El campo marca tiene que tener entre 5 y 30 caracteres");
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>El campo marca tiene que tener entre 5 y 30 caracteres</div>";
        //document.getElementById("marca").focus();
		document.getElementById("marca").className="error form-control";
        hayErrores = true; 
    }
    
    var matriculajs = document.getElementById("matricula").value;
    var expresionMatricula = /^[0-9]{4}[A-Z]{3}$/;

    if ( !expresionMatricula.test(matriculajs) ) {
        //alert("Formato de matrícula no válido");
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>Formato de Matrícula no Válido</div>";
        document.getElementById("matricula").className="error form-control";
        hayErrores = true;
    }
    
    var valorVehiculo = document.getElementById("tipo").value;

    if (valorVehiculo === "") {
        //alert("Debe de elegir un tipo de vehículo");
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>Debe de elegir un tipo de vehículo</div>";
        document.getElementById("tipo").className="error form-control";
        hayErrores = true;
    }
    
    //si cumple el patrón de las fechas, me haces esto
    
    var fechamatjs = document.getElementById("fechamat").value; //cogemos el valor de la fecha de matriculación insertada
    var expresionFecha = /^([012][1-9]|3[01])\/(0[1-9]|1[012])\/(\d{4})$/; //patrón de la validación
    if (expresionFecha.test(fechamatjs)){ //si la fecha cumple el patrón...
            var now = new Date(); //creamos una variable con la fecha actual
            //alert(now);
            now.setHours(0,0,0,0); //para que nos quitar horas, minutos, segundos... y nos quede en yyyy/mm/dd
            var auxfecha = fechamatjs.split("/"); //creamos otra variable co un array de los datos insertados separados por barras
            var selectedDate = new Date(auxfecha[2] + "-" + auxfecha[1] + "-" + auxfecha[0]); //creamos una nueva fecha con los datos del array anterior
            //alert(selectedDate); //comprobamos el dato obtenido
            
            if (selectedDate >= now) { 
                //alert("La fecha no puede ser posterior a la de hoy");
                document.getElementById("panel-errores").innerHTML=
                document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>La fecha no puede ser posterior a la de hoy</div>";
                document.getElementById("fechamat").className="error form-control";
                hayErrores = true;
            }

    }
    
    // else >> formato no válido
    else{
        //alert("El formato de fecha no es válido");
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>El formato de fecha no es válido</div>";
        document.getElementById("fechamat").className="error form-control";
        hayErrores = true;

    }


    var bastidorjs = document.getElementById("bastidor").value;
    var expresionVin = /^[0-9]{1}(?![WZ])[A-Z]{1}ES[A-D]{4,6}\d{5}$/;

    if ( !expresionVin.test(bastidorjs) ) {
        //alert("Formato de bastidor no válido");
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>Formato de Bastidor no Válido</div>";
        document.getElementById("bastidor").className="error form-control";
        hayErrores = true;
    }
    
    var telefonojs = document.getElementById("telefono").value;
    var expresionTelefono = /^[69]{1}[0-9]{8}$/;

    if ( !expresionTelefono.test(telefonojs) ) {
        //alert("Formato de teléfono no válido");
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>Formato de Teléfono no Válido</div>";
        document.getElementById("telefono").className="error form-control";
        hayErrores = true;
    }

    var mailjs = document.getElementById("mail").value;
    var expresionCorreo = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

    if ( !expresionCorreo.test(mailjs) ) {
        //alert("Formato de Mail no válido");
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>Formato de Correo Electrónico no Válido</div>";
        document.getElementById("mail").className="error form-control";
        hayErrores = true;
    }
//he intentado un selector de color. Funciona pero es poco amigable, por esto lo he quitado.
    /*var selectColor = document.getElementById("color").value;
    alert(selectColor);

    if (selectColor === "#fb6f6f") {
        alert("Debe de elegir un color del vehículo");
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>Debe de elegir un color del vehículo</div>";
        document.getElementById("color").className="error ";
        hayErrores = true;
    }
*/
    var tipoCombustible = document.formulario.combustible.value;
    //alert(tipoCombustible);

    if (tipoCombustible === "") {
        //alert("Debe de elegir un tipo de combustible del vehículo");
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>Debe de elegir un tipo de combustible del vehículo</div>";
        document.getElementById("combustible-control").className="error form-control";
        hayErrores = true;
    }

    var aceptarRegistro = document.getElementById("aceptar").checked;
    //alert(aceptarRegistro);

    if ( aceptarRegistro==false) {
        console.log("¿llegamos a este punto?");
        //alert("Debe de aceptar los términos y condiciones del servicio");
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>Debe de aceptar los términos y condiciones del servicio</div>";
        document.getElementById("checkaceptar").className="error";
        hayErrores = true;
    }


    


    if (hayErrores) {
        return false;
    }

    return true;
}