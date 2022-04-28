const $ingreso=document.getElementById('ingreso-t'),
    $egreso=document.getElementById('egreso-t'),
    $ganancia=document.getElementById('ganancia-t');

    $ingreso.innerHTML = "Q0";
    $egreso.innerHTML = "Q0";
    $ganancia.innerHTML = "Q0";

    $(document).ready(function(){
        setInterval(() => {
            $.ajax({
                url: 'funciones/totalIngreso.php',
                success:function(r){
                    $ingreso.innerHTML = r; 
                }
            })
        }, 1000);
        setInterval(() => {
            $.ajax({
                url: 'funciones/totalEgreso.php',
                success:function(r){
                    $egreso.innerHTML = r; 
                }
            })
        }, 1000);
        setInterval(() => {      
            $.ajax({
                url: 'funciones/totalGanancia.php',
                success:function(r){
                    $ganancia.innerHTML = r; 
                }
            })
        }, 1000);
    });
