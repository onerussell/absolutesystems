<?php /* Smarty version 2.6.20, created on 2008-11-26 08:16:51
         compiled from mods/admin/_main.html */ ?>

<script type='text/javascript' src='<?php echo $this->_tpl_vars['jsDir']; ?>
prototype.js'></script>
<script type='text/javascript' src='<?php echo $this->_tpl_vars['jsDir']; ?>
prototip.js'></script>

<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['jsDir']; ?>
css/prototip.css"/>

<?php echo '
<script type=\'text/javascript\'>
function createDemos() {

//<![CDATA[
'; ?>


<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['hist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<?php if ($this->_tpl_vars['hist'][$this->_sections['i']['index']]['action'] == 'Add Comment'): ?>
<?php if ($this->_tpl_vars['hist'][$this->_sections['i']['index']]['commentid'] != 0): ?>
<?php echo '
new Tip(\'info'; ?>
<?php echo $this->_tpl_vars['hist'][$this->_sections['i']['index']]['commentid']; ?>
<?php echo '\', { ajax: 
{url:\'comment.php?idc='; ?>
<?php echo $this->_tpl_vars['hist'][$this->_sections['i']['index']]['commentid']; ?>
<?php echo '\'}, style: 
\'default\', delay:0.5,offset: {x:14,y:14},  border:1, radius:3
});

'; ?>


<?php elseif ($this->_tpl_vars['hist'][$this->_sections['i']['index']]['action'] == 'Upload Screen'): ?>
<?php echo '
'; ?>


<?php endif; ?>
<?php endif; ?>
<?php endfor; endif; ?>
<?php echo '
//]]>
'; ?>

}

document.observe('dom:loaded', createDemos);


</script>


<div class="container">
	<div class="container-c">
		<div class="wrap">
		    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_logout.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<h1><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php">Projects</a> | Administration</h1>
			<div class="admin-list-funcion">
				<div class="w205"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=add_user"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-plus.gif" alt="" />Add user</a></div>
				<div class="w205"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=users"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-view.gif" alt="" />View users</a></div>
				<div class="spacer s10"><!-- --></div>
				<div class="w205"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=add_proj"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-plus.gif" alt="" />Add project</a></div>
				<div class="w205"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=projects&prj_status=1"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-view.gif" alt="" />View projects</a></div>
				<div class="spacer"><!-- --></div>
			</div>

						<table width="100%">
			    <tr>
				   <td valign="bottom"><h2>Recent activity
                   &nbsp;&nbsp;<select id="pf" name="pf" style="font-size:11px; width: 190px;" onchange="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=admin&act=<?php echo $this->_tpl_vars['act']; ?>
&pf='+_v('pf').value);">
                   <option value="0">All Projects</option>
                   <?php $_from = $this->_tpl_vars['pl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <option value="<?php echo $this->_tpl_vars['i']['project_id']; ?>
"<?php if ($this->_tpl_vars['pf'] == $this->_tpl_vars['i']['project_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']['name']; ?>
</option>
                   <?php endforeach; endif; unset($_from); ?>
                   </select>
                   </h2></td>
				  <td align="right"> 
			          <div  style="margin-top: 20px;"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=admin<?php if ($this->_tpl_vars['pf']): ?>&amp;pf=<?php echo $this->_tpl_vars['pf']; ?>
<?php endif; ?>"><?php if (! $this->_tpl_vars['act']): ?><b>view all</b><?php else: ?>view all<?php endif; ?></a> | <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-screen.gif"/> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?act=1&amp;mod=admin<?php if ($this->_tpl_vars['pf']): ?>&amp;pf=<?php echo $this->_tpl_vars['pf']; ?>
<?php endif; ?>"><?php if (1 == $this->_tpl_vars['act']): ?><b>view uploads</b><?php else: ?>view uploads<?php endif; ?></a> | <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-comment.gif"/> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?act=2&amp;mod=admin<?php if ($this->_tpl_vars['pf']): ?>&amp;pf=<?php echo $this->_tpl_vars['pf']; ?>
<?php endif; ?>"><?php if (2 == $this->_tpl_vars['act']): ?><b>view comments</b><?php else: ?>view comments<?php endif; ?></a>  (<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?act=2&amp;what=1&amp;mod=admin<?php if ($this->_tpl_vars['pf']): ?>&amp;pf=<?php echo $this->_tpl_vars['pf']; ?>
<?php endif; ?>"><?php if (1 == $this->_tpl_vars['what']): ?><b>In</b><?php else: ?>In<?php endif; ?></a> | <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?act=2&amp;what=2&amp;mod=admin<?php if ($this->_tpl_vars['pf']): ?>&amp;pf=<?php echo $this->_tpl_vars['pf']; ?>
<?php endif; ?>"><?php if (2 == $this->_tpl_vars['what']): ?><b>Out</b><?php else: ?>Out<?php endif; ?></a>) | <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
m-approve.gif"/> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?act=3&amp;mod=admin<?php if ($this->_tpl_vars['pf']): ?>&amp;pf=<?php echo $this->_tpl_vars['pf']; ?>
<?php endif; ?>"><?php if (3 == $this->_tpl_vars['act']): ?><b>show approved</b><?php else: ?>show approved<?php endif; ?></a>
			           </div>
				  </td>
				</tr>
            </table> 
            <div style="width:100%; height: 5px;"><!-- --></div>
            
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['hist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<div  id="info<?php echo $this->_tpl_vars['hist'][$this->_sections['i']['index']]['commentid']; ?>
" class="main-list<?php if ($this->_tpl_vars['hist'][$this->_sections['i']['index']]['view'] == 0): ?>x<?php endif; ?><?php if ($this->_sections['i']['index'] % 2 == 0): ?> main-list<?php if ($this->_tpl_vars['hist'][$this->_sections['i']['index']]['view'] == 0): ?>x<?php endif; ?>-bg<?php endif; ?>">
				<div class="date"<?php if (1 != $this->_tpl_vars['hist'][$this->_sections['i']['index']]['view']): ?> style="font-weight: normal;"<?php endif; ?>><?php echo $this->_tpl_vars['hist'][$this->_sections['i']['index']]['pdate']; ?>
</div>
				<div  class="info">
					<img src="<?php if ($this->_tpl_vars['hist'][$this->_sections['i']['index']]['action'] == 'Upload Screen'): ?><?php echo $this->_tpl_vars['imgDir']; ?>
i-screen.gif
							  <?php elseif ($this->_tpl_vars['hist'][$this->_sections['i']['index']]['action'] == 'Add Comment'): ?><?php echo $this->_tpl_vars['imgDir']; ?>
i-comment<?php if (1 == $this->_tpl_vars['hist'][$this->_sections['i']['index']]['ustatus']): ?>_out<?php endif; ?>.gif
							  <?php elseif ($this->_tpl_vars['hist'][$this->_sections['i']['index']]['action'] == 'Approve Screen'): ?><?php echo $this->_tpl_vars['imgDir']; ?>
m-approve.gif<?php else: ?><?php echo $this->_tpl_vars['imgDir']; ?>
alert.gif<?php endif; ?>" alt="" />
				<?php echo $this->_tpl_vars['hist'][$this->_sections['i']['index']]['what']; ?>

				<?php if ($this->_tpl_vars['hist'][$this->_sections['i']['index']]['screen_id'] && ( 0 == $this->_tpl_vars['UserInfo']['status'] || 2 == $this->_tpl_vars['UserInfo']['status'] )): ?>[ <font color="#990000"><b>!</b></font> ]<?php endif; ?> 
				<?php if ($this->_tpl_vars['hist'][$this->_sections['i']['index']]['comment_id'] && ( 0 == $this->_tpl_vars['UserInfo']['status'] || 2 == $this->_tpl_vars['UserInfo']['status'] )): ?>[ <font color="#990000"><b>!</b></font> ]<?php endif; ?>
			</div>
			</div>
            <?php endfor; else: ?>
                <div>The history is empty</div>
			<?php endif; ?>
			<br /><?php echo $this->_tpl_vars['pagging']; ?>

			            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
</div>