<?php /* Smarty version 2.6.12, created on 2006-05-09 23:13:12
         compiled from main_template.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'main_template.tpl', 4, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo ((is_array($_tmp=$this->_tpl_vars['supportSiteName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 - Administration Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['charset']; ?>
" /> 
<script type="text/javascript" language="JavaScript" src="<?php echo $this->_tpl_vars['siteAdmin']; ?>
templates/js/main.js">
</script>
<link href="<?php echo $this->_tpl_vars['siteAdmin']; ?>
templates/styles/main.css" rel="StyleSheet" />
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table cellpadding="0" cellspacing="0" width="100%" height="100%">
<td bgcolor="#666666" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <td width="100%" bgcolor="#FFFFFF">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="PageHeaderCell">
                <h1><font color="#FFFFFF">&nbsp;Administration Panel</font></h1>
                &nbsp;&nbsp;<a href="index.php"><font color="#FFFFFF"><?php echo $this->_tpl_vars['systemLogin']; ?>
</font></a>
                &nbsp;&nbsp;|&nbsp;&nbsp;<a href="exit.php"><font color="#FFFFFF">Exit</font></a>
                </td>
            </tr>
            <tr>
                <td class="PageHeaderCell" style="BACKGROUND-COLOR: gainsboro" noWrap>
                </td>       
            </tr>

            <tr>
                <td nowrap style="BACKGROUND-COLOR: white">
                 <table cellspacing="0" cellpadding="0" width="100%" border="0">

                 <tr>
                 <td height="400" valign="top" width="100"> 

                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td rowspan="2" width="15"></td>
                            <td height="2"></td></tr>
                          <tr> 
                            <td>
                            <br />
                            <b><font color="#666666">Users:</font></b><br />
                                &#8226;&nbsp;<a href="users.php">Catalog</a><br />
                                &#8226;&nbsp;<a href="spages.php">Pages</a><br />
                                &#8226;&nbsp;<a href="mpimg.php">Main page image</a><br />
                                <br />
                            <b><font color="#666666">Tools:</font></b><br />
                                &#8226;&nbsp;<a href="configure.php">Configuration</a><br />
                                &#8226;&nbsp;<a href="opt.php">Options</a><br />
                                &#8226;&nbsp;<a href="history.php">History</a><br />

                            <br />
                        </td>
                          </tr>
                        </table>
                    
                     </td>
                 <td width="15"></td>
                 <td valign="top"> 

                <?php echo $this->_tpl_vars['main_content']; ?>


                 </td>
                 </tr>
             
                 </table>   
<div align="center" style="margin-bottom:4px">
 <hr width="99%" noShade size="1" align="center" />
&copy; THEFROGHOUSE.NET, 2006
</div>
                </td>
            </tr>
        </table>

    </td>
</table>
</body>
</html> 