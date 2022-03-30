const $btnServicio = document.getElementById('btnServicio');
const $formulario = document.getElementById('Formulario1');

//informacion extraida automaticamente para las fechas
let fechaS = new Date(),
    d = fechaS.getDate(),
    m = fechaS.getMonth() + 1,
    y = fechaS.getFullYear(),
    mes= ('0' + m).slice(-2);

    let dia = d.toString();
    let mesActual = mes.toString();
    let anio = y.toString();
    let fecha = `${anio}-${mesActual}-${dia}`;
    let fechaActual = fecha.toString();
    

$btnServicio.addEventListener("click", (e) =>{
    
    //Petición para enviar datos del formulario a nuestra base de datos
    let datos = {
        'servicio' :  $formulario.servicio.value,
        'total' : $formulario.total1.value,
        'fechaActual' : fechaActual,
        'dia' : dia,
        'mes' : mes,
        'anio' : anio
    };
        $.ajax({
           url:"./funciones/registrarServicio.php",
           method:"POST",
           data:datos,
           success:function(r){
               if(r=='vacio'){
                   Swal.fire({
                       position: 'center',
                       icon: 'warning',
                       title: 'Es necesario llenar todos los campos',
                       showConfirmButton: false,
                       timer: 2000
                     }) 
                     
               }else{
                   Swal.fire({
                       position: 'center',
                       icon: 'success',
                       title: 'El Servicio fue registrado exitosamente.',
                       showConfirmButton: false,
                       timer: 2000
                     })
                     setTimeout(() => {
                        $formulario.reset();
                     }, 2000);
               }
           }
       }) 
    
        
});