$(function(){

    $('.input-cant').change(function(){
        var cant = $(this).val();
        var slug = $(this).data('slug');
        
        window.location = "/carrito/"+slug+"/"+cant;
    });
});