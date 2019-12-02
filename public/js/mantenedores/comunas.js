onload = function(){
    document.getElementById('pais').onchange = select.cargarRegiones;
    document.getElementById('btnGrabar').onclick = botones.grabar;
    document.getElementById('btnEliminar').onclick = botones.eliminar;
}

var select = {
    cargarRegiones: function(){
        var idPais = document.getElementById('pais').value;

        document.getElementById('loading-modal').style.display = "block";

        fetch('http://localhost:8000/admin/get-regiones/'+idPais)
        .then(resp => resp.json())
        .then(function(data){
            var options = data.map(e => `<option value="${e.id}">${e.nombre}</option>`);
            document.getElementById('region').innerHTML = '<option value=""> -- Selecciona una región -- </option>' + options.join();
            document.getElementById('loading-modal').style.display = "none";
        }).catch(function(error){
            console.log(error);
            document.getElementById('loading-modal').style.display = "none";
            alert("Error al cargar las regiones.");            
        });
    }
}
