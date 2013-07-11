<?php /* Smarty version Smarty-3.0.9, created on 2013-07-11 23:24:57
         compiled from "F:\www\tm\application/views/scripts\discussion/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:230444f1c3e8047aca4-76241576%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a4bcff7935961047d5c498b087fddf3d5e6df75f' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\discussion/index.tpl',
      1 => 1373556199,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '230444f1c3e8047aca4-76241576',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
if (!is_callable('smarty_modifier_capitalize')) include 'F:\www\tm\library\Smarty\plugins\modifier.capitalize.php';
if (!is_callable('smarty_block_if_object_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_object_allowed.php';
if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><div class="page"><h1><?php if (!isset($_smarty_tpl->getVariable('discussion',null,true,false)->value)){?>Обсуждение<?php }else{ ?>Тема: <?php echo $_smarty_tpl->getVariable('discussion')->value->title;?>
<?php }?></h1></div><br/>

<?php if (isset($_smarty_tpl->getVariable('breadcrumbs',null,true,false)->value)){?>
    <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'index','parent'=>0));?>
">/..</a>
    <?php if (!empty($_smarty_tpl->getVariable('breadcrumbs',null,true,false)->value)){?>
    &nbsp;/
    <?php  $_smarty_tpl->tpl_vars['crumb'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('breadcrumbs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['crumb']->key => $_smarty_tpl->tpl_vars['crumb']->value){
?>
    <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'index','parent'=>$_smarty_tpl->getVariable('crumb')->value->id));?>
"><?php echo $_smarty_tpl->getVariable('crumb')->value->title;?>
</a>&nbsp;/
    <?php }} ?>
    <?php }?>
    <br/><br/>
<?php }?>


<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="4">
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/addTopic")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/addTopic"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <img src="/i/add.png"/>&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'addTopic'));?>
">добавить тему</a> /
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/addTopic"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/add")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/add"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php if (isset($_smarty_tpl->getVariable('parentId',null,true,false)->value)&&$_smarty_tpl->getVariable('parentId')->value>0){?>
            <img src="/i/add.png"/>&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'add'));?>
">добавить комментарий</a>
            <?php }?>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/add"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </td>
    </tr>

<?php if ($_smarty_tpl->getVariable('discussionList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['discussion'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('discussionList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['discussion']->key => $_smarty_tpl->tpl_vars['discussion']->value){
?>
        <?php ob_start();?><?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable('controller')->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>$_tmp1,'object'=>($_smarty_tpl->tpl_vars['discussion']->value))); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>$_tmp1,'object'=>($_smarty_tpl->tpl_vars['discussion']->value)), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <tr>
            <td class="ttovar">
                <?php if ($_smarty_tpl->getVariable('discussion')->value->isTopic()){?>
                    <img src="/i/discussion_mini.png"/>&nbsp;
                    <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'index','parent'=>$_smarty_tpl->getVariable('discussion')->value->id));?>
"><?php echo $_smarty_tpl->getVariable('discussion')->value->message;?>
</a>
                <?php }else{ ?>
                    <img src="/i/comment.png"/>&nbsp;
                    <?php echo $_smarty_tpl->getVariable('discussion')->value->message;?>

                <?php }?></td>
            <td class="ttovar"><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('discussion')->value->datecreate,"%d %B %Y");?>
</td>
            <td class="tedit">
                <?php if (!$_smarty_tpl->getVariable('discussion')->value->isMessage){?>
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/showAcl")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/showAcl"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <img src="/i/comanda.png"/>&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showAcl','idDiscussion'=>$_smarty_tpl->getVariable('discussion')->value->id));?>
">права</a>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/showAcl"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <?php }?>
            </td>
            <td class="tedit">
                <?php if ($_smarty_tpl->getVariable('discussion')->value->isTopic()){?>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/editTopic")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/editTopic"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <img src="/i/edit.png"/>&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'editTopic','id'=>$_smarty_tpl->getVariable('discussion')->value->id));?>
">редактировать</a><br/>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/editTopic"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/deleteTopic")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/deleteTopic"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <img src="/i/delete.png"/>&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'deleteTopic','id'=>$_smarty_tpl->getVariable('discussion')->value->id));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('discussion')->value->message;?>
');" style="color: #830000">удалить</a>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/deleteTopic"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <?php }else{ ?>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/edit")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/edit"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <img src="/i/edit.png"/>&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'edit','id'=>$_smarty_tpl->getVariable('discussion')->value->id));?>
">редактировать</a><br/>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/edit"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/delete")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/delete"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <img src="/i/delete.png"/>&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'delete','id'=>$_smarty_tpl->getVariable('discussion')->value->id));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('discussion')->value->message;?>
');" style="color: #830000">удалить</a>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/delete"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <?php }?>
            </td>

        </tr>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>$_tmp1,'object'=>($_smarty_tpl->tpl_vars['discussion']->value)), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php }} ?>
<?php }?>

</table>