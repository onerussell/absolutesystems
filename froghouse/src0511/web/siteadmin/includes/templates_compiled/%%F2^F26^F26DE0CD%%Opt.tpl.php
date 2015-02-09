<?php /* Smarty version 2.6.11, created on 2006-04-14 05:12:47
         compiled from mods/Opt.tpl */ ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td colspan="2" height="3"><img height="3" border="0"></td>
    </tr>

    <tr>
                <td colspan="2" height="450" align="left" valign="top">
            <br />

            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top">
                    <h2><?php echo $this->_config[0]['vars']['catalog']; ?>
</h2>

                    <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
"><?php echo $this->_config[0]['vars']['pcatalog']; ?>
</a>
                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['bc']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                         > <a href="<?php echo $this->_tpl_vars['bc'][$this->_sections['i']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['bc'][$this->_sections['i']['index']]['name']; ?>
</a>
                    <?php endfor; endif; ?>
                    <br />
                    <br />

                    
                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['category']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                    <tr>
                        <td width="15"><?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['sortid']; ?>
&nbsp;</td>
                        <td>
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="26"><img src="includes/templates/images/folder.gif" border="0"></td>
                                    <td><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?cid=<?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['block']; ?>
 :: <?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['name']; ?>
</a></td>
                                </tr>
                            </table>
                        </td>


                       <td width="35"><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?cid=<?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['id']; ?>
"><IMG src="includes/templates/images/b_browse.png" border="0" width="16" height="16" title="<?php echo $this->_config[0]['vars']['enter']; ?>
" /></a></td>
                       <td width="35"><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=edit&cid=<?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['id']; ?>
"><IMG src="includes/templates/images/b_edit.png" border="0" width="16" height="16" title="<?php echo $this->_config[0]['vars']['edit']; ?>
" /></a></td>
                       <td width="35"><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=delcat&cid=<?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['id']; ?>
"><IMG src="includes/templates/images/b_drop.png" border="0" width="16" height="16" title="<?php echo $this->_config[0]['vars']['delete']; ?>
" /></a></td>
                    </tr>
                                        <tr>
                                        <td colspan="6" height="1px" bgcolor="#CCCCCC"></td>
                                    </tr>
                    <?php endfor; endif; ?>

                                         <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['product']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                    <tr>
                        <td width="15"><?php echo $this->_tpl_vars['product'][$this->_sections['i']['index']]['sortid']; ?>
&nbsp;</td>
                        <td>
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="26"><img src="includes/templates/images/preview.gif" border="0"></td>
                                <td><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?cid=<?php echo $this->_tpl_vars['cid']; ?>
&action=edit&id=<?php echo $this->_tpl_vars['product'][$this->_sections['i']['index']]['pid']; ?>
"><?php echo $this->_tpl_vars['product'][$this->_sections['i']['index']]['val']; ?>
</a></td>
                            </tr>
                            </table>
                        </td>
 
                        <td>
                            <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?cid=<?php echo $this->_tpl_vars['cid']; ?>
&action=change&id=<?php echo $this->_tpl_vars['product'][$this->_sections['i']['index']]['id']; ?>
"><IMG src="includes/templates/images/b_edit.png" border="0" width="16" height="16" title="<?php echo $this->_config[0]['vars']['edit']; ?>
" /></a>
                        </td>

                        <td>
                            <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?cid=<?php echo $this->_tpl_vars['cid']; ?>
&action=delp&id=<?php echo $this->_tpl_vars['product'][$this->_sections['i']['index']]['id']; ?>
"><IMG src="includes/templates/images/b_drop.png" border="0" width="16" height="16" title="<?php echo $this->_config[0]['vars']['delete']; ?>
" /></a>
                        </td>
                        <td>
                        </td>
                    </tr>
                                        <tr>
                                        <td colspan="6" height="1px" bgcolor="#CCCCCC"></td>
                                    </tr>
                    <?php endfor; endif; ?>
                   </table>

                                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                   <tr>
                       <td height="26" colspan="5"></td>
                   </tr>
                   <tr>
                       <td width="50%">&nbsp;</td>
                       <?php if ($this->_tpl_vars['cid'] <> 0 && $this->_tpl_vars['cid'] <> ''): ?>
                       <td><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
"><img src="includes/templates/images/b_up.gif" border="0" alt="<?php echo $this->_config[0]['vars']['ontop']; ?>
"></a>&nbsp;</td>
                       <?php endif; ?>
                       <td>
                       <?php if ($this->_tpl_vars['cid'] <> 0): ?>
                           <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?cid=<?php echo $this->_tpl_vars['cid']; ?>
&action=change"><img src="includes/templates/images/b_addoptval.gif" border="0" alt="<?php echo $this->_config[0]['vars']['add']; ?>
 Option values"></a>&nbsp;
                       <?php endif; ?>
                      </td>
                      <td><?php if ($this->_tpl_vars['cid'] == 0): ?><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?cid=<?php echo $this->_tpl_vars['cid']; ?>
&action=edit"><img src="includes/templates/images/b_addopt.gif" border="0" alt="<?php echo $this->_config[0]['vars']['add']; ?>
 Option"></a><?php endif; ?></td>
                   </tr>
                   </table>

            </table>

        </td>
        
        <td width="4"><img width="4" height="0"></td>

                <td width="250" valign="top">

             <?php if ($this->_tpl_vars['action'] == 'change'): ?>

                 <b><?php echo $this->_config[0]['vars']['action']; ?>
