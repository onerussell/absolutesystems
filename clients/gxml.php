<?php
    if (empty($nincl))
	{
	    include_once '_top.php';
    }
	echo '<?xml version="1.0" encoding="utf-8"?><sitemap>';
    echo $gPg -> GetScreenTree($id);
    echo '</sitemap>';
?>