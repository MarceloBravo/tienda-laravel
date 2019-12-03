onload = function(){
    document.getElementById('btnGrabar').onclick = botones.grabar;
    document.getElementById('btnEliminar').onclick = botones.eliminar;
    document.getElementById('pais').onchange = select.cargarRegiones;
    document.getElementById('region').onchange = select.cargarComunas;
};


var select = {
    cargarRegiones: function(){
        var idPais = document.getElementById('pais').value;
        select.cargarDatos("regiones",idPais,'region');
        document.getElementById('id_comuna').innerHTML = "";
    },

    cargarComunas: function(){
        var idRegion = document.getElementById('region').value;
        select.cargarDatos("comunas",idRegion,'id_comuna');
    },

    cargarDatos: function(tipoDatos, id, idDestino)
    {
        document.getElementById('loading-modal').style.display = "block";

        fetch('/admin/get-'+tipoDatos+'/'+id)
        .then(resp => resp.json())
        .then(function(data){
            var opciones = data.map(s => `<option value="${s.id}">${s.nombre}</option>`);
            document.getElementById(idDestino).innerHTML = `<option value=""> -- Seleccione -- </option>` + opciones.join();
            document.getElementById('loading-modal').style.display = "none";
        })
        .catch(function(error){
            console.log(error);
            alert("Ocurrió un error al solicitar el listado de "+tipoDatos);
            document.getElementById('loading-modal').style.display = "none";
        })
    }
}