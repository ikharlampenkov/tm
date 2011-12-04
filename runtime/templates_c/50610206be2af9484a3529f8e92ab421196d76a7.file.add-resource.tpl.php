<?php /* Smarty version Smarty-3.0.9, created on 2011-11-26 16:14:24
         compiled from "F:\www\tm\application/views/scripts\user/add-resource.tpl" */ ?>
<?php /*%%SmartyHeaderCode:33864ed0adf0298d45-97146520%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50610206be2af9484a3529f8e92ab421196d76a7' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\user/add-resource.tpl',
      1 => 1322298642,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '33864ed0adf0298d45-97146520',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="page"><h1>Добавить ресурс</h1></div><br/>

<?php if (isset($_smarty_tpl->getVariable('exception_msg',null,true,false)->value)){?>
<div>Ошибка: <?php echo $_smarty_tpl->getVariable('exception_msg')->value;?>
</div><br/>
<?php }?>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'addResource'));?>
" method="post">
    <table>
        <tr>
            <td class="ttovar" width="200">Название</td>
            <td class="ttovar"><input name="data[title]" value="<?php echo $_smarty_tpl->getVariable('resource')->value->title;?>
"/></td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>