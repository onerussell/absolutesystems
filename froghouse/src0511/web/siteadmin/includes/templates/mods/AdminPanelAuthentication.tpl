<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>{$supportSiteName|escape} - Administration Panel - Authentication</title>
<meta http-equiv="Content-Type" content="text/HTML; charset={$charset}" /> 
<style>input {literal}{
    border-right: #006699 1px outset; border-top: #006699 1px outset; font: 8pt verdana; border-left: #006699 1px outset; border-bottom: #006699 1px outset
}
select {
    border-right: #006699 1px outset; border-top: #006699 1px outset; font: 8pt verdana; border-left: #006699 1px outset; border-bottom: #006699 1px outset
}
textarea {
    border-right: #006699 1px outset; border-top: #006699 1px outset; font: 8pt verdana; border-left: #006699 1px outset; border-bottom: #006699 1px outset
}
a {
    color: #4f76b3; text-decoration: none
}
a:hover {
    color: #4f76b3; text-decoration: none
}
a:active {
    color: #4f76b3; text-decoration: none
}
a:visited {
    color: #4f76b3; text-decoration: none
}
body {
    font: 11px verdana
}
td {
    font: 11px verdana
}{/literal}
</style>
</head>
<body bgColor="#ffffff" leftMargin="50" rightMargin="50" marginwidth="50" marginheight="50" onLoad="window.defaultStatus='Authentification'">
<br /><br /><br /><br /><br /><br /><br />
<center>
{if $authMessage}
<p><font color="red">
{$authMessage}
</font></p>
{/if}
<form action="{$curScriptName}" method="post" enctype="application/x-www-form-urlencoded">
<input type="hidden" name="redirectLocation" value="{$redirectLocation|escape:"quotes"}" />
<table cellSpacing="1" cellPadding="6" align="center" bgColor="#c0c0c0" border="0">
  <tbody><tr bgColor="#ffffff">
    <td width="40%">Login:</td>
    <td align="center" width="60%"><input maxLength="21" name="system_login" value="{$systemLogin}" /></td></tr>
  <tr bgColor="#ffffff">
    <td width="40%">Password:</td>
    <td align="center" width="60%"><input type="password" maxLength="21" name="system_pass" value="" /></td></tr>
  <tr bgColor="#ffffff">
    <td align="center" colSpan="2"><br /><input type="submit" value=" enter " /><br /><br /></td></tr></tbody></table></form>

</center><br /><br /></body></html>
