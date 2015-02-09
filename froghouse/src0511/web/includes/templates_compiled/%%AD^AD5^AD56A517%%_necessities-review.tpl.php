<?php /* Smarty version 2.6.12, created on 2006-05-09 10:06:48
         compiled from mods/_necessities-review.tpl */ ?>
	<div class="maincontainer">

	   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/necessities/_left_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

 	    <div class="rightpart">

			<div class="title-block"><div><?php echo $this->_tpl_vars['inf']['title']; ?>
</div></div>
			<div class="block">
				<div class="pad">
					<div class="rev">
												<div class="info">
														<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['inf']['adi']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							<div class="line"><b><?php echo $this->_tpl_vars['inf']['adi'][$this->_sections['i']['index']]['name'];  if ($this->_tpl_vars['inf']['adi'][$this->_sections['i']['index']]['name'] <> ''): ?>:<?php endif; ?></b> <?php echo $this->_tpl_vars['inf']['adi'][$this->_sections['i']['index']]['val']; ?>
</div>
							<?php endfor; endif; ?>
													</div>
					</div>
					<div class="spacer s9"><!-- --></div>
					<div class="link link-left"><a href="<?php echo $this->_tpl_vars['inf']['link']; ?>
#addc">Add a new review</a><?php if ($this->_tpl_vars['uadmin']): ?>&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=<?php echo $this->_tpl_vars['block']; ?>
&mid=<?php echo $this->_tpl_vars['inf']['id']; ?>
&action=del">Delete </a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=<?php echo $this->_tpl_vars['block']; ?>
&mid=<?php echo $this->_tpl_vars['inf']['id']; ?>
&action=add">Edit</a><?php endif; ?></div>
				</div>
			</div>

			<div class="spacer s13"><!-- --></div>

			<div class="title-block"><div><?php echo $this->_tpl_vars['inf']['title']; ?>
 Reviews</div></div>
			<div class="block">
				<div class="pad">
					<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<div class="post">
						<div class="post-item">
							<div class="pic"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
users/<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['user']['nickname']; ?>
/profile.html"><?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['user_pic']['res_image'] <> ''): ?><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/data/gallery/<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['user_pic']['res_image']; ?>
" alt="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['user']['nickname']; ?>
" />
                                            <?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['user_pic']['name'] <> ''): ?><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/data/gallery/<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['user_pic']['name']; ?>
" alt="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['user']['nickname']; ?>
"><?php endif; ?></a></div>
							<div class="text"><span class="name"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
users/<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['user']['nickname']; ?>
/profile.html"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['user']['nickname']; ?>
</a> <br /><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['pdate']; ?>
</span><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['descr']; ?>

		                    <?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['uid'] == $this->_tpl_vars['uinfo'][0] || $this->_tpl_vars['uadmin'] == 1): ?><div class="links"><a href="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['link_ed']; ?>
">Edit <?php echo $this->_config[0]['vars']['comment']; ?>
</a>&nbsp;|&nbsp;<a href="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['link_del']; ?>
"><?php echo $this->_config[0]['vars']['tdelete']; ?>
 <?php echo $this->_config[0]['vars']['comment']; ?>
</a></div><?php endif; ?>
							</div>
						</div>
						<div class="spacer"><!-- --></div>
					</div>
					<div class="spacer s9 bg-grey"><!-- --></div>
					<?php endfor; endif; ?>
					<div class="link linkpad"><div class="left"><div><a href="<?php echo $this->_tpl_vars['inf']['link']; ?>
#addc">Add a new review</a></div></div><?php echo $this->_tpl_vars['_pagging']; ?>
&nbsp;</div>
				</div>
			</div>

			<div class="spacer s13" id="addc"><!-- --></div>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/necessities/_add_comment.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>

	<div class="spacer"><!-- --></div>
	</div>