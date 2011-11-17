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
