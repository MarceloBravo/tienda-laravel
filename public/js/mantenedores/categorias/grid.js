onload = function(){
    document.getElementById('filtro').onchange = filtrar;
}

function filtrar(){
    document.getElementById('form-filtro').submit();
}

/*
onload = function(){
    categorias ="";
    fetch('/admin/categorias-listar')
    .then(
        (resp)=>resp.json()
    ).then((data) => {
        categorias = data.map(item => `<tr>
                                        <td>${item.nombre}</td>
                                        <td>${item.descripcion}</td>
                                        <td>
                                            <a href="/admin/${item.id}" class='btn btn-primary btm-sml'>
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>`)
                    document.getElementById('tbody').innerHTML = categorias.join('')
        }            
    ).catch(function(error){
        console.log(error)
        document.getElementById('tbody').innerHTML = error
    });
    
};
*/
