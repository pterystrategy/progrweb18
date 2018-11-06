$(document).ready(function(){
	
	$('#valor').mask('#0.##0,00', {reverse: true});		

});

$("#formProduto").validate({
       rules:{
           nome:{
               required:true,
			   minlength: 3		   
           }, 		   
           descricao:{
               required:true,
			   minlength: 10	
           }, 
           valor:{
               required:true	   
           }, 
           quantidade:{
               required:true
           }, 
           idCategoria:{
               required:true
           }, 
           foto:{
               required:true
           } 		   
       }, 
       messages:{
           nome:{
               required:"Campo obrigatório",
			   minlength:"Por favor, insira pelo menos {0} caracteres"
           },
           descricao:{
               required:"Campos obrigatório",
			   minlength:"Por favor, insira pelo menos {0} caracteres"
           },
           valor:{
               required:"Campos obrigatório"
           },
           quantidade:{
               required:"Campo obrigatório"
           },
           idCategoria:{
               required:"Campo obrigatório"
           },
           foto:{
               required:"Campo obrigatório"
           }		   
       }
});


