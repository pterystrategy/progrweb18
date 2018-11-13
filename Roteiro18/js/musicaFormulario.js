$("#formMusica").validate({
    rules: {
        titulo: {
            required: true
        },
        compositor: {
            required: true
        },
        ano: {
            required: true
        },
        duracao: {
            required: true
        }
    },
    messages: {
        titulo: {
            required: "Campo obrigatório"
        },
        compositor: {
            required: "Campos obrigatório"
        },
        ano: {
            required: "Campos obrigatório"
        },
        duracao: {
            required: "Campos obrigatório"
        }
    }
});


