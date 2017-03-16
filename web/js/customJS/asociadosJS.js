$(document).ready(function(){
    $('.nombre-asociado').editable({
        validate: function(value) {
            if (value === null || value === '') {
                return '¡Este campo no puede estar vacio!';
            }
        },
        success: function(response, newValue) {
            response = $.parseJSON(response);
            if(response.status == 'error') return response.msg; //msg will be shown in editable form
        }
    });

    $('.nif-asociado').editable({
        validate: function(value) {
            if (value === null || value === '') {
                return '¡Este campo no puede estar vacio!';
            }
        },
        success: function(response, newValue) {
            response = $.parseJSON(response);
            if(response.status == 'error') return response.msg; //msg will be shown in editable form
        }
    });

    $('.domicilio-asociado').editable({
        validate: function(value) {
            if (value === null || value === '') {
                return '¡Este campo no puede estar vacio!';
            }
        },
        success: function(response, newValue) {
            response = $.parseJSON(response);
            if(response.status == 'error') return response.msg; //msg will be shown in editable form
        }
    });

    $('.codPostal-asociado').editable({
        validate: function(value) {
            if (value === null || value === '') {
                return '¡Este campo no puede estar vacio!';
            }
        },
        success: function(response, newValue) {
            response = $.parseJSON(response);
            if(response.status == 'error') return response.msg; //msg will be shown in editable form
        }
    });

    $('.provincia-asociado').editable({
        source: array_provincias,
        validate: function(value) {
            if (value === null || value === '') {
                return '¡Este campo no puede estar vacio!';
            }
        },
        success: function(response, newValue) {
            response = $.parseJSON(response);
            if(response.status == 'error') return response.msg; //msg will be shown in editable form
        }
});
    $('.comunidad-asociado').editable({
        source:  array_comunidades,
        validate: function(value) {
            if (value === null || value === '') {
                return '¡Este campo no puede estar vacio!';
            }
        },
        success: function(response, newValue) {
            response = $.parseJSON(response);
            if(response.status == 'error') return response.msg; //msg will be shown in editable form
        }
    });

    $('#pais-asociado').editable({
        source: [
            {value: 'ES', text: 'España'},
            {value: 'PT', text: 'Portugal'}
        ],
        validate: function(value) {
            if (value === null || value === '') {
                return '¡Este campo no puede estar vacio!';
            }
        },
        success: function(response, newValue) {
            response = $.parseJSON(response);
            if(response.status == 'error') return response.msg; //msg will be shown in editable form
        }
    });

    $('#contacto-asociado').editable({
        validate: function(value) {
            if (value === null || value === '') {
                return '¡Este campo no puede estar vacio!';
            }
        },
        success: function(response, newValue) {
            response = $.parseJSON(response);
            if(response.status == 'error') return response.msg; //msg will be shown in editable form
        }
    });

    $('#telefono-asociado').editable({
        validate: function(value) {
            if (value === null || value === '') {
                return '¡Este campo no puede estar vacio!';
            }
        },
        success: function(response, newValue) {
            response = $.parseJSON(response);
            if(response.status == 'error') return response.msg; //msg will be shown in editable form
        }
    });

    $('#fax-asociado').editable({
        validate: function(value) {
            if (value === null || value === '') {
                return '¡Este campo no puede estar vacio!';
            }
        },
        success: function(response, newValue) {
            response = $.parseJSON(response);
            if(response.status == 'error') return response.msg; //msg will be shown in editable form
        }
    });

    $('#email-asociado').editable({
        validate: function(value) {
            if (value === null || value === '') {
                return '¡Este campo no puede estar vacio!';
            }
        },
        success: function(response, newValue) {
            response = $.parseJSON(response);
            if(response.status == 'error') return response.msg; //msg will be shown in editable form
        }
    });

    $('#estado-asociado').editable({
        source: [
            {value: '0', text: 'Baja'},
            {value: '1', text: 'Activo'}
        ],
        validate: function(value) {
            if (value === null || value === '') {
                return '¡Este campo no puede estar vacio!';
            }
        },
        success: function(response, newValue) {
            response = $.parseJSON(response);
            if(response.status == 'error') return response.msg; //msg will be shown in editable form
        }
    });

});