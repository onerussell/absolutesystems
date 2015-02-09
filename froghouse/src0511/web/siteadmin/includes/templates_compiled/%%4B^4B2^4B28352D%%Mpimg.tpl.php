<?php /* Smarty version 2.6.12, created on 2006-04-25 16:09:54
         compiled from mods/Mpimg.tpl */ ?>

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
                    <h2>Main page images (image size 196x235px)</h2>
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
                        <td>
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="26"><img src="includes/templates/images/preview.gif" border="0"></td>
                                    <td width="150px"><a href="<?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['image']; ?>
" target="_blank"><b><?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['name']; ?>
</b></a></td>
									<td width="150px"><a href="<?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['link']; ?>
"  target="_blank"><?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['link']; ?>
</a></td>
									<td><?php if ($this->_tpl_vars['category'][$this->_sections['i']['index']]['btype'] == 0):  echo $this->_config[0]['vars']['btype1'];  else:  echo $this->_config[0]['vars']['btype2'];  endif; ?></td>
                                </tr>
                            </table>
                        </td>

                        <td width="35"><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=delban&id=<?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['id']; ?>
"><IMG src="includes/templates/images/b_drop.png" border="0" width="16" height="16" title="<?php echo $this->_config[0]['vars']['delete']; ?>
" /></a></td>
                    </tr>
					<tr>
				        <td colspan="2" height="1px" bgcolor="#CCCCCC"></td>
				    </tr>	
                    <?php endfor; endif; ?>
                   </table>

            </table>

        </td>
        
        <td width="4"><img width="4" height="0"></td>

                <td width="250" valign="top">

             <?php if ($this->_tpl_vars['action'] == 'change'): ?>

             <b><?php echo $this->_config[0]['vars']['action']; ?>
: <?php echo $this->_config[0]['vars']['add']; ?>
 image</b>

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
"><img src="includes/templates/images/b_cancel.gif" border="0" alt="<?php echo $this->_config[0]['vars']['cancel']; ?>
"></a></td>
             </tr>
             </table>
             </form>
            <?php elseif ($this->_tpl_vars['action'] == 'delban'): ?>
                <br /><br />
                                <b>Delete Image</b> "<?php echo $this->_tpl_vars['inf']['name']; ?>
" ?
                <br /><br />
                <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?id=<?php echo $this->_tpl_vars['inf']['id']; ?>
&action=delban&do=1"><img src="includes/templates/images/b_submit.gif" alt="<?php echo $this->_config[0]['vars']['submit']; ?>
" border="0"></a>
                                <img width="10" height="0" border="0">
                                <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
"><img src="includes/templates/images/b_cancel.gif" border="0" alt="<?php echo $this->_config[0]['vars']['cancel']; ?>
"></a>
            
			<?php else: ?>
			<br />
			<a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=change"><IMG src="includes/templates/images/b_addusr.gif" border="0" alt="<?php echo $this->_config[0]['vars']['submit']; ?>
" /></a>
			<?php endif; ?>
        </td>
    </tr>
</table>