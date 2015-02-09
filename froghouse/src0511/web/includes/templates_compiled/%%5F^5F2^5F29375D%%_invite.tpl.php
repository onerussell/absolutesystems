<?php /* Smarty version 2.6.12, created on 2006-05-04 14:32:05
         compiled from mails/_invite.tpl */ ?>
<html>
<head>
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
<?php if (! $this->_tpl_vars['message']): ?>
<p>
    Hi, <?php echo $this->_tpl_vars['friendname']; ?>
! I found this website, <a href="http://www.thefroghouse.net">www.thefroghouse.net</a>, and it's a great
    resource for students going abroad. I would love  it if you joined.
    Please check it out!
</p>
<p>
    Best regards, <a href="mailto:<?php echo $this->_tpl_vars['youremail']; ?>
"><?php echo $this->_tpl_vars['yourname']; ?>
</a>
</p>
<?php else: ?>
<h3>Hello, <?php echo $this->_tpl_vars['friendname']; ?>
!</h3>
<p>
    Hi, Your friend <?php echo $this->_tpl_vars['yourname']; ?>
 thinks http://www.thefroghouse.net is a great resource for students abroad. Click <a href="http://www.thefroghouse.net">HERE</a> to join!
</p>
<p>
    He also wrote the following message for you:</b><br />
    "<?php echo $this->_tpl_vars['message']; ?>
"
</p>
<p><a href="http://www.thefroghouse.net">TheFrogHouse.Net Team</a></p>
<?php endif; ?>
</body>
</html>