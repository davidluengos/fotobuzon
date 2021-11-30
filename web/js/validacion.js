function validarUsuarioNuevo(){

    //Si hay errores, los mostramos por pantalla
    var hayErrores = false;
    document.getElementById("panel-errores").innerHTML="";


    //Validación del nombre, que no esté vacío
    valor = document.getElementById("nombre").value;
    if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>El campo 'Nombre' no puede estar vacío.</div>";
        hayErrores = true;
    }


    //Validación de apellidos (que haya al menos un espacio)
    var apellidosjs = document.getElementById("apellidos").value;
    var subcadena = " ";
    var i = apellidosjs.indexOf(subcadena);

    if ( i != -1 ) {
        hayErrores = false;
    }else{
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>Debe incluir los dos apellidos.</div>";
        hayErrores = true;
    }


    //Validación de formato de email
    var mailjs = document.getElementById("email").value;
    var expresionCorreo = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

    if ( !expresionCorreo.test(mailjs) ) {
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>Debe incluir un correo electrónico válido.</div>";
        hayErrores = true;
    }
    

    //Validación de contraseñas.
    var p1 = document.getElementById("password").value;
    var p2 = document.getElementById("password2").value;

    if (p1.length == 0 || p2.length == 0) {
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>El campo contraseña no puede estar vacío.</div>";
        hayErrores = true;
    }

    if (p1 != p2) {
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>Las contraseñas deben coincidir.</div>";
        hayErrores = true;
    }

    var espacios = false;
    var cont = 0;

    while (!espacios && (cont < p1.length)) {
    if (p1.charAt(cont) == " ")
        espacios = true;
    cont++;
    }
   
    if (espacios) {
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>La contraseña no puede contener espacios en blanco.</div>";
        hayErrores = true;
    }


    //Validación de teléfono. El teléfono debe ser de 9 cifras, sin espacios, empezando por 6, 7 o 9.
    var telefonojs = document.getElementById("telefono").value;
    var expresionTelefono = /^[679]{1}[0-9]{8}$/;

    if ( !expresionTelefono.test(telefonojs) ) {
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>Formato de Teléfono no Válido. Debe ser de 9 cifras, sin espacios, empezando por 6, 7 o 9.</div>";
        hayErrores = true;
    }


    //Validación de la dirección, que no esté vacía
    valor = document.getElementById("direccion").value;
    if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>El campo 'Dirección' no puede estar vacío.</div>";
        hayErrores = true;
    }


    //Validación de código postal. Debe tener 5 cifras.
    var cp = document.getElementById("cpostal").value;
    var expresionCP = /^[0-9]{5}$/;

    if ( !expresionCP.test(cp) ) {
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>El código postal debe de ser de cinco dígitos.</div>";
        hayErrores = true;
    }

    
    //Validación del municipio, que no esté vacío
    valor = document.getElementById("municipio").value;
    if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>El campo 'Municipio' no puede estar vacío.</div>";
        hayErrores = true;
    }


    //Validación de la provincia, que no esté vacía
    valor = document.getElementById("provincia").value;
    if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>El campo 'Provincia' no puede estar vacío.</div>";
        hayErrores = true;
    }

    var isChecked = document.getElementById('aceptarTerminos').checked;
    if(!isChecked){
        document.getElementById("panel-errores").innerHTML=
        document.getElementById("panel-errores").innerHTML + "<div class='alert alert-danger'>Debe aceptar los términos y condiciones.</div>";
        hayErrores = true;
    }

    if (hayErrores) {
        return false;
    }
    return true;
}
