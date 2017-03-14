$(document).ready(function(){
    $('#usuarios tbody').on('click', 'a#delete', function () {
        var id = $(this).data('id');
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
        $('#delete-usuario').unbind("click").click(function(){
            $('#deleted-usuario').attr('hidden');
            $('#deleted-usuario').empty();
            var path = Routing.generate('delete_usuario_asociado', { id_asociado: asociado  , id_usuario: id },true);
            $.ajax({
                url: path,
                data: {id_usuario: id},
                type: 'POST',
                dataType: "json",
                success: function (response) {
                    if(response.success==true){
                        $('#deleted-usuario').removeAttr('hidden').addClass('alert alert-success').append('ï¿½Consumo eliminado correctamente!');
                    }else{
                        $('#deleted-usuario').removeAttr('hidden').addClass('alert alert-danger').append('ï¿½ERROR! Ha ocurrido un error eliminando el consumo.');
                    }
                }
            });
            $('[data-id='+id+']').parents('tr').remove();
            $('#confirm-delete').modal('hide');
        });
    });
    $('#usuarios').DataTable({
        "ordering": false,
        "pageLength":20,
        "lengthChange": false,
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            $('.email').editable({
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
            $('.login').editable({
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
            $('#estadoBloqueo').editable({
                source: [
                    {value: 'Normal', text: 'Normal'},
                    {value: 'Bloqueado', text: 'Bloqueado'},
                    {value: 'Permitido', text: 'Permitido'}
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
            $('#areaPrivada').editable({
                source: [
                    {value: '1', text: 'Activo'},
                    {value: '0', text: 'Bloqueado'}
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
            $('#expoVirtual').editable({
                source: [
                    {value: '1', text: 'Activo'},
                    {value: '0', text: 'Bloqueado'}
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
            $('#expoFisica').editable({
                source: [
                    {value: '1', text: 'Activo'},
                    {value: '0', text: 'Bloqueado'}
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
});