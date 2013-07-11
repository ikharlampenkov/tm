<?php /* Smarty version Smarty-3.0.9, created on 2013-07-12 00:17:13
         compiled from "F:\www\tm\application/views/scripts\discussion/edit-topic.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1638651dee8993a7896-77821400%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec76c70d2c622d2f94b71173f90b58a0074f37ad' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\discussion/edit-topic.tpl',
      1 => 1373556199,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1638651dee8993a7896-77821400',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><div class="page"><h1>Редактировать тему</h1></div><br/>

<?php if (isset($_smarty_tpl->getVariable('exception_msg',null,true,false)->value)){?>
<div>Ошибка: <?php echo $_smarty_tpl->getVariable('exception_msg')->value;?>
</div><br/>
<?php }?>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'editTopic','id'=>$_smarty_tpl->getVariable('discussion')->value->id));?>
" method="post">
    <table width="100%">
        <tr>
            <td class="ttovar_title">Название</td>
            <td class="ttovar"><input name="data[message]" value="<?php echo $_smarty_tpl->getVariable('discussion')->value->message;?>
"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Тема</td>
            <td class="ttovar"><select name="data[topic]">
                <option value="">--</option>
            <?php if (!empty($_smarty_tpl->getVariable('topicList',null,true,false)->value)){?>
                <?php  $_smarty_tpl->tpl_vars['topic'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('topicList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['topic']->key => $_smarty_tpl->tpl_vars['topic']->value){
?>
                    <option value="<?php echo $_smarty_tpl->getVariable('topic')->value->id;?>
" <?php if (is_object($_smarty_tpl->getVariable('discussion')->value->topic)&&$_smarty_tpl->getVariable('discussion')->value->topic->id==$_smarty_tpl->getVariable('topic')->value->id){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('topic')->value->message;?>
</option>
                <?php }} ?>
            <?php }?>
            </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar_title">Дата создания</td>
            <td class="ttovar"><input name="data[date_create]" value="<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('discussion')->value->dateCreate,"%d.%m.%Y %H:%M:%S");?>
" class="datepicker"/></td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>