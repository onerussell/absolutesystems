<?php /* Smarty version 2.6.12, created on 2006-05-03 03:29:05
         compiled from mods/food/_left_menu.tpl */ ?>
		<div class="leftpart">

			<div class="rightmenu m-green">
				<div class="bg-top">
					<div class="bg-bottom">
						<ul class="me-menu">
							<li<?php if ($this->_tpl_vars['block'] == ''): ?> class="on"<?php endif; ?>><span class="overview"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
">Overview</a></span>
							<li<?php if ($this->_tpl_vars['block'] == 'quick'): ?> class="on"<?php endif; ?>><span class="quicke"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=quick">Quick Eats</a></span>
							<li<?php if ($this->_tpl_vars['block'] == 'sitdown'): ?> class="on"<?php endif; ?>><span class="sitdown"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=sitdown">Sit Down Places</a></span>
							<li<?php if ($this->_tpl_vars['block'] == 'coffe'): ?> class="on"<?php endif; ?>><span class="cofeesh"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=coffe">Coffee Shops</a></span>
							<li<?php if ($this->_tpl_vars['block'] == 'pubs'): ?> class="on"<?php endif; ?>><span class="pubs"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=pubs">Pubs</a></span>
						</ul>
					</div>
				</div>
			</div>
			<div class="spacer s8"><!-- --></div>
			<div class="rightmenu m-grey">
				<div class="bg-top">
					<div class="bg-bottom">
						<ul>
							<li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=quick&action=add">Add a quick eat review</a>
							<li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=sitdown&action=add">Add a sit down place review</a>
							<li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=coffe&action=add">Add a coffee shop review</a>
							<li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=pubs&action=add">Add a pub review</a>
						</ul>
					</div>
				</div>
			</div>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/nightlife/_search.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
		</div>