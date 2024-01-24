<script>
      window.laravelEchoPort = '{{ env("LARAVEL_ECHO_PORT")}}';
      document.addEventListener('DOMContentLoaded',function(){
        var userId = '{{ Auth::user()->id }}';
        const organizacionId = '{{ Auth::user()->organizacion_id }}';
        const muestraRegistro = document.getElementById('miNotification');
        if(muestraRegistro){
            window.Echo.channel('canal-Notificaciones')
            .listen('.MessageEvent', (data)=>{
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
              });
              Toast.fire({
                icon: "success",
                title: data.title + " "+data.message
              });
            });
             window.Echo.private('notificacion.' +userId)
              .listen('.MessageEvent', (data)=>{
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
              });
              Toast.fire({
                icon: "success",
                title: data.title + " "+data.message
              });
            });
            window.Echo.private('notificacion.organizacion.' +organizacionId)
              .listen('.MessageEvent', (data)=>{
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
              });
              Toast.fire({
                icon: "success",
                title: data.title + " "+data.message
              });
            });
        }else{
          alert('Elemento no encontrado');
        }

      });
      
      
      
      
     
    </script>