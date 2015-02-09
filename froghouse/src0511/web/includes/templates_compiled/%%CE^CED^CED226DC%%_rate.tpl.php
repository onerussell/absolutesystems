<?php /* Smarty version 2.6.12, created on 2006-05-02 15:56:53
         compiled from mods/nightlife/_rate.tpl */ ?>
<input type="hidden" name="rate" id="rt" value="<?php if ($this->_tpl_vars['inf']['rate'] && $this->_tpl_vars['action'] <> ''):  echo $this->_tpl_vars['inf']['rate'];  else: ?>1<?php endif; ?>" />
<?php echo '
<script>
<!--
function Sim(id)
{
    document.getElementById(\'rt\').value = id;

    if (id >1)
        document.getElementById(\'i2\').src=img[0].src;
    else
        document.getElementById(\'i2\').src=img[1].src;

    if (id >2)
        document.getElementById(\'i3\').src=img[0].src;
    else
        document.getElementById(\'i3\').src=img[1].src;

    if (id >3)
        document.getElementById(\'i4\').src=img[0].src;
    else
        document.getElementById(\'i4\').src=img[1].src;

    if (id >4)
        document.getElementById(\'i5\').src=img[0].src;
    else
        document.getElementById(\'i5\').src=img[1].src;
}

var img = new Array(2); //array to hold the images
 if(document.images) //pre-load all the images
 {
'; ?>

     img[0] = new Image();
     img[0].src = "<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/frog-x.gif";

     img[1] = new Image();
     img[1].src = "<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/frog-y.gif";
<?php echo '
 }
//-->
</script>
'; ?>

<a href="#" onclick="Sim(1);return false;"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/frog-x.gif" id="i1" /></a>
<a href="#" onclick="Sim(2);return false;"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/frog-<?php if ($this->_tpl_vars['inf']['rate'] > 1 && $this->_tpl_vars['action'] <> ''): ?>x<?php else: ?>y<?php endif; ?>.gif" id="i2" /></a>
<a href="#" onclick="Sim(3);return false;"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/frog-<?php if ($this->_tpl_vars['inf']['rate'] > 2 && $this->_tpl_vars['action'] <> ''): ?>x<?php else: ?>y<?php endif; ?>.gif" id="i3" /></a>
<a href="#" onclick="Sim(4);return false;"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/frog-<?php if ($this->_tpl_vars['inf']['rate'] > 3 && $this->_tpl_vars['action'] <> ''): ?>x<?php else: ?>y<?php endif; ?>.gif" id="i4" /></a>
<a href="#" onclick="Sim(5);return false;"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/frog-<?php if ($this->_tpl_vars['inf']['rate'] > 4 && $this->_tpl_vars['action'] <> ''): ?>x<?php else: ?>y<?php endif; ?>.gif" id="i5" /></a>