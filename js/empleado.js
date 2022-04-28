const $empleado = document.getElementById('empleado');
    $(document).ready(function(){
        $.ajax({
            url: 'funciones/empleado.php',
            success:function(r){
                $empleado.innerHTML = r; 
            }
        })
    }) 