
onload = function(){
    document.getElementById('id_pais').onchange = select.cargarRegiones;
    document.getElementById('id_region').onchange = select.cargarComunas;
    document.getElementById('id_comuna').onchange = select.cargarCiudades;

    document.getElementById('btnGrabar').onclick = botones.grabar;
    document.getElementById('btnEliminar').onclick = botones.eliminar;
}

var select = {
    cargarRegiones: function(){
        select.cargarDatos('regiones','id_region',this.value);
        document.getElementById('id_comuna').innerHTML = "";
        document.getElementById('id_ciudad').innerHTML = "";

        document.getElementById('btnGrabar').onclick = botones.grabar;
        document.getElementById('btnEliminar').onclick = botones.eliminar;
    },

    cargarComunas: function(){
        select.cargarDatos('comunas','id_comuna', this.value);
        document.getElementById('id_ciudad').innerHTML = "";
    },

    cargarCiudades: function(){
        select.cargarDatos('ciudades','id_ciudad', this.value);
    },

    cargarDatos: function(tipoDato, selectDestino, parent){      
        if(parent == "")parent  = '-1';
        document.getElementById('loading-modal').style.display = "block";
        fetch('http://localhost:8000/admin/get-'+tipoDato+'/'+parent)
        .then(resp => resp.json())
        .then(function(data){            
            opciones = data.map(item => `<option value='${item.id}'>${item.nombre}</option>`);
            document.getElementById(selectDestino).innerHTML = `<option value=''> -- Seleccione -- </option>` + opciones.join();
            document.getElementById('loading-modal').style.display = "none";
        })
        .catch(function(error){
            console.log(error);            
            document.getElementById('loading-modal').style.display = "none";
            alert("Ocurrio un error al cargar las "+tipoDato);
        })
    }
}