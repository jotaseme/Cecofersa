$('.familia-asociado').editable({
    source: [
        {value: 'GR', text: 'Grande'},
        {value: 'MD', text: 'Medio'},
        {value: 'MN', text: 'Mínimo'}
    ],
    validate: function(value) {
        if (value === null || value === '') {
            return '¡Este campo no puede estar vacio!';
        }
    },
    success: function(response, newValue) {
        response = $.parseJSON(response);
        if(response.status == 'error'){
            return response.msg; //msg will be shown in editable form
        }else{
            location.reload();
        }
    }
});