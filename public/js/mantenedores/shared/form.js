onload = function(){
    document.getElementById('btnGrabar').onclick = botones.grabar;
    document.getElementById('btnEliminar').onclick = botones.eliminar;
};

var botones = {
    grabar: function(){
        if(confirm('¿Desea grabar el registro?'))
        {
            document.getElementById('form').submit();
        }
            
    },

    eliminar: function(){
        if(confirm('¿Desea eliminar el registro?'))
            document.getElementById('eliminar').submit();
    }
}
