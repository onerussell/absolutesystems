<?php /* Smarty version 2.6.12, created on 2006-05-10 00:36:43
         compiled from mails/_send_reg.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'mails/_send_reg.tpl', 77, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['charset']; ?>
" />
<style>
<?php echo '
body {
    font-size: 11px; font-family: verdana, arial, helvetica
}

p {
    font-size: 11px; font-family: verdana, arial, helvetica
}

br {
    font-size: 11px; font-family: verdana, arial, helvetica
}

td {
    font-size: 11px; font-family: verdana, arial, helvetica
}

nobr {
    font-size: 11px; font-family: verdana, arial, helvetica
}

a:link {
    color: steelblue; text-decoration: none
}

a:visited {
    color: steelblue; text-decoration: none
}

a:hover {
    color: #000066; text-decoration: underline
}

h1 {
    font-size: 18px; color: black
}

h2 {
    font-size: 16px; color: black
}

.pageheadercell {
     padding-left: 8px; font-weight: normal; font-size: 11px; padding-bottom: 2px; padding-top: 2px; border-bottom: slategray 1px solid;
     font-family: verdana, arial, helvetica; 
     background-color: 6ea6ce;
}

.head {color: gray;
       font-weight: bold;   
} 

input, textarea {
    color : #1d2f38;
    border : 1px solid #495879;
    background-color : #ffffff;
}
'; ?>

</style>
</head>
<body>
Thank you for registering at <a href="http://www.thefroghouse.net">thefroghouse.net</a>. Your account has been activated. Below is your login/password information. Don't lose it!
<br />
<table border="0" cellpadding="2" cellspacing="2">
<tr align="left" vAlign="middle"> <td>&nbsp;</td> </tr>
<tr align="left" vAlign="middle"> <td><b><?php echo $this->_config[0]['vars']['EMail']; ?>
</b></td>     <td> <?php echo $this->_tpl_vars['UserInfo']['email']; ?>
 </td> </tr>
<tr align="left" vAlign="middle"> <td><b><?php echo $this->_config[0]['vars']['Password']; ?>
</b></td>  <td> <?php echo $this->_tpl_vars['UserInfo']['pass']; ?>
 </td> </tr>
<tr align="left" vAlign="middle"> <td>&nbsp;</td> </tr>
<tr align="left" vAlign="middle"> <td><b>Your personal information</b></td> </tr>
<tr align="left" vAlign="middle"> <td>&nbsp;</td> </tr>
<tr align="left" vAlign="middle"> <td>NickName</td>     <td> <?php echo $this->_tpl_vars['UserInfo']['nickname']; ?>
</td> </tr>
<tr align="left" vAlign="middle"> <td><?php echo $this->_config[0]['vars']['City']; ?>
</td>      <td></td> </tr>
<tr align="left" vAlign="middle"> <td>Abroad Status</td> <td><?php echo $this->_tpl_vars['UserInfo']['abroad_status']; ?>
</td> </tr>
<tr align="left" vAlign="middle"> <td>Birthday</td>  <td><?php echo ((is_array($_tmp=$this->_tpl_vars['UserInfo']['birthday'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d %B %Y") : smarty_modifier_date_format($_tmp, "%d %B %Y")); ?>
  </td> </tr>

<tr align="left" vAlign="middle"> <td><?php echo $this->_config[0]['vars']['FName']; ?>
</td>  <td> <?php echo $this->_tpl_vars['UserInfo']['fname']; ?>
 </td> </tr>
<tr align="left" vAlign="middle"> <td><?php echo $this->_config[0]['vars']['MName']; ?>
</td>  <td> <?php echo $this->_tpl_vars['UserInfo']['mname']; ?>
 </td> </tr>

<tr align="left" vAlign="middle"> <td>Originally from</td>  <td> <?php echo $this->_tpl_vars['UserInfo']['originally_from']; ?>
</td> </tr>
<tr align="left" vAlign="middle"> <td>Here for</td>         <td> <?php echo $this->_tpl_vars['UserInfo']['here_for']; ?>
</td> </tr>
<tr align="left" vAlign="middle"> <td>Home university</td>  <td> <?php echo $this->_tpl_vars['UserInfo']['uni_home']; ?>
</td> </tr>
<tr align="left" vAlign="middle"> <td>Host univercity</td>  <td> <?php echo $this->_tpl_vars['UserInfo']['uni_host']; ?>
</td> </tr>
<tr align="left" vAlign="middle"> <td>Languages</td>        <td> <?php echo $this->_tpl_vars['UserInfo']['languages']; ?>
</td> </tr>
<tr align="left" vAlign="middle"> <td>Cities visited</td>   <td> <?php echo $this->_tpl_vars['UserInfo']['visited_cities']; ?>
</td> </tr>
<tr align="left" vAlign="middle"> <td>Places I'd like to visit</td>  <td> <?php echo $this->_tpl_vars['UserInfo']['like_visit']; ?>
 </td> </tr>

<tr align="left" vAlign="middle"> <td>Relationship status</td> <td><?php echo $this->_tpl_vars['UserInfo']['relation_status']; ?>
</td> </tr>

<tr align="left" vAlign="middle"> <td>Sexual Orientation</td> <td><?php echo $this->_tpl_vars['UserInfo']['sexual_orientation']; ?>
</td> </tr>

<tr align="left" vAlign="middle"> <td>Turn Ons</td> <td><?php echo $this->_tpl_vars['UserInfo']['turn_ons']; ?>
 </td> </tr>

<tr align="left" vAlign="middle"> <td>Turn Offs</td> <td><?php echo $this->_tpl_vars['UserInfo']['turn_offs']; ?>
 </td> </tr>

<tr align="left" vAlign="middle"> <td>Interested In</td> <td><?php echo $this->_tpl_vars['UserInfo']['interested_in']; ?>
 </td> </tr>

<tr align="left" vAlign="middle"> <td>Quote</td> <td><?php echo $this->_tpl_vars['UserInfo']['quote']; ?>
 </td> </tr>

<tr align="left" vAlign="middle"> <td>About me</td> <td><?php echo $this->_tpl_vars['UserInfo']['about_me']; ?>
 </td> </tr>

<tr align="left" vAlign="middle"> <td>Best Travel Story</td> <td><?php echo $this->_tpl_vars['UserInfo']['best_travel_story']; ?>
 </td> </tr>

<tr align="left" vAlign="middle"> <td>Travel Advice</td> <td><?php echo $this->_tpl_vars['UserInfo']['travel_advice']; ?>
 </td> </tr>
</table>
</body>
</html>