<?php /* Smarty version 2.6.12, created on 2006-05-02 13:14:50
         compiled from mods/nightlife/_search.tpl */ ?>
			<div class="spacer s8"><!-- --></div>
			<div class="rightmenu m-grey">
				<div class="bg-top">
					<div class="bg-bottom">
						<div class="left-search">Quick search
                            <form name="f1" method="get">
							<input type="hidden" name="mod" value="<?php echo $this->_tpl_vars['mod']; ?>
" />							

							<input type="hidden" name="action" value="search" />							
							<div class="spacer s8"><!-- --></div>
                                <div class="inp"><input type="text" name="sstr" value="<?php echo $this->_tpl_vars['sstr']; ?>
" /></div>
                                <div class="but"><a href="#" onclick="document.f1.submit();return false;"><img src="includes/templates/images/b-search.gif" width="26" height="22" alt="Search"></a></div>
                            <div class="spacer s15"><!-- --></div>
							</form>
						</div>
					</div>
				</div>
			</div>