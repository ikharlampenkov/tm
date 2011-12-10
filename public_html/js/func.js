/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 09.12.11
 * Time: 21:00
 * To change this template use File | Settings | File Templates.
 */


var task = {
    addDialog:function (rq_url) { // Функция вывода диалогового окна
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
                        task.send(rq_url)
                    },
                    Отмена:function () {
                        $('#addDialog').dialog('close')
                    }
                }
            });
            $('#exception').css('display', 'none');
        }, 'html');
    },

    send:function (rq_url) {
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
                $('#addDialog').dialog('close')
            }
          }
        }, 'html');
    },

    openTask: function(rg_url, parent) {
        $('#subtask_' + parent).empty();

        $.get(rg_url, '', function (data) {
            $('#subtask_' + parent).append(data);
        }, 'html');

    }
}
