<?php /* Smarty version 2.6.20, created on 2008-11-25 10:18:32
         compiled from mods/project/_work_view.html */ ?>
<style type="text/css">
<?php echo '
	ul.boxy li { margin: 0px; }

	#boxes {
		font-family: Arial, sans-serif;
		list-style-type: none;
		margin: 0px;
		padding: 0px;
		width: 100%;
	}
	#boxes li {
		position: relative;
		float: left;
		margin: 4px 8px 8px 4px;
		width: 200px;
		height: 275px;
		border: 1px solid #CCC;
		text-align: center;
		padding-top: 5px;
		background-color: #eeeeff;
		overflow: hidden;

	}

	#popupbox {
		display:none;
		border:1px solid #676767;
		opacity:.8;
		filter:alpha(opacity=80);
		zoom:1;
		background-color:#eeeeff;
	}

	.handle {
		cursor: move;
		height: 100%;
		border-width: 0px 0px 1px 0px;
		color: #eee;
		padding: 0px 0px;
		margin: 0px;
	}


'; ?>

</style>

<script language="JavaScript" type="text/javascript" src="/sandbox/e37project/includes/templates/js/org/tool-man/core.js"></script>
<script language="JavaScript" type="text/javascript" src="/sandbox/e37project/includes/templates/js/org/tool-man/events.js"></script>
<script language="JavaScript" type="text/javascript" src="/sandbox/e37project/includes/templates/js/org/tool-man/css.js"></script>
<script language="JavaScript" type="text/javascript" src="/sandbox/e37project/includes/templates/js/org/tool-man/coordinates.js"></script>
<script language="JavaScript" type="text/javascript" src="/sandbox/e37project/includes/templates/js/org/tool-man/drag.js"></script>
<script language="JavaScript" type="text/javascript" src="/sandbox/e37project/includes/templates/js/org/tool-man/dragsort.js"></script>
<script language="JavaScript" type="text/javascript" src="/sandbox/e37project/includes/templates/js/org/tool-man/cookies.js"></script>

<script language="JavaScript" type="text/javascript">
<?php echo '
	var dragsort = ToolMan.dragsort()
	var junkdrawer = ToolMan.junkdrawer()

	window.onload = function() {
		junkdrawer.restoreListOrder("boxes");
		dragsort.makeListSortable(document.getElementById("boxes"), setHandle);
	}

	function setHandle(item) {
		item.toolManDragGroup.setHandle(findHandle(item))
	}

	function findHandle(item) {
		var children = item.getElementsByTagName("div")
		for (var i = 0; i < children.length; i++) {
			var child = children[i]

			if (child.getAttribute("class") == null) continue

			if (child.getAttribute("class").indexOf("handle") >= 0)
			return child
		}
	return item
	}
'; ?>

</script>

<?php if (( '1' == $this->_tpl_vars['UserInfo']['status'] ) || ! $this->_tpl_vars['UserInfo']): ?>

<div id="popupbox" class="popupbox">
	Sorry, you do not have permission to be able to save the changed order of screens.&nbsp;|&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?id=<?php echo $this->_tpl_vars['pg']['id']; ?>
">Close</a>
</div>

<?php else: ?>

<div id="popupbox" class="popupbox">
  <a href="#" onclick="window.location.href='<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=save_order&id=<?php echo $this->_tpl_vars['pg']['id']; ?>
&neworder='+junkdrawer.serializeList(document.getElementById('boxes'))"/>Save Order</a> |
  <a href="#" onclick="window.location.href='<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?id=<?php echo $this->_tpl_vars['pg']['id']; ?>
'">Cancel</a>
</div>

<?php endif; ?>


		<div  style="position:relative; height:75px;padding: 10px 10px 10px 10px;">

			<div style="font-weight: bold;font-size: 12px; position:absolute;top:5px;right:90px;width:50px;">
			<?php if ($this->_tpl_vars['system_login']): ?>
				<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?logout=1">Log Out</a>
			<?php else: ?>
				<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php">Sign In</a>
			<?php endif; ?>
			</div>

			<div style="position:absolute;top:0px; left:20px; margin:0;">
				<h1><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
