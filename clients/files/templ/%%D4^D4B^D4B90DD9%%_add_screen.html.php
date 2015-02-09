<?php /* Smarty version 2.6.20, created on 2008-11-25 12:35:35
         compiled from mods/project/_add_screen.html */ ?>
<body>
<div class="container">
	<div class="container-c">
		<div class="wrap">
		    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_logout.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<div class="menu-right">
				<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
">work view</a>
				<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
/history">history view</a>
				<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
/map">sitemap view</a>
			</div>
			<h1><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
">Projects</a> | <?php echo $this->_tpl_vars['pg']['name']; ?>
</h1>
			<h3><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
">Overview</a> / <?php if ($this->_tpl_vars['eform']['parent'] || $this->_tpl_vars['parent']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?id=<?php echo $this->_tpl_vars['pg']['id']; ?>
&amp;sc_id=<?php echo $this->_tpl_vars['parinf']['id']; ?>
"><?php echo $this->_tpl_vars['parinf']['name']; ?>
</a>  / Upload new version<?php else: ?>Add screen<?php endif; ?> <?php if ($this->_tpl_vars['sid']): ?> - Edit<?php endif; ?></h3>
           
			<div class="b-form">
				
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
				
			<form name="fmx" id="fmx" method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php" enctype="multipart/form-data">
			<input type="hidden" name="mod" value="add_screen" />
			<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['pg']['id']; ?>
" />
			<?php if ($this->_tpl_vars['sid']): ?>
			<input type="hidden" name="sid" value="<?php echo $this->_tpl_vars['sid']; ?>
" />
			<?php endif; ?>
			<?php if ($this->_tpl_vars['back']): ?>
			<input type="hidden" name="back" value="<?php echo $this->_tpl_vars['back']; ?>
" />
			<?php endif; ?>
			<input type="hidden" name="eform[parent]" value="<?php if ($this->_tpl_vars['eform']['parent']): ?><?php echo $this->_tpl_vars['eform']['parent']; ?>
<?php elseif ($this->_tpl_vars['parent']): ?><?php echo $this->_tpl_vars['parent']; ?>
<?php else: ?>0<?php endif; ?>" />

             
            
			
                <?php if ($this->_tpl_vars['eform']['parent'] || $this->_tpl_vars['parent']): ?>
				    <?php if ($this->_tpl_vars['sid']): ?>
				        <label>Screen name</label>
			            <input type="text" class="input w360" name="eform[pname]" value="<?php echo $this->_tpl_vars['eform']['pname']; ?>
" />
				        <div class="spacer s20"><!-- --></div>	
					<?php else: ?>
					    <input type="hidden" name="eform[name]" value="" />		
			        <?php endif; ?>
				<?php else: ?>
				    <label>Screen name</label>
			        <input type="text" class="input w360" name="eform[name]" value="<?php echo $this->_tpl_vars['eform']['name']; ?>
" />
				    <div class="spacer s20"><!-- --></div>
                <?php endif; ?>
	        
				<?php if ($this->_tpl_vars['sid'] || ( ! ( $this->_tpl_vars['eform']['parent'] || $this->_tpl_vars['parent'] ) && ! $this->_tpl_vars['sid'] )): ?>
				<label>Parent screen (for Site Map)</label>
				<select name="eform[mparent]" class="input w360">				
				<option value="0">---</option>
				<option value="-1"<?php if ($this->_tpl_vars['eform']['mparent'] == -1): ?> selected="selected"<?php endif; ?>>ROOT</option>
				<?php $_from = $this->_tpl_vars['tops']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
				<option value="<?php echo $this->_tpl_vars['i']['id']; ?>
"<?php if ($this->_tpl_vars['eform']['mparent'] == $this->_tpl_vars['i']['id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']['name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
				<div class="spacer s20"><!-- --></div>
                <?php endif; ?>
				  
				<label>File</label>
                  <div id="main">
				      You need to have the Flash Player installed. Click <a href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash&promoid=BIOW">here</a> 
			      </div>	
				  <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
swfobject.js"></script>	
			      <script type="text/javascript">
			          var so1 = new SWFObject("<?php echo $this->_tpl_vars['siteAdr']; ?>
e37uploader.swf?config=<?php echo $this->_tpl_vars['siteAdr']; ?>
e37uploader.php", "main", "405", "130", "9", "#FFFFFF");
			          so1.addParam("allowFullScreen", "false");
			          so1.addParam("scale", "noscale");  
			          so1.write("main");
			      </script>	
				  <?php if ($this->_tpl_vars['sid']): ?><br /><a href="<?php echo $this->_tpl_vars['image_dir']; ?>
/<?php echo $this->_tpl_vars['eform']['image']; ?>
" target="_blank"><?php echo $this->_tpl_vars['eform']['image']; ?>
</a><?php endif; ?>			
								<div class="spacer s20"><!-- --></div>
				<a href="javascript: _v('fmx').submit();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
<?php if ($this->_tpl_vars['sid']): ?>b-update.gif<?php else: ?>b-add.gif<?php endif; ?>" alt="<?php if ($this->_tpl_vars['sid']): ?>Edit<?php else: ?>Add<?php endif; ?>" /></a>
			    &nbsp;&nbsp;<a href="javascript: Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php<?php if ($this->_tpl_vars['eform']['parent']): ?>?id=<?php echo $this->_tpl_vars['eform']['parent']; ?>
<?php $this->assign('tx', 1); ?><?php elseif ($this->_tpl_vars['parent']): ?>?id=<?php echo $this->_tpl_vars['parent']; ?>
<?php $this->assign('tx', 1); ?><?php endif; ?><?php if ($this->_tpl_vars['back']): ?><?php if ($this->_tpl_vars['tx']): ?>&<?php else: ?>?<?php endif; ?>sid=<?php echo $this->_tpl_vars['back']; ?>
<?php endif; ?>');"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
b-cancel.gif" alt="Cancel" /></a>
			</form>
			</div>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
</div>