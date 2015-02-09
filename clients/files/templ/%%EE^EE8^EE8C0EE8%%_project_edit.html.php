<?php /* Smarty version 2.6.20, created on 2008-12-11 04:39:24
         compiled from mods/admin/_project_edit.html */ ?>
<div class="container">
	<div class="container-c">
		<div class="wrap">
		    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_logout.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<h1><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=admin">Administration</a> | <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=projects">Projects</a> | <?php echo $this->_tpl_vars['eform']['name']; ?>
</h1>

            <form method="post" id="fma" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php">
			<input type="hidden" name="mod" value="add_proj" />
			<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
						<div class="spacer s5"><!-- --></div>
				<?php if ($this->_tpl_vars['errs']): ?>
				    <font color="#990000">
					<b>Errors:</b><br />
					<?php $_from = $this->_tpl_vars['errs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
					    - <?php echo $this->_tpl_vars['item']; ?>
<br />
					<?php endforeach; endif; unset($_from); ?>
					</font>
					<div class="spacer s15"><!-- --></div>
				<?php endif; ?>
<!--
			<script src="<?php echo $this->_tpl_vars['jsDir']; ?>
JsHttpRequest.js"></script>
			<script src="<?php echo $this->_tpl_vars['jsDir']; ?>
JsHttpRequest-prototype.js"></script>-->
            <script src="<?php echo $this->_tpl_vars['jsDir']; ?>
prototype.js"></script>
			<?php echo '
			<script language="javascript" type="text/javascript">
			var icnt = 4;			
			function GetUList(status)
			{
			
                new Ajax.Request(\''; ?>
<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo 'ajax.php\', 
				{
                    method: \'get\',
                    parameters: 
				    {
                       mod   : "getList",
					   status: status,
					   icnt  : icnt
                    },

                    onSuccess: function(tr) 
				    {
						$(\'usr\'+status).innerHTML += tr.responseText;
						icnt += 1;
                    }
                });
			}
					
			function DelBlock(number)
			{
			    $(\'usr_\'+number).value = 0;
				$(\'usr_\'+number).style.display=\'none\';
			}
			</script>
			'; ?>

			<div class="b-form">
				<label>Project name</label>
				<input type="text" name="eform[name]" value="<?php echo $this->_tpl_vars['eform']['name']; ?>
" class="input w350" />
				<div class="spacer s20"><!-- --></div>
				<label>Status<label>
                <select name="eform[active]">
					<option value="1" <?php if (1 == $this->_tpl_vars['eform']['active']): ?> selected="selected"<?php endif; ?>>Active</option>
					<option value="2" <?php if (2 == $this->_tpl_vars['eform']['active']): ?> selected="selected"<?php endif; ?>>Archive</option>
				</select>
				<div class="spacer s20"><!-- --></div>
                <?php $this->assign('ox', -1); ?>
				<?php $_from = $this->_tpl_vars['status_ar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n3'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n3']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k3'] => $this->_tpl_vars['i3']):
        $this->_foreach['n3']['iteration']++;
?>
				<?php if (! ($this->_foreach['n3']['iteration'] <= 1)): ?>
				<!-- -->
				<label><?php echo $this->_tpl_vars['i3']; ?>
</label>
				<?php $this->assign('ox', $this->_tpl_vars['ox']+1); ?>
                <select name="eform[usr<?php echo $this->_tpl_vars['k3']; ?>
][<?php echo $this->_tpl_vars['ox']; ?>
]">
				<option value="0"> ---</option>
				<?php if (1 == $this->_tpl_vars['k3']): ?>
				    <?php $this->assign('ov', 'usr1'); ?>
					<?php $this->assign('va', $this->_tpl_vars['clients']); ?>
				<?php elseif (2 == $this->_tpl_vars['k3']): ?>
			        <?php $this->assign('ov', 'usr2'); ?>
					<?php $this->assign('va', $this->_tpl_vars['managers']); ?>
				<?php elseif (3 == $this->_tpl_vars['k3']): ?>
			        <?php $this->assign('ov', 'usr3'); ?>
					<?php $this->assign('va', $this->_tpl_vars['designers']); ?>
				<?php elseif (4 == $this->_tpl_vars['k3']): ?>	
				    <?php $this->assign('ov', 'usr4'); ?>	
					<?php $this->assign('va', $this->_tpl_vars['programmers']); ?>		
				<?php endif; ?>
				
				<?php $_from = $this->_tpl_vars['va']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>  
				<option value="<?php echo $this->_tpl_vars['i']['uid']; ?>
"<?php if ($this->_tpl_vars['i']['uid'] == $this->_tpl_vars['eform'][$this->_tpl_vars['ov']]['0']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']['name']; ?>
 <?php echo $this->_tpl_vars['i']['lname']; ?>
 [<?php echo $this->_tpl_vars['i']['login']; ?>
]</option>
				<?php endforeach; endif; unset($_from); ?>
				
				</select>
				<?php if ($this->_foreach['n']['total']): ?><span><a href="javascript: GetUList(<?php echo $this->_tpl_vars['k3']; ?>
);">new <?php echo $this->_tpl_vars['i3']; ?>
?</a></span><?php endif; ?>
				<div class="spacer s20"><!-- --></div>  				
				<?php $_from = $this->_tpl_vars['eform'][$this->_tpl_vars['ov']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['i2']):
        $this->_foreach['n2']['iteration']++;
?>
				<?php if (! ($this->_foreach['n2']['iteration'] <= 1)): ?>
				<?php $this->assign('ox', $this->_tpl_vars['ox']+1); ?>	
				<span id="usr_<?php echo $this->_tpl_vars['ox']; ?>
">
				<select name="eform[<?php echo $this->_tpl_vars['ov']; ?>
][<?php echo $this->_tpl_vars['ox']; ?>
]">
				<option value="0"> ---</option>
				<?php $_from = $this->_tpl_vars['va']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>  
				<option value="<?php echo $this->_tpl_vars['i']['uid']; ?>
"<?php if ($this->_tpl_vars['i']['uid'] == $this->_tpl_vars['i2']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']['name']; ?>
 <?php echo $this->_tpl_vars['i']['lname']; ?>
 [<?php echo $this->_tpl_vars['i']['login']; ?>
]</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
				<a href="javascript:DelBlock('<?php echo $this->_tpl_vars['ox']; ?>
');">Delete</a>
				<div class="spacer s20"><!-- --></div>  
				</span>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
				<span id="usr<?php echo $this->_tpl_vars['k3']; ?>
"></span>
				<!-- -->
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
				
				<a href="javascript: $('fma').submit();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
b-update.gif" alt="Update" /></a> &nbsp; <a href="javascript: document.location='<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=projects';"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
b-cancel.gif" alt="" /></a>
			</div>
            </form>
            <script language="javascript">
			<?php $this->assign('ox', $this->_tpl_vars['ox']+1); ?>
			icnt = <?php echo $this->_tpl_vars['ox']; ?>
;
			</script>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
</div>