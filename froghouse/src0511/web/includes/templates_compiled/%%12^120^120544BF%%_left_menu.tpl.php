<?php /* Smarty version 2.6.12, created on 2006-05-02 13:14:50
         compiled from mods/nightlife/_left_menu.tpl */ ?>
		<div class="leftpart">
			<div class="rightmenu m-green">
				<div class="bg-top">
					<div class="bg-bottom">
						<ul class="me-menu">
							<li<?php if ($this->_tpl_vars['block'] == ''): ?> class="on"<?php endif; ?>><span class="overview"><a href="page.php?mod=nightlife">Overview</a></span>
							<li<?php if ($this->_tpl_vars['block'] == 'bars'): ?> class="on"<?php endif; ?>><span class="bars"><a href="page.php?mod=nightlife&block=bars">Bars</a></span>
							<li<?php if ($this->_tpl_vars['block'] == 'clubs'): ?> class="on"<?php endif; ?>><span class="clubdisco"><a href="page.php?mod=nightlife&block=clubs">Clubs/Discos</a></span>
						</ul>
					</div>
				</div>
			</div>
			<div class="spacer s8"><!-- --></div>
			<div class="rightmenu m-grey">
				<div class="bg-top">
					<div class="bg-bottom">
						<ul>
							<li><a href="page.php?mod=nightlife&block=bars&action=add">Add a bar review</a>
							<li><a href="page.php?mod=nightlife&block=clubs&action=add">Add a club review</a>
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