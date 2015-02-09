<?php /* Smarty version 2.6.20, created on 2008-11-26 06:09:51
         compiled from mods/project/_map_view.html */ ?>
<div  style="height:100%;margin-right:6px;margin-left:6px">
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
/map" class="on">sitemap view</a>
	</div>
	<h1><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=project">Projects</a> | <?php echo $this->_tpl_vars['pg']['name']; ?>
</h1>
		<div id="main" style="height:88%">
		  You need to have the Flash Player installed. Click here to download the Flash Player.
	</div>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
swfobject.js"></script>	
	<script type="text/javascript">
	   var so = new SWFObject("<?php echo $this->_tpl_vars['siteAdr']; ?>
map/Sitemap.swf", "main", "100%", "100%", "8", "#FFFFFF");
	   so.addVariable("project_id", <?php echo $this->_tpl_vars['pg']['id']; ?>
);
	   so.addVariable("path_to_xml", "http://www.engine37.com<?php echo $this->_tpl_vars['siteAdr']; ?>
gxml.php?id=");
	   so.useExpressInstall('<?php echo $this->_tpl_vars['siteAdr']; ?>
map/expressinstall.swf');
	   so.write("main");
	</script>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>