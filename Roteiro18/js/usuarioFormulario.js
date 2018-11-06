
$("#formUsuario").validate({
       rules:{
           nome:{
               required:true
           },         
           login:{
               required:true,
			   minlength: 3,
			   remote: {
				  url: "UsuarioControlador.php?operacao=verificarLogin&idUsuario="+$( "#idUsuario" ).val(),
				  type: "post",
				  data: {
				     login: function() {
					     return $( "#login" ).val();
				     }
				  }
			   }			   
           }, 		   
           senha:{
               required:true
           }, 
           email:{
               required:true,
			   email: true			   
           }, 
           situacao:{
               required:true
           }, 
           grupoAcesso:{
               required:true
           } 		   
       }, 
       messages:{
           senha:{
               required:"Campo obrigatório"
           },
           login:{
               required:"Campo obrigatório",
			   minlength:"Por favor, insira pelo menos {0} caracteres",
			   remote:"Já existe um usuário com esse login"
           },
           senha:{
               required:"Campo obrigatório"
           },
           email:{
               required:"Campo obrigatório",
			   email:"E-mail inválido"
           },
           situacao:{
               required:"Campo obrigatório"
           },
           grupoAcesso:{
               required:"Campo obrigatório"
           }		   
       }
});


