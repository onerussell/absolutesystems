<?php /* Smarty version 2.6.12, created on 2006-05-09 23:29:06
         compiled from mods/Configure.tpl */ ?>
<?php echo '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td colspan="2" height="3"><img height="3" border="0"></td></tr><tr>';  echo '<td colspan="2" height="450" align="left" valign="top"><br /><table width="100%"  border="0" cellspacing="0" cellpadding="0"><tr><td valign="top"><h2>Configuration</h2><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr vAlign="top"><td valign="top"><!-- main parth-->';  if ($this->_tpl_vars['siteSelect'] != '%admin%'):  echo '<b>Site:</b><br /><br /><select name="selSite" style="width:362px;height:18px;font-size:10px;background-COLOR: steelblue;" onChange="self.location=\'';  echo $this->_tpl_vars['curScriptName'];  echo '?site=\' + this.options[this.selectedIndex].value+\'';  echo $this->_tpl_vars['SIDA'];  echo '\'"><option value="">';  echo $this->_tpl_vars['C_DOMEN'];  echo '</option>';  unset($this->_sections['iisite']);
$this->_sections['iisite']['name'] = 'iisite';
$this->_sections['iisite']['loop'] = is_array($_loop=$this->_tpl_vars['allSites']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iisite']['show'] = true;
$this->_sections['iisite']['max'] = $this->_sections['iisite']['loop'];
$this->_sections['iisite']['step'] = 1;
$this->_sections['iisite']['start'] = $this->_sections['iisite']['step'] > 0 ? 0 : $this->_sections['iisite']['loop']-1;
if ($this->_sections['iisite']['show']) {
    $this->_sections['iisite']['total'] = $this->_sections['iisite']['loop'];
    if ($this->_sections['iisite']['total'] == 0)
        $this->_sections['iisite']['show'] = false;
} else
    $this->_sections['iisite']['total'] = 0;
if ($this->_sections['iisite']['show']):

            for ($this->_sections['iisite']['index'] = $this->_sections['iisite']['start'], $this->_sections['iisite']['iteration'] = 1;
                 $this->_sections['iisite']['iteration'] <= $this->_sections['iisite']['total'];
                 $this->_sections['iisite']['index'] += $this->_sections['iisite']['step'], $this->_sections['iisite']['iteration']++):
$this->_sections['iisite']['rownum'] = $this->_sections['iisite']['iteration'];
$this->_sections['iisite']['index_prev'] = $this->_sections['iisite']['index'] - $this->_sections['iisite']['step'];
$this->_sections['iisite']['index_next'] = $this->_sections['iisite']['index'] + $this->_sections['iisite']['step'];
$this->_sections['iisite']['first']      = ($this->_sections['iisite']['iteration'] == 1);
$this->_sections['iisite']['last']       = ($this->_sections['iisite']['iteration'] == $this->_sections['iisite']['total']);
 echo '<option value="';  echo $this->_tpl_vars['allSites'][$this->_sections['iisite']['index']]['IDSITE'];  echo '" ';  if ($this->_tpl_vars['site'] == $this->_tpl_vars['allSites'][$this->_sections['iisite']['index']]['IDSITE']):  echo 'selected="selected"';  endif;  echo '>';  echo $this->_tpl_vars['allSites'][$this->_sections['iisite']['index']]['name'];  echo '</option>';  endfor; endif;  echo '</select><br /><br />';  endif;  echo '';  if ($this->_tpl_vars['group'] == ''):  echo '<table width="100%"  border="0" cellspacing="2" cellpadding="0" bgcolor="#FFFFFF" ><tr bgcolor="#DDDEDF"><td align="center" width="25">&nbsp;</td><td align="center" height="20" width="250"><b>Name</b></td><td align="center"><b>Filename</b></td><td align="center" colSpan="2" width="70">&nbsp;<b>Action</b>&nbsp;</td></tr>';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['gar']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '<tr bgColor="#ECEEF1"><td align="center" width="25"><a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '&group=';  echo $this->_tpl_vars['gar'][$this->_sections['i']['index']]['id'];  echo '"><img src="';  echo $this->_tpl_vars['siteAdmin'];  echo 'templates/images/folder.gif" border="0" /></a></td><td align="center" height="20" width="250"><a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '&group=';  echo $this->_tpl_vars['gar'][$this->_sections['i']['index']]['id'];  echo '">';  echo $this->_tpl_vars['gar'][$this->_sections['i']['index']]['name'];  echo '</a></td><td align="center">';  echo $this->_tpl_vars['gar'][$this->_sections['i']['index']]['fname'];  echo '</td><td align="center" width="35"><a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '&action=editgroup&group=';  echo $this->_tpl_vars['gar'][$this->_sections['i']['index']]['id'];  echo '"><img src="';  echo $this->_tpl_vars['siteAdmin'];  echo 'templates/images/b_edit.png" border="0" width="16" height="16"/></a></td><td align="center" width="35"><a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '&action=delgroup&group=';  echo $this->_tpl_vars['gar'][$this->_sections['i']['index']]['id'];  echo '"><img src="';  echo $this->_tpl_vars['siteAdmin'];  echo 'templates/images/b_drop.png" border="0" width="16" height="16"/></a></td></tr>';  endfor; endif;  echo '</table>';  else:  echo '<b>';  echo $this->_tpl_vars['name_'];  echo ' > ';  echo $this->_tpl_vars['fname'];  echo '</b><br /><br /><a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '"><img src="';  echo $this->_tpl_vars['siteAdmin'];  echo 'templates/images/b_up.gif" border="0" /></a><br />';  endif;  echo '<br /><table width="100%"  border="0" cellspacing="2" cellpadding="0" bgcolor="#FFFFFF"><tr bgcolor="#DDDEDF"><td align="center" width="25">&nbsp;</td><td align="center" height="20" width="250"><b>Description [constant]</b></td><td align="center"><b>Value</b></td><td align="center" colSpan="2" width="70">&nbsp;<b>Actions</b>&nbsp;</td></tr>';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['show_ar']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '<tr bgColor="#ECEEF1"><td align="center">';  echo $this->_tpl_vars['show_ar'][$this->_sections['i']['index']]['sortid'];  echo '</td><td align="left" height="18"><a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '&action=edit&ocid=';  echo $this->_tpl_vars['show_ar'][$this->_sections['i']['index']]['ocid'];  echo '';  if ($this->_tpl_vars['group'] <> ''):  echo '&group=';  echo $this->_tpl_vars['group'];  echo '';  endif;  echo '" title="';  echo $this->_tpl_vars['show_ar'][$this->_sections['i']['index']]['var'];  echo '">';  echo $this->_tpl_vars['show_ar'][$this->_sections['i']['index']]['name'];  echo '</a></td><td align="left">&nbsp;';  echo $this->_tpl_vars['show_ar'][$this->_sections['i']['index']]['val'];  echo '</td><td align="center" width="35"><a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '&action=edit&ocid=';  echo $this->_tpl_vars['show_ar'][$this->_sections['i']['index']]['ocid'];  echo '';  if ($this->_tpl_vars['group'] <> ''):  echo '&group=';  echo $this->_tpl_vars['group'];  echo '';  endif;  echo '"><img src="';  echo $this->_tpl_vars['siteAdmin'];  echo 'templates/images/b_edit.png" border="0" width="16" height="16" title="Change" /></a></td><td align="center" width="35"><a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '&action=del&ocid=';  echo $this->_tpl_vars['show_ar'][$this->_sections['i']['index']]['ocid'];  echo '';  if ($this->_tpl_vars['group'] <> ''):  echo '&group=';  echo $this->_tpl_vars['group'];  echo '';  endif;  echo '"><img src="';  echo $this->_tpl_vars['siteAdmin'];  echo 'templates/images/b_drop.png" border="0" width="16" height="16" title="Delete" /></a></td></tr>';  endfor; endif;  echo '</table><!-- end main parth--></td><td width="10" valign="top"><img width="10" height="0" /></td><td width="250" valign="top"><br />';  if ($this->_tpl_vars['action'] == 'editgroup'):  echo '<b>Action: ';  if ($this->_tpl_vars['group'] <> ''):  echo 'Edit';  else:  echo 'Add';  endif;  echo ' group </b><form name="formopt" action="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '&action=editgroup&do=1';  if ($this->_tpl_vars['group'] <> ''):  echo '&group=';  echo $this->_tpl_vars['group'];  echo '';  endif;  echo '" method="post"><table width="100%"  border="0" cellspacing="0" cellpadding="0"><tr><td>Name:&nbsp;</td><td><input name="name" type="text" value="';  echo $this->_tpl_vars['name'];  echo '" style="width:140;font-size:9px" /></td></tr><tr><td height="4" colspan="2"></td></tr><tr><td>Filename:&nbsp;</td><td><input name="fname" type="text" value="';  if (! $this->_tpl_vars['fname']):  echo 'def';  else:  echo '';  echo $this->_tpl_vars['fname'];  echo '';  endif;  echo '" style="width:140;font-size:9px" /></td></tr><tr><td height="4" colspan="2"></td></tr></table><table width="200" border="0" cellpadding="0" cellspacing="0" align="center"><tr valign="top"><td><input type="submit" value="Submit" style="width:95px;height:19px;font-size:12px" />&nbsp;&nbsp;</td><td><img width="20" height="0" border="0" /><a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '&';  if ($this->_tpl_vars['group'] <> ''):  echo '&group=';  echo $this->_tpl_vars['group'];  echo '';  endif;  echo '"><img src="';  echo $this->_tpl_vars['siteAdmin'];  echo 'templates/images/b_cancel.gif" border="0" alt="Cancel" /></a></td></tr></table></form>';  elseif ($this->_tpl_vars['action'] == 'edit'):  echo '<b>Action: ';  if ($this->_tpl_vars['ocid'] <> ''):  echo 'Edit';  else:  echo 'Add';  endif;  echo ' parameter </b><form name="formopt" action="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '&action=edit&do=1';  if ($this->_tpl_vars['ocid'] <> ''):  echo '&ocid=';  echo $this->_tpl_vars['ocid'];  echo '';  endif;  echo '';  if ($this->_tpl_vars['group'] <> ''):  echo '&group=';  echo $this->_tpl_vars['group'];  echo '';  endif;  echo '" method="post"><table width="100%"  border="0" cellspacing="0" cellpadding="0"><tr><td>Description:&nbsp;</td><td><input name="name" type="text" value=\'';  echo $this->_tpl_vars['info']['name'];  echo '\' style="width:140;font-size:9px" /></td></tr><tr><td height="4" colspan="2"></td></tr><tr><td>Constant:&nbsp;</td><td><input name="var" type="text" value="';  echo $this->_tpl_vars['info']['var'];  echo '" style="width:140;font-size:9px" /></td></tr><tr><td height="4" colspan="2"></td></tr><tr><td>Sorting order:&nbsp;</td><td><input name="sortid" type="text" value="';  echo $this->_tpl_vars['info']['sortid'];  echo '" style="width:140;font-size:9px" /></td></tr><tr><td height="4" colspan="2"></td></tr><tr><td>Group:&nbsp;</td><td><select name="groupf" style="height:20px;width:150px;font-size:10px"><option value="-1">No</option>';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['gar']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '<option value="';  echo $this->_tpl_vars['gar'][$this->_sections['i']['index']]['id'];  echo '" ';  if ($this->_tpl_vars['group'] == $this->_tpl_vars['gar'][$this->_sections['i']['index']]['id']):  echo 'selected';  endif;  echo '>';  echo $this->_tpl_vars['gar'][$this->_sections['i']['index']]['name'];  echo '&nbsp;[';  echo $this->_tpl_vars['gar'][$this->_sections['i']['index']]['fname'];  echo ']</option>';  endfor; endif;  echo '</select></td></tr><tr><td height="4" colspan="2"></td></tr><!--tr><td colspan="2"><input name="onelang" type="checkbox" value="1" ';  if ($this->_tpl_vars['onelang'] == 1):  echo 'checked';  endif;  echo ' />&nbsp;One value for all languages</td></tr><tr><td colspan="2">(If it is checked - it is necessary to set value only for one language)</td></tr--><tr><td height="4" colspan="2"></td></tr><tr><td>Value:&nbsp;</td><td><textarea name="val" style="font-size:11px " rows="5" cols="20">';  echo $this->_tpl_vars['info']['val'];  echo '</textarea></td></tr><tr><td height="14" colspan="2"></td></tr></table><table width="200" border="0" cellpadding="0" cellspacing="0" align="center"><tr valign="top"><td><input type="submit" value="Submit" style="width:95px;height:19px;font-size:12px" />&nbsp;&nbsp;</td><td><img width="20" height="0" border="0" /><a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '';  if ($this->_tpl_vars['group'] <> ''):  echo '&group=';  echo $this->_tpl_vars['group'];  echo '';  endif;  echo '"><img src="';  echo $this->_tpl_vars['siteAdmin'];  echo 'templates/images/b_cancel.gif" border="0" alt="Cancel" /></a></td></tr></table></form></td></tr></table>';  elseif ($this->_tpl_vars['action'] == 'delgroup'):  echo 'Delete group \'';  echo $this->_tpl_vars['name_'];  echo '\' with all settings?<br /><br /><a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '&group=';  echo $this->_tpl_vars['group'];  echo '&action=delgroup&do=1"><img src="';  echo $this->_tpl_vars['siteAdmin'];  echo 'templates/images/b_submit.gif" alt="Apply" border="0" /></a><img width="10" height="0" border="0" />&nbsp;<a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '"><img src="';  echo $this->_tpl_vars['siteAdmin'];  echo 'templates/images/b_cancel.gif" border="0" alt="Cancel" /></a>';  elseif ($this->_tpl_vars['action'] == 'del'):  echo 'Delete this parameter ?<br /><br /><a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '&ocid=';  echo $this->_tpl_vars['ocid'];  echo '&action=del&do=1"><img src="';  echo $this->_tpl_vars['siteAdmin'];  echo 'templates/images/b_submit.gif" alt="Apply" border="0" /></a><img width="10" height="0" border="0" />&nbsp;<a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '"><img src="';  echo $this->_tpl_vars['siteAdmin'];  echo 'templates/images/b_cancel.gif" border="0" alt="Cancel" /></a>';  else:  echo '<div align="center"><a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '&action=edit';  if ($this->_tpl_vars['group'] <> ''):  echo '&group=';  echo $this->_tpl_vars['group'];  echo '';  endif;  echo '"><img src=\'';  echo $this->_tpl_vars['siteAdmin'];  echo 'templates/images/b_addopt.gif\' border="0" /></a></div>';  if ($this->_tpl_vars['group'] == ''):  echo '<div align="center"><br /><a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '&action=editgroup"><img src=\'';  echo $this->_tpl_vars['siteAdmin'];  echo 'templates/images/b_addgr.gif\' border="0" /></a></div>';  else:  echo '<div align="center"><br /><a href="configure.php?site=';  echo $this->_tpl_vars['site'];  echo '&action=editgroup&group=';  echo $this->_tpl_vars['group'];  echo '"><img src=\'';  echo $this->_tpl_vars['siteAdmin'];  echo 'templates/images/b_edgr.gif\' border="0" /></a></div>';  endif;  echo '';  endif;  echo '</td></tr></table>'; ?>