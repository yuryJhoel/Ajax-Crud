$(document).ready(function (){
    let editar = false;
    $('#resultado-tarea').hide();
    fetchTareas();
    $('#search').keyup(function(e){
        if($('#search').val()){
            let search = $('#search').val();
            $.ajax({
                url:'buscar-tarea.php',
                type: 'POST',
                data:{search:search},
                success: function(response){
                    let tarea = JSON.parse(response);
                    let template = '';

                    tarea.forEach(elemento => {
                        template+=`<li>
                            ${elemento.nombre}
                        </li>`
                    });
                    $('#container').html(template);
                    $('#resultado-tarea').show();

                }
            });
        }
    })
    $('#tarea-form').submit(function(e){
        e.preventDefault();
        const postData = {
            nombre:$('#nombre').val(),
            descripcion:$('#descripcion').val(),
            id:$('#tareaID').val()
        };

        let url = editar===false ? 'agregar-tarea.php' : 'editar-tarea.php';
        console.log(url);
        $.post(url,postData, function(response){
            console.log(response); 
            fetchTareas();
            $('#tarea-form').trigger('reset');
        })
        
    });
    function fetchTareas(){
        $.ajax({
            url:'listar-tareas.php',
            anchortype:'GET',
            success:function (response){
                let tareas = JSON.parse(response);
                let template = '';
                tareas.forEach((tarea)=>{
                    template +=`
                    <tr tareaID = "${tarea.id}">
                        <td>${tarea.id}</td>
                        <td><a href="#" class="itemTarea">${tarea.nombre}</a></td>
                        <td>${tarea.descripcion}</td>
                        <td>
                            <button id="tarea-eliminar" class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>                
                    `
                });
                $('#tareas').html(template);
            }
        })
    }

    $(document).on('click','#tarea-eliminar', function(){
        if(confirm('Are you sure you want to delete it?')){
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('tareaID');
            $.post('eliminarTarea.php', {id:id}, function(response){
                fetchTareas();
            })
        }
    });

    $(document).on('click', '.itemTarea',function(){
        let element = $(this)['0'].parentElement.parentElement;
        let id = $(element).attr('tareaID');
        $.post('tareaSingular.php', {id:id}, function(response){
            const tarea = JSON.parse(response);
            $('#nombre').val(tarea.nombre);
            $('#descripcion').val(tarea.descripcion);
            $('#tareaID').val(tarea.id);
            editar = true;
        })
    })

})