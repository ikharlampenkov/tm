/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 09.12.11
 * Time: 21:00
 * To change this template use File | Settings | File Templates.
 */


var task = {
    addDialog:function (rq_url, parent, show_url) { // Функция вывода диалогового окна
        if ($('#addDialog').length < 1) // создаем блок диалогового окна
        {
            $('body').append('<div id="addDialog" ></div>');
        } else {
            $('#addDialog').dialog('close'); // на всякий случай закрываем
        }

        $.get(rq_url, '', function (data) { // посылаем пост запрос для вывода формы
            $('#addDialog').html(data).dialog({
                title:'Добавить задачу',
                modal:true,
                height:320,
                width:830,
                buttons:{
                    Добавить:function () {
                        task.send(rq_url, parent, show_url);
                    },
                    Отмена:function () {
                        $('#addDialog').dialog('close');
                    }
                }
            });
            $( ".datepicker" ).datepicker($.datepicker.regional[ "ru" ]);
            $('#exception').css('display', 'none');
        }, 'html');
    },

    send:function (rq_url, parent, show_url) {
        var data_form = {}; // данные которые будем отправлять
        $('#addDialog').find('input,textarea,select').each(function () { // ищем в цикле все поля формы в диалоговом окне
            data_form[$(this).attr('name')] = $(this).val(); // записываем
        });

        $.ajax({
            type:'POST',
            url:rq_url,
            data:data_form,
            success:function (data) {
                if (data != '') {
                    $('#addDialog').html(data);
                    //$('#exception_message').append(data);
                    //$('#exception').css('display', 'block');
                }
                else {
                    task.openTask(show_url, parent, true);
                    $('#addDialog').dialog('close');
                }
            }
        }, 'html');
    },

    openTask:function (rg_url, parent, isReload) {
        isReload = isReload || false;

        if ($('#subtask_' + parent).html() != '' && !isReload) {
            $('#subtask_' + parent).hide();
            $('#subtask_' + parent).empty();
            return;
        }

        $.get(rg_url, '', function (data) {
            $('#subtask_' + parent).empty();
            $('#subtask_' + parent).append(data);
            task.createSubMenu();
            $('#subtask_' + parent).show();
        }, 'html');
    },

    editDialog:function (rq_url, parent, show_url) {
        if ($('#editDialog').length < 1) // создаем блок диалогового окна
        {
            $('body').append('<div id="editDialog" ></div>');
        } else {
            $('#addDialog').dialog('close'); // на всякий случай закрываем
        }

        $.get(rq_url, '', function (data) { // посылаем пост запрос для вывода формы
            $('#editDialog').html(data).dialog({
                title:'Редактировать задачу',
                modal:true,
                height:550,
                width:830,
                buttons:{
                    Сохранить:function () {
                        $('#editForm').ajaxSubmit({
                            success:function (responseText, statusText, xhr, $form) {
                                if (responseText != '') {
                                    $('#editDialog').html(responseText);
                                }
                                else {
                                    task.openTask(show_url, parent, true);
                                    $('#editDialog').dialog('close');
                                }
                            }
                        });

                        //task.sendEdit(rq_url, parent, show_url);
                    },
                    Отмена:function () {
                        $('#editDialog').dialog('close');
                    }
                }
            });
            $( ".datepicker" ).datepicker($.datepicker.regional[ "ru" ]);
            $('#exception').css('display', 'none');
        }, 'html');
    },

    sendEdit:function (rq_url, parent, show_url) {
        var data_form = {}; // данные которые будем отправлять
        $('#editDialog').find('input,textarea,select').each(function () { // ищем в цикле все поля формы в диалоговом окне
            data_form[$(this).attr('name')] = $(this).val(); // записываем
        });

        $.ajax({
            type:'POST',
            url:rq_url,
            data:data_form,
            success:function (data) {
                if (data != '') {
                    $('#editDialog').html(data);
                }
                else {
                    task.openTask(show_url, parent, true);
                    $('#editDialog').dialog('close');
                }
            }
        }, 'html');
    },

    deleteDialog:function (task_title, rg_url, parent, show_url) {
        if ($('#deleteDialog').length < 1) // создаем блок диалогового окна
        {
            $('body').append('<div id="deleteDialog" ></div>');
        } else {
            $('#deleteDialog').dialog('close'); // на всякий случай закрываем
        }

        var html = '<div>Вы действительно хотите удалить задачу:<br/><b>' + task_title + '?</b></div>';

        $('#deleteDialog').html(html).dialog({
            title:'Удалить задачу',
            modal:true,
            height:220,
            width:500,
            buttons:{
                Удалить:function () {
                    $.get(rg_url, function (data) {
                        if (data == '') {
                            task.openTask(show_url, parent, true);
                            $('#deleteDialog').dialog('close');
                        } else {
                            $('#deleteDialog').append(data);
                        }
                    });
                },
                Отмена:function () {
                    $('#deleteDialog').dialog('close');
                }
            }
        });
    },

    createSubMenu:function () {
        $(".task_list button").button({
            icons:{
                secondary:"ui-icon-triangle-1-s"
            }
        }).next().popup();
    }
}

var doc = {
    showInfo:function (rq_url, id) {
        if ($('#fileInfo').length < 1) {
            $('body').append('<div id="fileInfo" class="file_info"></div>');
        } else {
            $('#fileInfo').empty();
        }

        $.get(rq_url, '', function (data) { // посылаем пост запрос для вывода формы
            /*
             $('#doc_info_' + id).tooltip({
             content: data
             });
             */
            $('#fileInfo').html(data).popup({
                position:{
                    of:'#doc_info_' + id
                }
            }).popup('open');
        }, 'html');
    }
}
