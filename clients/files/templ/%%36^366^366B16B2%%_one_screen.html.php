<?php /* Smarty version 2.6.20, created on 2008-11-25 10:23:49
         compiled from mods/project/_one_screen.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'mods/project/_one_screen.html', 103, false),)), $this); ?>
<script src="<?php echo $this->_tpl_vars['jsDir']; ?>
JsHttpRequest.js" type="text/javascript"></script>
<script language"javascript"  type="text/javascript">
    var ajaxPath = '<?php echo $this->_tpl_vars['siteAdr']; ?>
ajax.php';
</script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
onescreen.js"></script>


<div class="center1" id="topim"><center>
<?php if (! $this->_tpl_vars['UserInfo']): ?>
     <a href="javascript: ShowHideBlock(1);"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['image_dir']; ?>
/<?php echo $this->_tpl_vars['scr']['image']; ?>
" alt="" id="imfull" /></a>
<?php endif; ?>             
  
</center></div>


<div class="container" style="width: 1024px !important;" id="maincont">
	<div class="container-c">
		<div class="wrap">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_logout.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		    <h1><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
">Projects</a> | <?php echo $this->_tpl_vars['pg']['name']; ?>
</h1> 
            

<div style="float:left;">
<h3>

<?php if ($this->_tpl_vars['prev_screen_id']): ?>
<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?sid=<?php echo $this->_tpl_vars['prev_screen_id']; ?>
">&lt;prev&nbsp;&nbsp;&nbsp;</a>
<?php else: ?>
<span style="color:grey">&lt;prev&nbsp;&nbsp;&nbsp;</span>
<?php endif; ?>		

<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
">Overview</a> / <?php if ($this->_tpl_vars['scr_parent']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
/<?php echo $this->_tpl_vars['scr_parent']['olink']; ?>
"><?php echo $this->_tpl_vars['scr_parent']['name']; ?>
</a> / <?php echo $this->_tpl_vars['scr']['name']; ?>
<?php else: ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
/<?php echo $this->_tpl_vars['scr']['olink']; ?>
"><?php echo $this->_tpl_vars['scr']['name']; ?>
</a> / Rev0<?php endif; ?>

<?php if ($this->_tpl_vars['next_screen_id']): ?>
<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?sid=<?php echo $this->_tpl_vars['next_screen_id']; ?>
">&nbsp;&nbsp;&nbsp;next&gt;</a>
<?php else: ?>
<span style="color:grey">&nbsp;&nbsp;&nbsp;next&gt;</span>
<?php endif; ?>		

</h3>
</div>
			<div style="float:right;">
			<h3>

                <?php if ($this->_tpl_vars['previmage'] && $this->_tpl_vars['stop_this']): ?><a href="javascript:void(0);" onclick="_v('old').style.display = ('block' ==  _v('old').style.display) ? 'none' : 'block'; _v('compare').innerHTML = ('block' ==  _v('old').style.display) ? 'hide prev revision' : 'compare with prev revision';"><span id="compare">compare with prev revision</span></a>&nbsp;&nbsp;<?php endif; ?>
		  	    <?php if ($this->_tpl_vars['can_edit'] && $this->_tpl_vars['scr']['must_approve'] && ( 0 == $this->_tpl_vars['UserInfo']['status'] || 2 == $this->_tpl_vars['UserInfo']['status'] )): ?><a href="javascript: if (confirm('Approve screen for client view?')) Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=approve_view_screen&id=<?php echo $this->_tpl_vars['pg']['id']; ?>
&sid=<?php echo $this->_tpl_vars['scr']['id']; ?>
');"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-plus.gif" style="vertical-align: middle;" alt="" /> Approve</a>&nbsp;&nbsp;&nbsp;<?php endif; ?>
			    <?php if ($this->_tpl_vars['can_edit'] && ( 1 != $this->_tpl_vars['UserInfo']['status'] )): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=add_screen&amp;id=<?php echo $this->_tpl_vars['pg']['id']; ?>
&amp;sid=<?php echo $this->_tpl_vars['scr']['id']; ?>
&amp;back=<?php echo $this->_tpl_vars['scr']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-edit.gif" style="vertical-align: middle;" alt="" /> Edit</a>&nbsp;&nbsp;&nbsp;<?php endif; ?>
			    <?php if ($this->_tpl_vars['can_edit'] && ( 0 == $this->_tpl_vars['UserInfo']['status'] || 2 == $this->_tpl_vars['UserInfo']['status'] )): ?><a href="javascript: if (confirm('Delete screen?')) Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=del_screen&sid=<?php echo $this->_tpl_vars['scr']['id']; ?>
')"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-delete.gif" style="vertical-align: middle;" alt="" /> Del</a><?php endif; ?>

			</h3>

</div>
						
            <?php if (! $this->_tpl_vars['UserInfo']): ?>
                <div class="hidden"><center><a href="#"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['image_dir']; ?>
/<?php echo $this->_tpl_vars['scr']['image']; ?>
" alt="" /></a></center></div>
            <?php else: ?>
			     <br /><br />
				 <center>
				 <div id="iout" ></div> 
                 <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
swfobject.js"></script>	     
                 <script type="text/javascript">
	             var so = new SWFObject("<?php echo $this->_tpl_vars['siteAdr']; ?>
map/VisualComments.swf", "iout", "<?php echo $this->_tpl_vars['imsize']['0']; ?>
", "<?php echo $this->_tpl_vars['imsize']['1']; ?>
", "8", "#FFFFFF");
                 so.addVariable("screen_id", "<?php echo $this->_tpl_vars['scr']['id']; ?>
");
                 so.addVariable("image_path", "http://<?php echo $this->_tpl_vars['DOMEN']; ?>
<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['image_dir']; ?>
/<?php echo $this->_tpl_vars['scr']['image']; ?>
");
	             <?php if ($this->_tpl_vars['vis_comment_id']): ?>so.addVariable("selected_comment_id", "<?php echo $this->_tpl_vars['vis_comment_id']; ?>
");<?php endif; ?>
				 so.useExpressInstall('<?php echo $this->_tpl_vars['siteAdr']; ?>
map/expressinstall.swf');
	             so.write("iout");
                 </script>
				 </center>
			<?php endif; ?>

            <div class="spacer s15"><!-- --></div>
            <div class="spacer s10"><!-- --></div>
			<div class="fr"><h3><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
/<?php if ($this->_tpl_vars['scr_parent']): ?><?php echo $this->_tpl_vars['scr_parent']['olink']; ?>
<?php else: ?><?php echo $this->_tpl_vars['scr']['olink']; ?>
<?php endif; ?>">View history</a> &nbsp; <?php if (1 != $this->_tpl_vars['UserInfo']['status'] && ( '0' <= $this->_tpl_vars['UserInfo']['status'] && '10' >= $this->_tpl_vars['UserInfo']['status'] )): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=add_screen&amp;id=<?php echo $this->_tpl_vars['pg']['id']; ?>
&amp;parent=<?php if ($this->_tpl_vars['scr']['parent'] == 0): ?><?php echo $this->_tpl_vars['scr']['id']; ?>
<?php else: ?><?php echo $this->_tpl_vars['scr']['parent']; ?>
<?php endif; ?>&amp;back=<?php echo $this->_tpl_vars['scr']['id']; ?>
">Upload new version</a><?php endif; ?></h3></div>
			<div class="fl"><h3><a <?php if ($this->_tpl_vars['prevnext']['0']): ?>href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
/<?php echo $this->_tpl_vars['prevnext']['0']; ?>
"<?php endif; ?><?php if (! $this->_tpl_vars['prevnext']['0']): ?> class="off"<?php endif; ?>>&lt; previous</a> &nbsp; <strong><?php if (0 == $this->_tpl_vars['scr']['parent']): ?>Rev0<?php else: ?><?php echo $this->_tpl_vars['scr']['name']; ?>
<?php endif; ?></strong> &nbsp; <a <?php if ($this->_tpl_vars['prevnext']['1']): ?>href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
/<?php echo $this->_tpl_vars['prevnext']['1']; ?>
"<?php endif; ?><?php if (! $this->_tpl_vars['prevnext']['1']): ?> class="off"<?php endif; ?>>next &gt;</a></h3></div>
			<div class="spacer"><!-- --></div>
			
			<?php if (2 >= $this->_tpl_vars['UserInfo']['status'] && ( ! $this->_tpl_vars['scr_aprove'] || $this->_tpl_vars['scr_aprove'] == $this->_tpl_vars['scr']['id'] || 0 == $this->_tpl_vars['UserInfo']['status'] || 2 == $this->_tpl_vars['UserInfo']['status'] )): ?>
			    <?php if ($this->_tpl_vars['can_edit'] && 0 <= $this->_tpl_vars['UserInfo']['status'] && 2 >= $this->_tpl_vars['UserInfo']['status'] && 0 == $this->_tpl_vars['scr']['is_approve']): ?><a href="javascript: if (confirm('Approve screen as final?')) Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=approve_screen&sid=<?php echo $this->_tpl_vars['scr']['id']; ?>
');"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
approve.gif" alt="Final Approve" /></a><?php else: ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
approve_no.gif" alt="Final Approve" /> <?php if ($this->_tpl_vars['can_edit'] && ( 0 == $this->_tpl_vars['UserInfo']['status'] || 2 == $this->_tpl_vars['UserInfo']['status'] )): ?>&nbsp;&nbsp;<a href="javascript: if (confirm('Reverse screen Approval?')) Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=unapprove_screen&sid=<?php echo $this->_tpl_vars['scr']['id']; ?>
')";><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
reverse.gif" alt="Reverse Approval" /></a><?php endif; ?><?php endif; ?>
			<?php endif; ?> 
			<div class="spacer s10"><!-- --></div>
			
			<?php if ($this->_tpl_vars['can_edit']): ?>		
			<a href="#new"><b>&nbsp;Post a new comment</b></a>
			<div class="spacer s10"><!-- --></div>
            <a name="com" />
			
			<?php $_from = $this->_tpl_vars['cl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
			<div class="comment<?php if ($this->_tpl_vars['i']['internal']): ?> comment-h<?php elseif (2 < $this->_tpl_vars['i']['ustatus']): ?> comment-x<?php endif; ?>" id="col_<?php echo $this->_tpl_vars['i']['id']; ?>
">
				<div class="comment-info">
					<div style="float: right" class="com-edit">
					<?php if (( $this->_tpl_vars['UserInfo']['status'] == 0 || $this->_tpl_vars['UserInfo']['status'] == 2 )): ?><a href="javascript: EditCom(<?php echo $this->_tpl_vars['i']['id']; ?>
);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
b_edit.gif" alt="Edit" /> Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript: if (confirm('Delete commentary?')) Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?sid=<?php echo $this->_tpl_vars['scr']['id']; ?>
&del=<?php echo $this->_tpl_vars['i']['id']; ?>
');"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
b_del.gif" alt="Edit" /> Delete</a><?php endif; ?>
					</div>
					<div class="comment-img"><img src="<?php if ($this->_tpl_vars['i']['image']): ?><?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['image_dir']; ?>
/<?php echo $this->_tpl_vars['i']['image']; ?>
<?php else: ?><?php echo $this->_tpl_vars['imgDir']; ?>
i-client_default.png<?php endif; ?>" alt="<?php echo $this->_tpl_vars['i']['name']; ?>
 <?php echo $this->_tpl_vars['i']['lname']; ?>
" /></div>
					<b><?php echo $this->_tpl_vars['i']['login']; ?>
 <?php $this->assign('ov', $this->_tpl_vars['i']['status']); ?>[<?php echo $this->_tpl_vars['status_ar'][$this->_tpl_vars['ov']]; ?>
] wrote</b><br /><?php echo $this->_tpl_vars['i']['pdate']; ?>
 [#<?php echo $this->_tpl_vars['i']['id']; ?>
]
				</div>
				<span id="com_<?php echo $this->_tpl_vars['i']['id']; ?>
">
				<div class="comment-text" >
					<?php echo ((is_array($_tmp=$this->_tpl_vars['i']['descr'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

					<?php if ($this->_tpl_vars['i']['attach']): ?><br /><br /><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-attach.gif" alt="" />&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
files/images/<?php echo $this->_tpl_vars['i']['attach']; ?>
" target="_blank"><?php echo $this->_tpl_vars['i']['attach']; ?>
</a><?php endif; ?>
					<div class="spacer s10"><!-- --></div>
									</div>
				</span>
				<span id="ecom_<?php echo $this->_tpl_vars['i']['id']; ?>
"></span>
				<a name="com_<?php echo $this->_tpl_vars['i']['id']; ?>
" /><?php if (($this->_foreach['n']['iteration'] == $this->_foreach['n']['total'])): ?><a name="last_com" /><?php endif; ?>	
			</div>
			<div class="spacer s10"><!-- --></div>
			<?php endforeach; endif; unset($_from); ?>


            <?php if (( 0 == $this->_tpl_vars['scr']['is_approve'] && 0 == $this->_tpl_vars['scr_aprove'] ) || ( ( $this->_tpl_vars['UserInfo']['status'] == 0 || $this->_tpl_vars['UserInfo']['status'] == 2 ) )): ?>
            <?php if ($this->_tpl_vars['cl']): ?>
			<div class="spacer s10"><!-- --></div>
			<a href="#new"><b>&nbsp;Post a new comment</b></a>
			<div class="spacer s10"><!-- --></div>
            <?php endif; ?>
			<div class="comment">
				<div class="comment-info">
					<div class="comment-img"><img src="<?php if ($this->_tpl_vars['UserInfo']['image']): ?><?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['image_dir']; ?>
/<?php echo $this->_tpl_vars['UserInfo']['image']; ?>
<?php else: ?><?php echo $this->_tpl_vars['imgDir']; ?>
i-client_default.png<?php endif; ?>" alt="<?php echo $this->_tpl_vars['UserInfo']['fname']; ?>
 <?php echo $this->_tpl_vars['UserInfo']['lname']; ?>
" /></div>
					<b><?php echo $this->_tpl_vars['UserInfo']['login']; ?>
 <?php $this->assign('ov', $this->_tpl_vars['UserInfo']['status']); ?>[<?php echo $this->_tpl_vars['status_ar'][$this->_tpl_vars['ov']]; ?>
]</b><br />				</div>
				<div class="comment-edit">
					<form id="fmx" method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php">
					<input type="hidden" name="sid" value="<?php echo $this->_tpl_vars['scr']['id']; ?>
" />
					<input type="hidden" name="action" value="addcom" />
					<a name="new" />
					<span id="errt" style="color:#990000; font-weight: bold"></span>
					<textarea name="eform[comment]" id="comment" onclick="_v('errt').innerHTML ='';"></textarea>
                    <div class="spacer s5"><!-- --></div>
					<div class="spacer s5"><!-- --></div>
					<a href="javascript: ShowAt();" id="al" style="padding-top: 8px;">&nbsp;<b>+ Add file</b>&nbsp;</a>
					<div class="spacer s5"><!-- --></div>
					<div id="main">
				        You need to have the Flash Player installed. Click <a href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash&promoid=BIOW">here</a> 
			        </div>
					<div class="spacer s5"><!-- --></div>	
				    <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
swfobject.js"></script>	
			        <script type="text/javascript">
			            var so1 = new SWFObject("<?php echo $this->_tpl_vars['siteAdr']; ?>
e37uploader.swf?config=<?php echo $this->_tpl_vars['siteAdr']; ?>
e37uploader_at.php", "main", "405", "130", "9", "#FFFFFF");
			            so1.addParam("allowFullScreen", "false");
			            so1.addParam("scale", "noscale");  
			            so1.write("main");
			        </script>	
				  					
					<div class="spacer s5"><!-- --></div>
					<a href="javascript: ComSubm();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
b-submit.gif" alt="Submit" class="v" /></a> &nbsp; &nbsp;<?php if (1 != $this->_tpl_vars['UserInfo']['status']): ?> <input type="checkbox" class="v" name="eform[internal]" value="1" />&nbsp;Internal use<?php endif; ?>
				    </form>
				</div>
			</div>
			<?php endif; ?>
			<?php endif; ?>
			<div class="spacer s10"><!-- --></div>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
</div>

<div id="subcont" style="display: none;" style="vertical-align: middle;">
    <a href="javascript: ShowHideBlock(0);"><img id="imfree" /></a>
</div>
<?php if ($this->_tpl_vars['can_edit']): ?>
<script language="javascript">
    if (_v('main'))
	    _v('main').style.display = 'none';
</script>
<?php endif; ?>