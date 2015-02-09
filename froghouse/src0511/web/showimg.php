<?
if ( !isset($_GET['img']) ) die();

    define('INC_PATH', 'siteadmin/');
    include INC_PATH . 'includes/config/main.php';
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $_GET['img']; ?></title>
<script language="javascript">
    <!--
    var i=0;
    function resize()
    {
        if (document.images[0]) window.resizeTo(document.images[0].width +20, document.images[0].height+60);
        self.focus();
    }
    //-->
</script>
</head>
<body onload="resize();" leftmargin="0" topmargin="0">
<?php echo '<img src="' . DIR_NAME_IMAGE . '/' . $_GET['img'].'">'; ?>
</body>
</html>