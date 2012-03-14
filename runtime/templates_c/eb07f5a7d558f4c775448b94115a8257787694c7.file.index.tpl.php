<?php /* Smarty version Smarty-3.0.9, created on 2012-03-14 00:11:33
         compiled from "F:\www\tm\application/views/scripts\organization/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:89304f5f7fc5bac8b4-35048640%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb07f5a7d558f4c775448b94115a8257787694c7' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\organization/index.tpl',
      1 => 1331658691,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89304f5f7fc5bac8b4-35048640',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
?><div class="page">
    <h1 style="width: 300px;">Организации</h1>

    <div class="page_block">
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"organization/index",'priv'=>"show-attribute-hash")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"organization/index",'priv'=>"show-attribute-hash"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'organization','action'=>'viewHash'));?>
">Список атрибутов</a>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"organization/index",'priv'=>"show-attribute-hash"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"organization/index",'priv'=>"show-attribute-type")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"organization/index",'priv'=>"show-attribute-type"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'organization','action'=>'viewAttributeType'));?>
">Типы атрибутов</a>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"organization/index",'priv'=>"show-attribute-type"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </div>

</div><br/>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"organization/add")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"organization/add"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<div class="sub-menu">
    <img src="/i/add.png"/>&nbsp;<a href="javascript:void(0)" onclick="task.addDialog('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'organization','action'=>'add'));?>
', 0, '<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'organization','action'=>'showTaskBlock','parent'=>0));?>
')">добавить</a>
</div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"organization/add"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


