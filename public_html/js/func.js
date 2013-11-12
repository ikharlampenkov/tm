/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 09.12.11
 * Time: 21:00
 * To change this template use File | Settings | File Templates.
 */


var task = {
    addDialog: function (rq_url, parent, show_url, prefics) { // Функция вывода диалогового окна
        prefics = prefics || '';
        if ($('#addDialog').length < 1) // создаем блок диалогового окна
        {
            $('body').append('<div id="addDialog" ></div>');
        } else {
            $('#addDialog').dialog('close'); // на всякий случай закрываем
        }

        $.get(rq_url, '', function (data) { // посылаем пост запрос для вывода формы
            $('#addDialog').html(data).dialog({
                title: 'Добавить задачу',
                modal: true,
                height: 550,
                width: 830,
                buttons: {
                    Добавить: function () {
                        $('#addForm').ajaxSubmit({
                            success: function (responseText, statusText, xhr, $form) {
                                if (responseText != '') {
                                    $('#addDialog').html(responseText);
                                }
                                else {
                                    task.openTask(show_url, parent, true, prefics);
                                    $('#addDialog').dialog('close');
                                }
                            }
                        });
                        //task.send(rq_url, parent, show_url);
                    },
                    Отмена: function () {
                        $('#addDialog').dialog('close');
                    }
                }
            });
            $(".datepicker").datetimepicker();
            $('#exception').css('display', 'none');
        }, 'html');
    },

    send: function (rq_url, parent, show_url) {
        var data_form = {}; // данные которые будем отправлять
        $('#addDialog').find('input,textarea,select').each(function () { // ищем в цикле все поля формы в диалоговом окне
            data_form[$(this).attr('name')] = $(this).val(); // записываем
        });

        $.ajax({
            type: 'POST',
            url: rq_url,
            data: data_form,
            success: function (data) {
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

    openTask: function (rg_url, parent, isReload, prefics, filter) {
        isReload = isReload || false;
        prefics = prefics || '';
        filter = filter || 'all';

        if ($('#' + prefics + 'subtask_' + parent).html() != '' && !isReload) {
            $('#' + prefics + 'subtask_' + parent).hide();
            $('#' + prefics + 'subtask_' + parent).empty();
            return;
        }

        rg_url += '/filter/' + filter;

        $.get(rg_url, '', function (data) {
            $('#' + prefics + 'subtask_' + parent).empty();
            $('#' + prefics + 'subtask_' + parent).append(data);
            //task.createSubMenu();
            $('#' + prefics + 'subtask_' + parent).show();
        }, 'html');
    },

    openTaskFilter: function (rg_url, parent, isReload, prefics) {
        isReload = isReload || false;
        prefics = prefics || '';

        if ($('#' + prefics + 'subtask_' + parent).html() != '' && !isReload) {
            $('#' + prefics + 'subtask_' + parent).hide();
            $('#' + prefics + 'subtask_' + parent).empty();
            return;
        }

        $.get(rg_url, '', function (data) {
            $('#' + prefics + 'subtask_' + parent).empty();
            $('#' + prefics + 'subtask_' + parent).append(data);
            //task.createSubMenu();
            $('#' + prefics + 'subtask_' + parent).show();
        }, 'html');
    },

    editDialog: function (rq_url, parent, show_url, prefics) {
        prefics = prefics || '';
        if ($('#editDialog').length < 1) // создаем блок диалогового окна
        {
            $('body').append('<div id="editDialog" ></div>');
        } else {
            $('#addDialog').dialog('close'); // на всякий случай закрываем
        }

        $.get(rq_url, '', function (data) { // посылаем пост запрос для вывода формы
            $('#editDialog').html(data).dialog({
                title: 'Редактировать задачу',
                modal: true,
                height: 550,
                width: 830,
                buttons: {
                    Сохранить: function () {
                        $('#editForm').ajaxSubmit({
                            success: function (responseText, statusText, xhr, $form) {
                                if (responseText != '') {
                                    $('#editDialog').html(responseText);
                                }
                                else {
                                    task.openTask(show_url, parent, true, prefics);
                                    $('#editDialog').dialog('close');
                                }
                            }
                        });

                        //task.sendEdit(rq_url, parent, show_url);
                    },
                    Отмена: function () {
                        $('#editDialog').dialog('close');
                    }
                }
            });
            $(".datepicker").datetimepicker();
            $('#exception').css('display', 'none');
        }, 'html');
    },

    sendEdit: function (rq_url, parent, show_url) {
        var data_form = {}; // данные которые будем отправлять
        $('#editDialog').find('input,textarea,select').each(function () { // ищем в цикле все поля формы в диалоговом окне
            data_form[$(this).attr('name')] = $(this).val(); // записываем
        });

        $.ajax({
            type: 'POST',
            url: rq_url,
            data: data_form,
            success: function (data) {
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

    deleteDialog: function (task_title, rg_url, parent, show_url) {
        if ($('#deleteDialog').length < 1) // создаем блок диалогового окна
        {
            $('body').append('<div id="deleteDialog" ></div>');
        } else {
            $('#deleteDialog').dialog('close'); // на всякий случай закрываем
        }

        var html = '<div>Вы действительно хотите удалить задачу:<br/><b>' + task_title + '?</b></div>';

        $('#deleteDialog').html(html).dialog({
            title: 'Удалить задачу',
            modal: true,
            height: 220,
            width: 500,
            buttons: {
                Удалить: function () {
                    $.get(rg_url, function (data) {
                        if (data == '') {
                            task.openTask(show_url, parent, true);
                            $('#deleteDialog').dialog('close');
                        } else {
                            $('#deleteDialog').append(data);
                        }
                    });
                },
                Отмена: function () {
                    $('#deleteDialog').dialog('close');
                }
            }
        });
    },

    createSubMenu: function () {
        $(".task_list button").button({
            icons: {
                secondary: "ui-icon-triangle-1-s"
            }
        }).next().popup();
    },

    viewTask: function (rq_url, id) {
        if ($('#viewDialog').length < 1) // создаем блок диалогового окна
        {
            $('body').append('<div id="viewDialog" ></div>');
        } else {
            $('#viewDialog').dialog('close'); // на всякий случай закрываем
        }

        $.get(rq_url, '', function (data) { // посылаем пост запрос для вывода формы
            $('#viewDialog').html(data).dialog({
                title: 'Информация о задаче',
                modal: true,
                height: 550,
                width: 830,
                buttons: {
                    Закрыть: function () {
                        $('#viewDialog').dialog('close');
                    }
                }
            });
        }, 'html');
    },

    toArchive: function (rg_url, parent, show_url) {
        $.get(rg_url, '', function (data) {
            if (data == '') {
                task.openTask(show_url, parent, true);
            }
        }, 'html');

    },

    fromArchive: function (rg_url, parent, show_url) {
        $.get(rg_url, '', function (data) {
            if (data == '') {
                task.openTask(show_url, parent, true);
            }
        }, 'html');

    },

    showInfo: function (rq_url, id) {
        if ($('#taskInfo').length < 1) {
            $('body').append('<div id="taskInfo" title="Info"></div>');
        } else {
            $('#taskInfo').tooltip('close').empty();
        }

        $.get(rq_url, '', function (data) { // посылаем пост запрос для вывода формы
            $('#taskInfo').html(data).tooltip({
                tooltipClass: 'task_info',
                position: {of: '#task_info_' + id},
                content: data,
                close: function (event, ui) {
                    $('#taskInfo').empty();
                }
            }).tooltip('open');
            $('#task_info_' + id).mouseout(function () {
                if ($('#taskInfo').length > 0) {
                    $('#taskInfo').tooltip('close').empty();
                }
            });
        }, 'html');
    },

    closeInfo: function () {
        if ($('#taskInfo').length > 0) {
            $('#taskInfo').tooltip('close').empty();
        }
    }
};

var doc = {
    showInfo: function (rq_url, id) {
        if ($('#fileInfo').length < 1) {
            $('body').append('<div id="fileInfo" title="Info"></div>');
        } else {
            $('#fileInfo').tooltip('close').empty();
        }

        $.get(rq_url, '', function (data) { // посылаем пост запрос для вывода формы
            $('#fileInfo').html(data).tooltip({
                tooltipClass: 'file_info',
                position: {of: '#doc_info_' + id},
                content: data,
                close: function (event, ui) {
                    $('#fileInfo').empty();
                }
            }).tooltip('open');
            $('#doc_info_' + id).mouseout(function () {
                if ($('#fileInfo').length > 0) {
                    $('#fileInfo').tooltip('close').empty();
                }
            });
        }, 'html');
    },

    closeInfo: function () {
        if ($('#fileInfo').length > 0) {
            $('#fileInfo').tooltip('close').empty();
        }
    }
};

var reports = {
    openTask: function (rg_url, parent, isReload, prefics, filter) {
        isReload = isReload || false;
        prefics = prefics || '';
        filter = filter || 'all';

        if ($('#subtask_' + parent).html() != '' && !isReload) {
            $('#subtask_' + parent).hide();
            $('#subtask_' + parent).empty();
            return;
        }

        rg_url += '/filter/' + filter;

        $.get(rg_url, '', function (data) {
            $('#subtask_' + parent).empty();
            $('#subtask_' + parent).append(data);
            $('#subtask_' + parent).show();
        }, 'html');
    }
};

var organization = {
    addDialog: function (rq_url, parent, show_url, prefics) { // Функция вывода диалогового окна
        prefics = prefics || '';
        if ($('#addDialog').length < 1) // создаем блок диалогового окна
        {
            $('body').append('<div id="addDialog" ></div>');
        } else {
            $('#addDialog').dialog('close'); // на всякий случай закрываем
        }

        $.get(rq_url, '', function (data) { // посылаем пост запрос для вывода формы
            $('#addDialog').html(data).dialog({
                title: 'Добавить организацию',
                modal: true,
                height: 550,
                width: 830,
                buttons: {
                    Добавить: function () {
                        $('#addForm').ajaxSubmit({
                            success: function (responseText, statusText, xhr, $form) {
                                if (responseText != '') {
                                    $('#addDialog').html(responseText);
                                }
                                else {
                                    organization.openOrganization(show_url, parent, true, prefics);
                                    $('#addDialog').dialog('close');
                                }
                            }
                        });
                        //task.send(rq_url, parent, show_url);
                    },
                    Отмена: function () {
                        $('#addDialog').dialog('close');
                    }
                }
            });
            $(".datepicker").datetimepicker();
            $('#exception').css('display', 'none');
        }, 'html');
    },

    openOrganization: function (rg_url, parent, isReload, prefics, filter) {
        isReload = isReload || false;
        prefics = prefics || '';
        filter = filter || 'all';

        if ($('#' + prefics + 'subtask_' + parent).html() != '' && !isReload) {
            $('#' + prefics + 'subtask_' + parent).hide();
            $('#' + prefics + 'subtask_' + parent).empty();
            return;
        }

        rg_url += '/filter/' + filter;

        $.get(rg_url, '', function (data) {
            $('#' + prefics + 'subtask_' + parent).empty();
            $('#' + prefics + 'subtask_' + parent).append(data);
            //task.createSubMenu();
            $('#' + prefics + 'subtask_' + parent).show();
        }, 'html');
    }


}

