const $formulario=document.getElementById('formulario'),
    $alerta=document.getElementById('error');

    $formulario.addEventListener("submit",(e)=>{
        e.preventDefault()
        let http = new XMLHttpRequest();
        let url = 'funciones/validar.php';
        let data = new FormData($formulario);
        http.open('POST',url,true);
        http.onreadystatechange = function(){
            //readystate valor numerico entero que almacena el estado de la peticion
            //4 completo(se han recibido todos los datos de la respuesta del servidor)

            //status para comprobar la conectividad con el servidor
            //200 respuesta correcta
            //404 no encontrado (respuesta incorrecta)
            //500 error en el servidor
            if(http.readyState == 4 && http.status == 200){
                let resp = JSON.parse(http.responseText);
                if(resp.response == 'true'){
                    window.location.href = "index.php";
                }else{
                    $alerta.classList.add('active');
                    setTimeout(() => {
                        $alerta.classList.remove('active');
                    }, 2000);
                }
            }
        }
        http.send(data);
    });