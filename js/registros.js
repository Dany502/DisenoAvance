const $btnServicio = document.getElementById('btnServicio'),
    $formulario = document.getElementById('Formulario1'),
    $formularioGastos = document.getElementById('Formulario2'),
    $btnGasto = document.getElementById('btnGasto');

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

$btnGasto.addEventListener("click",(e) =>{
    let datosGastos = {
        'gasto' : $formularioGastos.gasto.value,
        'total' : $formularioGastos.total2.value,
        'fechaActual' : fechaActual,
        'dia' : dia,
        'mes' : mes,
        'anio' : anio
    };
    $.ajax({
        url:"./funciones/registrarGastos.php",
        method:"POST",
        data:datosGastos,
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
                    title: 'El Gasto fue registrado exitosamente.',
                    showConfirmButton: false,
                    timer: 2000
                  })
                  setTimeout(() => {
                     $formularioGastos.reset();
                  }, 2000);
            }
        }
    }) 
 
    
})