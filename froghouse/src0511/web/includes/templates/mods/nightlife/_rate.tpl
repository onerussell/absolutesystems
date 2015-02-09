<input type="hidden" name="rate" id="rt" value="{if $inf.rate && $action <> ''}{$inf.rate}{else}1{/if}" />
{literal}
<script>
<!--
function Sim(id)
{
    document.getElementById('rt').value = id;

    if (id >1)
        document.getElementById('i2').src=img[0].src;
    else
        document.getElementById('i2').src=img[1].src;

    if (id >2)
        document.getElementById('i3').src=img[0].src;
    else
        document.getElementById('i3').src=img[1].src;

    if (id >3)
        document.getElementById('i4').src=img[0].src;
    else
        document.getElementById('i4').src=img[1].src;

    if (id >4)
        document.getElementById('i5').src=img[0].src;
    else
        document.getElementById('i5').src=img[1].src;
}

var img = new Array(2); //array to hold the images
 if(document.images) //pre-load all the images
 {
{/literal}
     img[0] = new Image();
     img[0].src = "{$siteAdr}includes/templates/images/frog-x.gif";

     img[1] = new Image();
     img[1].src = "{$siteAdr}includes/templates/images/frog-y.gif";
{literal}
 }
//-->
</script>
{/literal}
<a href="#" onclick="Sim(1);return false;"><img src="{$siteAdr}includes/templates/images/frog-x.gif" id="i1" /></a>
<a href="#" onclick="Sim(2);return false;"><img src="{$siteAdr}includes/templates/images/frog-{if $inf.rate > 1 && $action<> ''}x{else}y{/if}.gif" id="i2" /></a>
<a href="#" onclick="Sim(3);return false;"><img src="{$siteAdr}includes/templates/images/frog-{if $inf.rate > 2 && $action<> ''}x{else}y{/if}.gif" id="i3" /></a>
<a href="#" onclick="Sim(4);return false;"><img src="{$siteAdr}includes/templates/images/frog-{if $inf.rate > 3 && $action<> ''}x{else}y{/if}.gif" id="i4" /></a>
<a href="#" onclick="Sim(5);return false;"><img src="{$siteAdr}includes/templates/images/frog-{if $inf.rate > 4 && $action<> ''}x{else}y{/if}.gif" id="i5" /></a>