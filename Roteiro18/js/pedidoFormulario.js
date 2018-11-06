$(document).ready(function() {
    
  $('#dataPedido').mask('00/00/0000');
});

$("#formPedido").validate({
       rules:{
           idUsuario:{
               required:true, 
           },  
           dataPedido:{
               required:true, 
           }              
       }, 
       messages:{
           idUsuario:{
               required:"Campo obrigatório",
           },
           dataPedido:{
               required:"Campos obrigatório",
           }                
       }
});



