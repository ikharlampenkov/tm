<?php /* Smarty version Smarty-3.0.9, created on 2013-07-22 00:07:28
         compiled from "F:\www\tm\application/views/scripts\discussion/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2772951ec15508dd4e9-49762493%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a4bcff7935961047d5c498b087fddf3d5e6df75f' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\discussion/index.tpl',
      1 => 1374426300,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2772951ec15508dd4e9-49762493',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
if (!is_callable('smarty_modifier_capitalize')) include 'F:\www\tm\library\Smarty\plugins\modifier.capitalize.php';
if (!is_callable('smarty_block_if_object_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_object_allowed.php';
if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><div class="page"><h1><?php if (!isset($_smarty_tpl->getVariable('discussion',null,true,false)->value)){?>Обсуждение<?php }else{ ?>Тема: <?php echo $_smarty_tpl->getVariable('discussion')->value->message;?>
<?php }?></h1></div><br/>

<?php if (isset($_smarty_tpl->getVariable('exception_msg',null,true,false)->value)){?>
    <div>Ошибка: <?php echo $_smarty_tpl->getVariable('exception_msg')->value;?>
</div>
    <br/>
<?php }?>

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
"><?php echo $_smarty_tpl->getVariable('crumb')->value->message;?>
</a>
            &nbsp;/
        <?php }} ?>
    <?php }?>
    <br/>
    <br/>
<?php }?>

<div class="sub-menu">
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/addTopic")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/addTopic"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <img src="/i/add.png"/>
        &nbsp;
        <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'addTopic'));?>
">добавить тему</a>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/addTopic"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/add")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/add"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php if (isset($_smarty_tpl->getVariable('parentId',null,true,false)->value)&&$_smarty_tpl->getVariable('parentId')->value>0){?>
        /
        <img src="/i/add.png"/>
        &nbsp;
        <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'add'));?>
">добавить комментарий</a>
    <?php }?>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/add"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

</div>


<table>
    <?php if ($_smarty_tpl->getVariable('topicList')->value!==false){?>
        <?php  $_smarty_tpl->tpl_vars['topic'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('topicList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['topic']->key => $_smarty_tpl->tpl_vars['topic']->value){
?>
            <?php ob_start();?><?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable('controller')->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>$_tmp1,'object'=>($_smarty_tpl->tpl_vars['topic']->value))); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>$_tmp1,'object'=>($_smarty_tpl->tpl_vars['topic']->value)), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <tr>
                    <td class="ttovar">
                        <?php if ($_smarty_tpl->getVariable('topic')->value->isTopic()){?>
                            <img src="/i/discussion_mini.png"/>
                            &nbsp;
                            <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'index','parent'=>$_smarty_tpl->getVariable('topic')->value->id));?>
"><?php echo $_smarty_tpl->getVariable('topic')->value->message;?>
</a>
                        <?php }else{ ?>
                            <img src="/i/comment.png"/>
                            &nbsp;<?php echo $_smarty_tpl->getVariable('topic')->value->message;?>

                        <?php }?></td>
                    <td class="ttovar discussion_date"><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('topic')->value->datecreate,"%d %B %Y");?>
</td>
                    <td class="tedit">
                        <?php if ($_smarty_tpl->getVariable('topic')->value->isTopic()){?>
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/showAcl")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/showAcl"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                <img src="/i/comanda.png"/>
                                &nbsp;
                                <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showAcl','idDiscussion'=>$_smarty_tpl->getVariable('topic')->value->id));?>
">права</a>
                                <br/>
                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/showAcl"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/editTopic")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/editTopic"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                <img src="/i/edit.png"/>
                                &nbsp;
                                <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'editTopic','id'=>$_smarty_tpl->getVariable('topic')->value->id));?>
">редактировать</a>
                                <br/>
                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/editTopic"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/deleteTopic")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/deleteTopic"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                <img src="/i/delete.png"/>
                                &nbsp;
                                <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'deleteTopic','id'=>$_smarty_tpl->getVariable('topic')->value->id));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('topic')->value->message;?>
');" style="color: #830000">удалить</a>
                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/deleteTopic"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        <?php }else{ ?>
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/edit")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/edit"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                <img src="/i/edit.png"/>
                                &nbsp;
                                <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'edit','id'=>$_smarty_tpl->getVariable('topic')->value->id));?>
">редактировать</a>
                                <br/>
                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/edit"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/delete")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/delete"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                <img src="/i/delete.png"/>
                                &nbsp;
                                <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'delete','id'=>$_smarty_tpl->getVariable('topic')->value->id));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('topic')->value->message;?>
');" style="color: #830000">удалить</a>
                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/delete"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        <?php }?>
                    </td>

                </tr>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>$_tmp1,'object'=>($_smarty_tpl->tpl_vars['topic']->value)), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <?php }} ?>
    <?php }?>
</table>

<?php if (isset($_smarty_tpl->getVariable('discussionList',null,true,false)->value)&&$_smarty_tpl->getVariable('discussionList')->value!==false){?>

    <?php $_smarty_tpl->tpl_vars["openul"] = new Smarty_variable(false, null, null);?>

    <ul id="comment-list">
    <?php  $_smarty_tpl->tpl_vars['discussion'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('discussionList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['discussion']->key => $_smarty_tpl->tpl_vars['discussion']->value){
?>
        <?php if (is_null($_smarty_tpl->getVariable('discussion')->value->toUser)||$_smarty_tpl->getVariable('discussion')->value->toUser->id==$_smarty_tpl->getVariable('authUserId')->value||$_smarty_tpl->getVariable('discussion')->value->user->id==$_smarty_tpl->getVariable('authUserId')->value){?>
            <?php if (!$_smarty_tpl->getVariable('discussion')->value->hasParent()&&$_smarty_tpl->getVariable('openul')->value){?></ul><?php $_smarty_tpl->tpl_vars["openul"] = new Smarty_variable(false, null, null);?><?php }?>
            <?php if ($_smarty_tpl->getVariable('discussion')->value->hasParent()&&!$_smarty_tpl->getVariable('openul')->value){?>
                <ul class="discussion_submessage"><?php $_smarty_tpl->tpl_vars["openul"] = new Smarty_variable(true, null, null);?><?php }?>
            <li class="discussion_list">
                <div class="discussion_block">
                    <div id="message_<?php echo $_smarty_tpl->getVariable('discussion')->value->id;?>
" class="<?php if ($_smarty_tpl->getVariable('discussion')->value->isRequest&&!$_smarty_tpl->getVariable('discussion')->value->isComplete){?>discussion_message_request<?php }else{ ?>discussion_message<?php }?>"><?php echo $_smarty_tpl->getVariable('discussion')->value->message;?>
</div>
                    <?php if (count($_smarty_tpl->getVariable('discussion')->value->document)>0){?>
                        <div>
                            <ul>
                                <?php  $_smarty_tpl->tpl_vars['document'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('discussion')->value->document; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['document']->key => $_smarty_tpl->tpl_vars['document']->value){
?>
                                    <li style="list-style: none; padding: 0; background-color: #f7f7f7;">
                                        <a href="/files<?php echo $_smarty_tpl->getVariable('document')->value->file->getSubPath();?>
/<?php echo $_smarty_tpl->getVariable('document')->value->file->getName();?>
" target="_blank" style="font-size: 11px;" id="doc_info_<?php echo $_smarty_tpl->getVariable('document')->value->id;?>
" onmouseover="doc.showInfo('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'document','action'=>'view','id'=>$_smarty_tpl->getVariable('document')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('document')->value->id;?>
);"><?php echo $_smarty_tpl->getVariable('document')->value->title;?>
</a>
                                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"document/edit")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"document/edit"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                            /
                                            <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'document','action'=>'edit','id'=>$_smarty_tpl->getVariable('document')->value->id));?>
" style="font-size: 11px;">редактировать</a>
                                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"document/edit"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                    </li>
                                <?php }} ?>
                            </ul>
                        </div>
                    <?php }?>
                    <div class="discussion_info">
                        <?php if ($_smarty_tpl->getVariable('discussion')->value->user->searchAttribute('name')){?><?php echo $_smarty_tpl->getVariable('discussion')->value->user->getAttribute('name')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('discussion')->value->user->login;?>
<?php }?> <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('discussion')->value->datecreate,"%d.%m.%Y");?>

                        <button onclick="comment_reply_on(<?php echo $_smarty_tpl->getVariable('discussion')->value->id;?>
)">Ответить</button>

                        <?php if ($_smarty_tpl->getVariable('discussion')->value->isRequest){?><?php if ($_smarty_tpl->getVariable('discussion')->value->isComplete){?>
                            <img src="/i/is_complite.png" title="Выполнена" alt="Выполнена" border="0"/>
                        <?php }elseif($_smarty_tpl->getVariable('discussion')->value->user->id==$_smarty_tpl->getVariable('authUserId')->value){?>
                        <button onclick="comment_complete_rq('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showDiscussion','idTask'=>$_smarty_tpl->getVariable('task')->value->id,'is_complete'=>$_smarty_tpl->getVariable('discussion')->value->id));?>
');">Завершить</button><?php }?><?php }?>
                        <?php if ($_smarty_tpl->getVariable('discussion')->value->user->id==$_smarty_tpl->getVariable('authUserId')->value){?>
                            <button onclick="comment_complete_rq('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'delete','id'=>$_smarty_tpl->getVariable('discussion')->value->id));?>
');">удалить</button>
                        <?php }?>
                    </div>
                </div>
            </li>
        <?php }?>

    <?php }} ?>
    </ul>
    <br/>
    <br/>
<?php }?>

<div id="replay_form" style="display: none;">
    <form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'add'));?>
" method="post" enctype="multipart/form-data">
        <div>
            <div class="discussion_form_text">
                Ответить на <span id="replay_on_message"></span>
            </div>
            <textarea name="data[message]"></textarea><br/>

            <div class="discussion_form_text">Загрузить документ</div>
            <div>
                Название документа&nbsp;<input type="text" name="data[document_title]" value="" style="width: 310px;"/>&nbsp;&nbsp;
                <input type="file" name="file" style="width: 300px;"/><br/>
                <textarea name="data[document_description]"></textarea>
            </div>
            <input type="hidden" name="data[parent]" value="" id="parent"/>
            <input type="hidden" name="data[topic]" value="<?php echo $_smarty_tpl->getVariable('parentId')->value;?>
"/>
            <input type="hidden" name="data[date_create]" value="<?php echo smarty_modifier_date_format(time(),"%d.%m.%Y %H:%M:%S");?>
"/>
            <input id="save" name="save" type="submit" value="Отправить"/>
        </div>
    </form>
</div>

<?php if (isset($_smarty_tpl->getVariable('parentId',null,true,false)->value)&&$_smarty_tpl->getVariable('parentId')->value>0){?>
    <div id="add_form">
        <form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'add'));?>
" method="post" enctype="multipart/form-data">
            <div>
                <div class="discussion_form_text">Добавить комментарий <span style="font-weight: normal; vertical-align: top;"><input type="checkbox" name="data[is_request]" style="width: 14px;"/> заявка</span></div>
                <textarea name="data[message]"></textarea><br/>

                <div class="discussion_form_text">Лично для</div>
                <select name="data[to]">
                    <option value="" selected="selected">Всем</option>
                    <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('userList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
                        <option value="<?php echo $_smarty_tpl->getVariable('user')->value->id;?>
"><?php if ($_smarty_tpl->getVariable('user')->value->searchAttribute('name')){?><?php echo $_smarty_tpl->getVariable('user')->value->getAttribute('name')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('user')->value->login;?>
<?php }?></option>
                    <?php }} ?>
                </select>


                <div class="discussion_form_text">Загрузить документ</div>
                <div>
                    Название документа&nbsp;<input type="text" name="data[document_title]" value="" style="width: 310px;"/>&nbsp;&nbsp;
                    <input type="file" name="file" style="width: 300px;"/><br/>
                    <textarea name="data[document_description]"></textarea>
                </div>

                <input type="hidden" name="data[topic]" value="<?php echo $_smarty_tpl->getVariable('parentId')->value;?>
"/>
                <input type="hidden" name="data[date_create]" value="<?php echo smarty_modifier_date_format(time(),"%d.%m.%Y %H:%M:%S");?>
"/>
                <input id="save" name="save" type="submit" value="Отправить"/>
            </div>
        </form>
    </div>
<?php }?>