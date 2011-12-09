/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 17.11.11
 * Time: 22:45
 * To change this template use File | Settings | File Templates.
 */


function confirmDelete(name) {
    if (confirm("Вы подтверждаете удаление " + name + "?")) {
        return true;
    } else {
        return false;
    }
}

function comment_reply_on(id) {
    $('#replay_on_message').html($('#message_' + id).html());
    $('#parent').val(id);

    $('#replay_form').show();
    $('#add_form').hide();
}


