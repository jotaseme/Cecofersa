$('#direcciones tbody').on('click', 'a#delete-direccion', function () {
    var id = $(this).data('id');
    $('#confirm-delete-direccion').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#delete-direccion-asociado').unbind("click").click(function(){
        $('#deleted-direccion').attr('hidden');
        $('#deleted-direccion').empty();

        var path = Routing.generate('delete_direccion_asociado', { id_asociado: asociado  , id_direccion: id },true);
        $.ajax({
            url: path,
            data: {id_direccion: id},
            type: 'POST',
            dataType: "json",
            success: function (response) {
                if(response.success==true){
                    $('#status').addClass('hidden');
                    $('#custom').removeAttr('hidden').addClass('alert alert-success').html("").append('¡Direccion eliminada correctamente!');
                }else{
                    $('#deleted-direccion').removeAttr('hidden').addClass('alert alert-danger').append('¡ERROR! La direccion no se ha borrado!');
                }
            }
        });
        $('[data-id='+id+']').parents('tr').remove();
        $('#confirm-delete-direccion').modal('hide');
    });
});
$('#direcciones').DataTable({
    "ordering": false,
    "pageLength":20,
    "lengthChange": false,
    "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        $('.domicilio-direccion-asociado').editable({
            validate: function(value) {
                if (value === null || value === '') {
                    return '¡Este campo no puede estar vacio!';
                }
            },
            success: function(response, newValue) {
                response = $.parseJSON(response);
                if(response.status == 'error'){
                    return response.msg; //msg will be shown in editable form
                }
            }
        });
        $('.codigoPostal-direccion-asociado').editable({
            validate: function(value) {
                if (value === null || value === '') {
                    return '¡Este campo no puede estar vacio!';
                }
            },
            success: function(response, newValue) {
                response = $.parseJSON(response);
                if(response.status == 'error'){
                    return response.msg; //msg will be shown in editable form
                }
            }
        });
        $('.poblacion-direccion-asociado').editable({
            validate: function(value) {
                if (value === null || value === '') {
                    return '¡Este campo no puede estar vacio!';
                }
            },
            success: function(response, newValue) {
                response = $.parseJSON(response);
                if(response.status == 'error'){
                    return response.msg; //msg will be shown in editable form
                }
            }
        });
        $('.provincia-direccion-asociado').editable({

            source:  array_provincias,
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
        $('.comunidadAutonoma-direccion-asociado').editable({

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
        $('.pais-direccion-asociado').editable({
            source: [
                {value: 'ESPAÑA', text: 'España'},
                {value: 'PORTUGAL', text: 'Portugal'}
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
        $('.telefono-direccion-asociado').editable({
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
        $('.fax-direccion-asociado').editable({
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
        $('.oficina-direccion-asociado').editable({
            source: [
                {value: 'VERDADERO', text: 'Activar'},
                {value: 'FALSE', text: 'Desactivar'}
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
        $('.almacen-direccion-asociado').editable({
            source: [
                {value: 'VERDADERO', text: 'Activar'},
                {value: 'FALSE', text: 'Desactivar'}
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
        $('.tienda-direccion-asociado').editable({
            source: [
                {value: 'VERDADERO', text: 'Activar'},
                {value: 'FALSE', text: 'Desactivar'}
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
        $('.privado-direccion-asociado').editable({
            source: [
                {value: 'VERDADERO', text: 'Activar'},
                {value: 'FALSE', text: 'Desactivar'}
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
        $('.etiquetas-direccion-asociado').editable({
            source: [
                {value: 'VERDADERO', text: 'Activar'},
                {value: 'FALSE', text: 'Desactivar'}
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
    }
});
