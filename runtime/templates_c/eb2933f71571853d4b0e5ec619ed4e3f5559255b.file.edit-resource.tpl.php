<?php /* Smarty version Smarty-3.0.9, created on 2012-03-14 00:16:16
         compiled from "F:\www\tm\application/views/scripts\user/edit-resource.tpl" */ ?>
<?php /*%%SmartyHeaderCode:98114f5f80e03a51f8-56151142%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb2933f71571853d4b0e5ec619ed4e3f5559255b' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\user/edit-resource.tpl',
      1 => 1322989118,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '98114f5f80e03a51f8-56151142',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="page"><h1>Редактировать ресурс</h1></div><br/>

<?php if (isset($_smarty_tpl->getVariable('exception_msg',null,true,false)->value)){?>
<div>Ошибка: <?php echo $_smarty_tpl->getVariable('exception_msg')->value;?>
</div><br/>
<?php }?>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'editResource','id'=>$_smarty_tpl->getVariable('resource')->value->id));?>
" method="post">
    <table>
        <tr>
            <td class="ttovar" width="200">Название</td>
            <td class="ttovar"><input name="data[title]" value="<?php echo $_smarty_tpl->getVariable('resource')->value->title;?>
"/></td>
        </tr>
        <tr>
            <td class="ttovar" width="200">Русское название</td>
            <td class="ttovar"><input name="data[rtitle]" value="<?php echo $_smarty_tpl->getVariable('resource')->value->rtitle;?>
"/></td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>