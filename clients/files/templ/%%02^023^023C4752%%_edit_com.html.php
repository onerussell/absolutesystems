<?php /* Smarty version 2.6.20, created on 2008-11-26 06:29:36
         compiled from mods/project/_edit_com.html */ ?>
                           <div class="comment-edit">
						   <form id="fme">
					       <textarea id="e_comment"><?php echo $this->_tpl_vars['eform']['descr']; ?>
</textarea>
						   <div class="spacer s5"><!-- --></div>
						   <?php if ($this->_tpl_vars['eform']['attach']): ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-attach.gif" alt="" />&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
files/images/<?php echo $this->_tpl_vars['eform']['attach']; ?>
" target="_blank"><?php echo $this->_tpl_vars['eform']['attach']; ?>
</a>&nbsp;&nbsp;<input type="checkbox" id="del_attach" value="1" />&nbsp;Delete attached file<?php endif; ?>
					       <div class="spacer s5"><!-- --></div>
					       <a href="javascript: SaveCom(<?php echo $this->_tpl_vars['eform']['id']; ?>
);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
b-update.gif" alt="Submit" class="v" /></a> &nbsp; &nbsp; <a href="javascript: CancelEdit(<?php echo $this->_tpl_vars['eform']['id']; ?>
);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
b-cancel.gif" alt="Submit" class="v" /></a> &nbsp; &nbsp;<?php if (1 != $this->_tpl_vars['UserInfo']['status']): ?> <input type="checkbox" class="v" id="e_internal" value="1"<?php if ($this->_tpl_vars['eform']['internal']): ?> checked="checked"<?php endif; ?> />&nbsp;Internal use<?php endif; ?>
						   <?php if (( 0 == $this->_tpl_vars['UserInfo']['status'] || 2 == $this->_tpl_vars['UserInfo']['status'] ) && 2 < $this->_tpl_vars['eform']['ustatus']): ?> <input type="checkbox" class="v" id="e_aprove" value="1" />&nbsp;Approve message<?php endif; ?>
				           </form>
						   </div>