">Projects</a> | <?php echo $this->_tpl_vars['pg']['name']; ?>
 (<?php echo $this->_tpl_vars['number_of_screens']; ?>
/<?php echo $this->_tpl_vars['number_of_revisions']; ?>
)</h1>
			</div>

			<div class="admin-list-func" style="position:absolute;top:55px; left:10px; margin:0;">
				<?php if (( '1' != $this->_tpl_vars['UserInfo']['status'] && $this->_tpl_vars['UserInfo'] )): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=add_screen&id=<?php echo $this->_tpl_vars['pg']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-plus.gif" alt="Add Screen" />Add Screen</a><?php endif; ?>
			</div>	


		    <div style="font-weight: bold; font-size: 18px; position:absolute;top:30px;right:90px;width:350px">
				<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
" style="color: #DADAE0 !important;">work view</a>&nbsp;&nbsp;&nbsp;
				<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
/history">history view</a>&nbsp;&nbsp;
				<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
/map">sitemap view</a>
			</div>

			<div style="font-weight: bold; font-size: 14px; position:absolute;top:65px;right:90px;width:120px;">
			    <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
"><?php if (! $this->_tpl_vars['list']): ?><b>Thumbnails</b><?php else: ?>Thumbnails<?php endif; ?></a> | <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
?list=1"><?php if ($this->_tpl_vars['list']): ?><b>List</b><?php else: ?>List<?php endif; ?></a>
			</div>

		</div>	

		<div style="padding: 10px 10px 10px 10px;float:left;text-align: left; ">
			<?php if ($this->_tpl_vars['list']): ?>
			    
				<?php $_from = $this->_tpl_vars['pl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
				    <div class="main-listx main-list<?php if (($this->_foreach['n']['iteration']-1) % 2 == 0): ?>-bg<?php endif; ?>">
					    <?php if (( $this->_tpl_vars['UserInfo']['status'] == '0' || $this->_tpl_vars['UserInfo']['status'] == '2' )): ?>
						<div style="float:left; width: 50px; margin-top: 5px;">
						    <?php if (($this->_foreach['n']['iteration'] <= 1)): ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
btn_up.gif" alt="" /><?php else: ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
?list=1&amp;down=<?php echo $this->_tpl_vars['i']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
btn_up_a.gif" alt="" /></a><?php endif; ?><?php if (($this->_foreach['n']['iteration'] == $this->_foreach['n']['total'])): ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
btn_down.gif" alt="" /><?php else: ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
?list=1&amp;up=<?php echo $this->_tpl_vars['i']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
btn_down_a.gif" alt="" /></a><?php endif; ?>
						</div>
						<?php endif; ?>
						<div style="float:left;  width: 450px; margin-top: 5px;"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
/<?php if ($this->_tpl_vars['i']['nid']): ?><?php echo $this->_tpl_vars['i']['nlink']; ?>
<?php else: ?><?php echo $this->_tpl_vars['i']['link']; ?>
<?php endif; ?>" style="color:#3E9ADE;"><b><?php echo $this->_tpl_vars['i']['name']; ?>
</b></a><?php if (( '' == $this->_tpl_vars['i']['mparent'] || '0' == $this->_tpl_vars['i']['mparent'] ) && ( '0' == $this->_tpl_vars['UserInfo']['status'] || 2 <= $this->_tpl_vars['UserInfo']['status'] )): ?> <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
map.gif" alt="" /><?php endif; ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
/<?php echo $this->_tpl_vars['i']['olink']; ?>
">View history<?php if ($this->_tpl_vars['i']['screen_count']): ?> (<?php echo $this->_tpl_vars['i']['screen_count']; ?>
)<?php endif; ?></a> <?php if ($this->_tpl_vars['i']['html']): ?>[<a href="<?php echo $this->_tpl_vars['HTTP_HTML_DIR']; ?>
<?php echo $this->_tpl_vars['i']['html']; ?>
" style="color: red;" target="_blank">HTML</a>]<?php endif; ?></div>
					    <div style="float:right; margin-top: 5px;"><?php if ($this->_tpl_vars['i']['npdate']): ?><?php echo $this->_tpl_vars['i']['npdate']; ?>
<?php else: ?><?php echo $this->_tpl_vars['i']['pdate']; ?>
<?php endif; ?></div>
					</div>
				<?php endforeach; endif; unset($_from); ?>
				
			<?php else: ?>

			<ul id="boxes">
			    <?php $_from = $this->_tpl_vars['pl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
			    <?php $this->assign('ov', ($this->_foreach['n']['iteration']-1)+1); ?>
			    <li itemID=<?php echo $this->_tpl_vars['i']['id']; ?>
>
			    <div class="screen-list">
			       <div class="handle">
				    <h4><b><?php echo $this->_tpl_vars['i']['name']; ?>
</b></h4>
				   </div>
					<a href="http://www.engine37.com<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
/<?php if ($this->_tpl_vars['i']['nid']): ?><?php echo $this->_tpl_vars['i']['nlink']; ?>
<?php else: ?><?php echo $this->_tpl_vars['i']['link']; ?>
<?php endif; ?>" >
						<img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['image_dir']; ?>
<?php if ($this->_tpl_vars['i']['nid']): ?><?php if ($this->_tpl_vars['i']['nis_approve']): ?><?php echo $this->_tpl_vars['resize_dir_ok']; ?>
<?php elseif ($this->_tpl_vars['i']['nis_new']): ?><?php echo $this->_tpl_vars['resize_dir_new']; ?>
<?php else: ?><?php echo $this->_tpl_vars['resize_dir']; ?>
<?php endif; ?><?php else: ?><?php if ($this->_tpl_vars['i']['is_approve']): ?><?php echo $this->_tpl_vars['resize_dir_ok']; ?>
<?php elseif ($this->_tpl_vars['i']['is_new']): ?><?php echo $this->_tpl_vars['resize_dir_new']; ?>
<?php else: ?><?php echo $this->_tpl_vars['resize_dir']; ?>
<?php endif; ?><?php endif; ?>/m_<?php if ($this->_tpl_vars['i']['nimage']): ?><?php echo $this->_tpl_vars['i']['nimage']; ?>
<?php else: ?><?php echo $this->_tpl_vars['i']['image']; ?>
<?php endif; ?>">
					</a>	
				    <div class="comm"><?php if ($this->_tpl_vars['i']['npdate']): ?><?php echo $this->_tpl_vars['i']['npdate']; ?>
<?php else: ?><?php echo $this->_tpl_vars['i']['pdate']; ?>
<?php endif; ?><br /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php<?php if ($this->_tpl_vars['can_edit']): ?>?sid=<?php if ($this->_tpl_vars['i']['nid']): ?><?php echo $this->_tpl_vars['i']['nid']; ?>
<?php else: ?><?php echo $this->_tpl_vars['i']['id']; ?>
<?php endif; ?>#com<?php endif; ?>"><?php if ($this->_tpl_vars['can_edit'] && 1 != $this->_tpl_vars['UserInfo']['status']): ?> <?php if ($this->_tpl_vars['i']['nid']): ?><?php echo $this->_tpl_vars['i']['ncomcnt']; ?>
 comment<?php if (1 != $this->_tpl_vars['i']['ncomcnt']): ?>s<?php endif; ?> <?php else: ?> <?php echo $this->_tpl_vars['i']['comcnt']; ?>
 comment<?php if (1 != $this->_tpl_vars['i']['comcnt']): ?>s<?php endif; ?><?php endif; ?> <?php else: ?> <?php if ($this->_tpl_vars['i']['nid']): ?><?php echo $this->_tpl_vars['i']['nclmcnt']; ?>
 comment<?php if (1 != $this->_tpl_vars['i']['nclmcnt']): ?>s<?php endif; ?> <?php else: ?> <?php echo $this->_tpl_vars['i']['clmcnt']; ?>
 comment<?php if (1 != $this->_tpl_vars['i']['clmcnt']): ?>s<?php endif; ?><?php endif; ?> <?php endif; ?></a> | <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php<?php if ($this->_tpl_vars['can_edit']): ?>?sid=<?php if ($this->_tpl_vars['i']['nid']): ?><?php echo $this->_tpl_vars['i']['nid']; ?>
<?php else: ?><?php echo $this->_tpl_vars['i']['id']; ?>
<?php endif; ?>#new<?php endif; ?>">Add comment</a>
					</div>
				    <div class="up"><?php if ($this->_tpl_vars['UserInfo']['status'] != 1): ?>
						<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=add_screen&amp;parent=<?php echo $this->_tpl_vars['i']['id']; ?>
&amp;id=<?php echo $this->_tpl_vars['pg']['id']; ?>
">Upload new version</a><br /><?php endif; ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
/<?php echo $this->_tpl_vars['i']['olink']; ?>
">View history<?php if ($this->_tpl_vars['i']['screen_count']): ?> (<?php echo $this->_tpl_vars['i']['screen_count']; ?>
)<?php endif; ?></a>
					</div>
				    </div>
   			   </li>
			    <?php endforeach; else: ?>
			    no updates yet
			    <?php endif; unset($_from); ?>
             </ul>
			<?php endif; ?>

			<div class="spacer s15"><!-- --></div>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