: <?php if ($this->_tpl_vars['id'] == 0 || $this->_tpl_vars['id'] == ''):  echo $this->_config[0]['vars']['add'];  else:  echo $this->_config[0]['vars']['edit'];  endif; ?> option value</b>

                 <?php if ($this->_tpl_vars['fdata']['javascript']): ?>
                     <?php echo $this->_tpl_vars['fdata']['javascript']; ?>

                 <?php endif; ?>

                 <form <?php echo $this->_tpl_vars['fdata']['attributes']; ?>
>
                 <?php if ($this->_tpl_vars['fdata']['errors']): ?>
                     <?php $_from = $this->_tpl_vars['fdata']['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['err']):
?>
                         <p style="color:red"><?php echo $this->_tpl_vars['err']; ?>
</p>
                     <?php endforeach; endif; unset($_from); ?>
                 <?php endif; ?>
                 <table>
                      <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['fdata']['elements']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                      <?php if ($this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'text' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'textarea' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'static' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'file' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'select'): ?>
                      <tr>
                          <td><b><?php echo $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['label']; ?>
</b></td>
                      </tr>
                      <tr>
                          <td><?php echo $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['html']; ?>
</td>
                      </tr>

                      <?php elseif ($this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'hidden'): ?>
                          <?php echo $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['html']; ?>

                      <?php endif; ?>
                      <?php endfor; endif; ?>
			     </table>

                 <table width="200" border="0" cellpadding="0" cellspacing="0">
                 <tr valign="top">
                    <td><A href="#" onClick="document.eform.submit();return false;"><IMG src="includes/templates/images/b_submit.gif" border="0" alt="<?php echo $this->_config[0]['vars']['submit']; ?>
" width="100" height="18" /></A>&nbsp;&nbsp;</td>
                    <td><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?cid=<?php echo $this->_tpl_vars['cid']; ?>
"><img src="includes/templates/images/b_cancel.gif" border="0" alt="<?php echo $this->_config[0]['vars']['cancel']; ?>
"></a></td>
                 </tr>
                 </table>
                 </form>
            <?php endif; ?>
			
             <?php if ($this->_tpl_vars['action'] == 'edit'): ?>

                 <b><?php echo $this->_config[0]['vars']['action']; ?>
: <?php if ($this->_tpl_vars['cid'] == 0 || $this->_tpl_vars['cid'] == ''):  echo $this->_config[0]['vars']['add'];  else:  echo $this->_config[0]['vars']['edit'];  endif; ?> option</b>

                 <?php if ($this->_tpl_vars['fdata']['javascript']): ?>
                     <?php echo $this->_tpl_vars['fdata']['javascript']; ?>

                 <?php endif; ?>

                 <form <?php echo $this->_tpl_vars['fdata']['attributes']; ?>
>
                 <?php if ($this->_tpl_vars['fdata']['errors']): ?>
                     <?php $_from = $this->_tpl_vars['fdata']['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['err']):
?>
                         <p style="color:red"><?php echo $this->_tpl_vars['err']; ?>
</p>
                     <?php endforeach; endif; unset($_from); ?>
                 <?php endif; ?>
                 <table>
                      <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['fdata']['elements']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                      <?php if ($this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'text' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'textarea' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'static' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'file' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'select'): ?>
                      <tr>
                          <td><b><?php echo $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['label']; ?>
</b></td>
                      </tr>
                      <tr>
                          <td><?php echo $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['html']; ?>
</td>
                      </tr>

                      <?php elseif ($this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'hidden'): ?>
                          <?php echo $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['html']; ?>

                      <?php endif; ?>
                      <?php endfor; endif; ?>
			     </table>
                 <br />
                 <table width="200" border="0" cellpadding="0" cellspacing="0">
                 <tr valign="top">
                    <td><A href="#" onClick="document.eform.submit();return false;"><IMG src="includes/templates/images/b_submit.gif" border="0" alt="<?php echo $this->_config[0]['vars']['submit']; ?>
" width="100" height="18" /></A>&nbsp;&nbsp;</td>
                    <td><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?cid=<?php echo $this->_tpl_vars['cid']; ?>
"><img src="includes/templates/images/b_cancel.gif" border="0" alt="<?php echo $this->_config[0]['vars']['cancel']; ?>
"></a></td>
                 </tr>
                 </table>
                 </form>
            <?php endif; ?>
			
            <?php if ($this->_tpl_vars['action'] == 'delcat'): ?>
                <br /><br />
                                <b>Delete option</b> "<?php echo $this->_tpl_vars['inf']['name']; ?>
" with all values?
                <br /><br />
                <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?cid=<?php echo $this->_tpl_vars['inf']['id']; ?>
&action=delcat&do=1"><img src="includes/templates/images/b_submit.gif" alt="<?php echo $this->_config[0]['vars']['submit']; ?>
" border="0"></a>
                                <img width="10" height="0" border="0">
                                <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
"><img src="includes/templates/images/b_cancel.gif" border="0" alt="<?php echo $this->_config[0]['vars']['cancel']; ?>
"></a>
            <?php endif; ?>

           <?php if ($this->_tpl_vars['action'] == 'delp'): ?>
                <br /><br />
                <b>Delete option value</b> <?php echo $this->_tpl_vars['inf']['val']; ?>
 ?
                                <br /><br />
                <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?cid=<?php echo $this->_tpl_vars['cid']; ?>
&id=<?php echo $this->_tpl_vars['inf']['id']; ?>
&action=delp&do=1"><img src="includes/templates/images/b_submit.gif" alt="<?php echo $this->_config[0]['vars']['submit']; ?>
" border="0"></a>
                                <img width="10" height="0" border="0">
                                <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?cid=<?php echo $this->_tpl_vars['cid']; ?>
"><img src="includes/templates/images/b_cancel.gif" border="0" alt="<?php echo $this->_config[0]['vars']['cancel']; ?>
"></a>
           <?php endif; ?>
        </td>

    </tr>
</table>