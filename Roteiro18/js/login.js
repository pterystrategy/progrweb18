
$("#formLogin").validate({
       rules:{
           login:{
               required:true
           }, 
           senha:{
               required:true
           }	   
       }, 
       messages:{
           login:{
               required:"Campos obrigatório"
           },
           senha:{
               required:"Campos obrigatório"
           }	   
       }
});


