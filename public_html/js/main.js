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

function comment_reply_on2(id, to_user, to_task) {
    $('#replay_on_message').html($('#message_' + id).html());
    $('#parent').val(id);
    $('#to_user').val(to_user);
    $('#to_task').val(to_task);

    $('#replay_form').show();
}

function comment_complete_rq(rq_url) {
    document.location.href = rq_url;
}

function mainmenu() {
    $(".menu_up ul").css({display:"none"});
    $(".menu_up li").hover(function () {
        $(this).find('ul.list').css({visibility:"visible", display:"none", position:"absolute"}).show(200);
    }, function () {
        $(this).find('ul.list').css({visibility:"hidden"});
    });
}

$(document).ready(function () {
    mainmenu();
    task.createSubMenu();
    $(".datepicker").datetimepicker();
});

$(function () {
    /*
     var btn = $(".task_list button").each(function () {
     $(this).button({
     icons:{
     secondary:"ui-icon-triangle-1-s"
     }
     }).next().menu({
     trigger: $(this)
     });
     });
     */


    /*
     $("ul[id*='task_action_']").menu({
     select: function(event, ui) {
     //$("#log").append("<div>Selected " + ui.item.text() + "</div>");
     },
     trigger : btn});
     */
});