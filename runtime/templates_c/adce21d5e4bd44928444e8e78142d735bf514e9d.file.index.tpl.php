<?php /* Smarty version Smarty-3.0.9, created on 2012-09-27 22:41:14
         compiled from "F:\www\tm\application/views/scripts\user/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:166445064739a71a875-26197202%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'adce21d5e4bd44928444e8e78142d735bf514e9d' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\user/index.tpl',
      1 => 1348760471,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166445064739a71a875-26197202',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
?>


<div class="page">
    <h1>Пользователи</h1>

    <div class="page_block">
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-attribute-hash")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-attribute-hash"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'viewHash'));?>
">Список атрибутов</a>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-attribute-hash"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-attribute-type")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-attribute-type"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'viewAttributeType'));?>
">Типы атрибутов</a>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-attribute-type"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-resource")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-resource"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'viewResource'));?>
">Ресурсы</a>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-resource"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </div>
</div><br/>

<h3>Сотрудники</h3>

<div class="sub-menu">
    <img src="/i/add.png"/>&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'add'));?>
">добавить</a>
</div>

<table width="100%">
    <tr>
        <td class="ttovar">ФИО</td>
        <td class="ttovar">Логин</td>
        <td class="ttovar">Роль</td>
        <td class="ttovar"></td>
    </tr>

<?php if ($_smarty_tpl->getVariable('userList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('userList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
        <tr>
            <td class="ttovar"><?php if ($_smarty_tpl->getVariable('user')->value->searchAttribute('name')){?><?php echo $_smarty_tpl->getVariable('user')->value->getAttribute('name')->value;?>
<?php }else{ ?>-<?php }?></td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('user')->value->login;?>
</td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('user')->value->role->rtitle;?>
</td>
            <td class="tedit" style="width: 20px; background-color: #f7f7f7;">
                <div class="btn-group">
                    <button style="border: 0" data-toggle="dropdown"><i class="icon-edit"></i></button>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showPrivateTask','userId'=>$_smarty_tpl->getVariable('user')->value->id));?>
"><img src="/i/task.png"/>&nbsp;задачи</a></li>
                        <li><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showUserAcl','id'=>$_smarty_tpl->getVariable('user')->value->id));?>
"><img src="/i/comanda.png"/>&nbsp;права</a></li>
                        <li><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'edit','id'=>$_smarty_tpl->getVariable('user')->value->id));?>
"><img src="/i/edit.png"/>&nbsp;редактировать</a></li>
                        <li><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'delete','id'=>$_smarty_tpl->getVariable('user')->value->id));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('user')->value->login;?>
');" style="color: #830000"><img src="/i/delete.png"/>&nbsp;удалить</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    <?php }} ?>
<?php }?>
</table>

<h3>Клиенты</h3>

<div class="sub-menu">
    <img src="/i/add.png"/>&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'add'));?>
">добавить</a>
</div>

<table width="100%">
    <tr>
        <td class="ttovar">ФИО</td>
        <td class="ttovar">Логин</td>
        <td class="ttovar">Роль</td>
        <td class="ttovar"></td>
    </tr>

<?php if ($_smarty_tpl->getVariable('userListClient')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('userListClient')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
        <tr>
            <td class="ttovar"><?php if ($_smarty_tpl->getVariable('user')->value->searchAttribute('name')){?><?php echo $_smarty_tpl->getVariable('user')->value->getAttribute('name')->value;?>
<?php }else{ ?>-<?php }?></td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('user')->value->login;?>
</td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('user')->value->role->rtitle;?>
</td>
            <td class="tedit" style="width: 20px; background-color: #f7f7f7;">
                <div class="btn-group">
                    <button style="border: 0" data-toggle="dropdown"><i class="icon-edit"></i></button>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showPrivateTask','userId'=>$_smarty_tpl->getVariable('user')->value->id));?>
"><img src="/i/task.png"/>&nbsp;задачи</a></li>
                        <li><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showUserAcl','id'=>$_smarty_tpl->getVariable('user')->value->id));?>
"><img src="/i/comanda.png"/>&nbsp;права</a></li>
                        <li><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'edit','id'=>$_smarty_tpl->getVariable('user')->value->id));?>
"><img src="/i/edit.png"/>&nbsp;редактировать</a></li>
                        <li><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'delete','id'=>$_smarty_tpl->getVariable('user')->value->id));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('user')->value->login;?>
');" style="color: #830000"><img src="/i/delete.png"/>&nbsp;удалить</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    <?php }} ?>
<?php }?>
</table>


<br/>
<div style="background-color:#f0f0f0; padding:5px;"><h1>Роли</h1></div><br/>

<div class="sub-menu">
    <img src="/i/add.png"/>&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'addRole'));?>
">добавить</a>
</div>

<table width="100%">
<?php if ($_smarty_tpl->getVariable('userRoleList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['role'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('userRoleList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['role']->key => $_smarty_tpl->tpl_vars['role']->value){
?>
        <tr>
            <td class="ttovar"><img src="/i/group.png"/>&nbsp;<?php echo $_smarty_tpl->getVariable('role')->value->rtitle;?>
</td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('role')->value->title;?>
</td>
            <td class="tedit" style="width: 20px; background-color: #f7f7f7;">
                <div class="btn-group">
                    <button style="border: 0" data-toggle="dropdown"><i class="icon-edit"></i></button>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showRoleAcl','idRole'=>$_smarty_tpl->getVariable('role')->value->id));?>
"><img src="/i/comanda.png"/>&nbsp;права</a></li>
                        <li><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'editRole','id'=>$_smarty_tpl->getVariable('role')->value->id));?>
"><img src="/i/edit.png"/>&nbsp;редактировать</a></li>
                        <li><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'deleteRole','id'=>$_smarty_tpl->getVariable('role')->value->id));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('role')->value->rtitle;?>
');" style="color: #830000"><img src="/i/delete.png"/>&nbsp;удалить</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    <?php }} ?>
<?php }?>
</table>