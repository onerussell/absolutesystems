<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$supportSiteName|escape} - Administration Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset={$charset}" /> 
<script type="text/javascript" language="JavaScript" src="{$siteAdmin}templates/js/main.js">
</script>
<link href="{$siteAdmin}templates/styles/main.css" rel="StyleSheet" />
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
                &nbsp;&nbsp;<a href="index.php"><font color="#FFFFFF">{$systemLogin}</font></a>
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

                {$main_content}

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