<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>e37 notification</title>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" /> 
{if $link}Link: <a href="{$link}">{$link}</a>{/if}</br>
IP: <a href="http://ip-lookup.net/?ip={$IP}">{$IP}</a></br>
<br />
<div style="background:#FAFAD2;width:500px">
{$comment|nl2br}
</div>
