<?php /* Smarty version Smarty-3.0.9, created on 2011-11-30 19:42:02
         compiled from "/home/c/cl71252/tm.cl71252.tmweb.ru/application/views/scripts/task/show-discussion.tpl" */ ?>
<?php /*%%SmartyHeaderCode:597588964ed64eca89e5e1-35565084%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46cd2f9e0a71bc694a1c338b858e349c8495755a' => 
    array (
      0 => '/home/c/cl71252/tm.cl71252.tmweb.ru/application/views/scripts/task/show-discussion.tpl',
      1 => 1322653320,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '597588964ed64eca89e5e1-35565084',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/home/c/cl71252/tm.cl71252.tmweb.ru/library/Smarty/plugins/modifier.date_format.php';
?><div class="page"><h1>Обсуждение задачи: <?php echo $_smarty_tpl->getVariable('task')->value->title;?>
</h1></div><br/>

<?php if ($_smarty_tpl->getVariable('discussionList')->value!==false){?>

<?php $_smarty_tpl->tpl_vars["openul"] = new Smarty_variable(false, null, null);?>

<ul id="comment-list" style="padding: 0; margin: 0;">
    <?php  $_smarty_tpl->tpl_vars['discussion'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('discussionList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['discussion']->key => $_smarty_tpl->tpl_vars['discussion']->value){
?>
        <?php if (!$_smarty_tpl->getVariable('discussion')->value->hasParent()&&$_smarty_tpl->getVariable('openul')->value){?></ul><?php $_smarty_tpl->tpl_vars["openul"] = new Smarty_variable(false, null, null);?><?php }?>
        <?php if ($_smarty_tpl->getVariable('discussion')->value->hasParent()&&!$_smarty_tpl->getVariable('openul')->value){?><ul style="margin-left: 20px; padding: 0px;"><?php $_smarty_tpl->tpl_vars["openul"] = new Smarty_variable(true, null, null);?><?php }?>
        <li style="list-style: none; padding: 5px; background-color: #f7f7f7;">
            <div style="padding: 5px;">
                <div style="font-size: 12px; line-height: 16px;" id="message_<?php echo $_smarty_tpl->getVariable('discussion')->value->id;?>
"><?php echo $_smarty_tpl->getVariable('discussion')->value->message;?>
</div>
                <?php if (!empty($_smarty_tpl->getVariable('discussion',null,true,false)->value->getDocument())){?>
                <div>
                <ul style="padding: 0; margin: 0;">
                    <?php  $_smarty_tpl->tpl_vars['document'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('discussion')->value->getDocument(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['document']->key => $_smarty_tpl->tpl_vars['document']->value){
?>
                    <li style="list-style: none; padding: 5px; background-color: #f7f7f7;">
                        <a href="/files<?php echo $_smarty_tpl->getVariable('document')->value->file->getSubPath();?>
/<?php echo $_smarty_tpl->getVariable('document')->value->file->getName();?>
" target="_blank"><?php echo $_smarty_tpl->getVariable('document')->value->title;?>
</a>
                    </li>
                    <?php }} ?>
                </ul>
                </div>
                <?php }?>
                <div style="color: #555555; font-size: 11px; line-height: 15px; margin: 5px 0px 0px 0px;">
                    <?php echo $_smarty_tpl->getVariable('discussion')->value->user->login;?>
 <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('discussion')->value->datecreate,"%d.%m.%Y");?>

                    <button style="font-size: 11px; height: 18px; margin: 1px; padding: 1px;" onclick="comment_reply_on(<?php echo $_smarty_tpl->getVariable('discussion')->value->id;?>
)">Ответить</button>
                </div>
            </div>
        </li>

    <?php }} ?>
</ul>

<br/><br/>
<?php }?>

<div id="replay_form" style="display: none;">
    <form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showDiscussion','idTask'=>$_smarty_tpl->getVariable('task')->value->id));?>
" method="post" enctype="multipart/form-data">
        <div>
            <div style="font-size: 14px; font-weight: bold; padding: 0px 0px 5px 0px; margin: 0px 0px 5px 0px;">
                Ответить на <span id="replay_on_message"></span>
            </div>
            <textarea name="data[message]"></textarea><br/>
            <div style="font-size: 14px; font-weight: bold; padding: 0px 0px 5px 0px; margin: 0px 0px 5px 0px;">Загрузить документ</div>
            <div>
                Название документа&nbsp;<input name="data[document_title]" value="" style="width: 310px;" />&nbsp;&nbsp;
                <input type="file" name="file" style="width: 300px;"/>
            </div>
            <input type="hidden" name="data[parent]" value="" id="parent" />
            <input id="save" name="save" type="submit" value="Отправить"/>
        </div>
    </form>
    
</div>


<div id="add_form">
<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showDiscussion','idTask'=>$_smarty_tpl->getVariable('task')->value->id));?>
" method="post" enctype="multipart/form-data">
    <div>
        <div style="font-size: 14px; font-weight: bold; padding: 0px 0px 5px 0px; margin: 0px 0px 5px 0px;">Добавить комментарий</div>
        <textarea name="data[message]"></textarea><br/>
        <div style="font-size: 14px; font-weight: bold; padding: 0px 0px 5px 0px; margin: 0px 0px 5px 0px;">Загрузить документ</div>
        <div>
            Название документа&nbsp;<input name="data[document_title]" value="" style="width: 310px;" />&nbsp;&nbsp;
            <input type="file" name="file" style="width: 300px;"/>
        </div>

        <input id="save" name="save" type="submit" value="Отправить"/>
    </div>
</form>
</div>