                <div class="leftpart">

                        <div class="rightmenu m-green">
                                <div class="bg-top">
                                        <div class="bg-bottom">
                                                <ul class="me-menu">
                                                        <li{if $block == ''} class="on"{/if}><span class="overview"><a href="{$siteAdr}page.php?mod={$mod}">Overview</a></span>
                                                        <li{if $block == 'hostels'} class="on"{/if}><span class="hostels"><a href="{$siteAdr}page.php?mod={$mod}&block=hostels">Hostels</a></span>
                                                        <li{if $block == 'hotels'} class="on"{/if}><span class="hotels"><a href="{$siteAdr}page.php?mod={$mod}&block=hotels">Hotels</a></span>
                                                        <li{if $block == 'apartments'} class="on"{/if}><span class="appart"><a href="{$siteAdr}page.php?mod={$mod}&block=apartments">Apartments</a></span>
                                                        <li{if $block == 'campings'} class="on"{/if}><span class="camp"><a href="{$siteAdr}page.php?mod={$mod}&block=campings">Camping</a></span>
                                                </ul>
                                        </div>
                                </div>
                        </div>
                        <div class="spacer s8"><!-- --></div>
                        <div class="rightmenu m-grey">
                                <div class="bg-top">
                                        <div class="bg-bottom">
                                                <ul>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=hostels&action=add">Add a hostel review</a>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=hotels&action=add">Add a hotel review</a>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=apartments&action=add">Add an apartment review</a>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=campings&action=add">Add a camping review</a>
                                                </ul>
                                        </div>
                                </div>
                        </div>
            {include file="mods/nightlife/_search.tpl"}
                </div>