$(document).ready(function() {

    //$( ".campo" ).prop( "disabled", true );

} );


$("#formGrupo").validate({
       rules:{
           descricao:{
               required:true, 
           }   
       }, 
       messages:{
           descricao:{
               required:"Campos obrigatório",
           }	   
       }
});



