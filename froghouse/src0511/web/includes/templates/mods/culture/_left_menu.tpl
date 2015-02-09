                <div class="leftpart">

                        <div class="rightmenu m-green">
                                <div class="bg-top">
                                        <div class="bg-bottom">
                                                <ul class="me-menu">
                                                        <li{if $block == ''} class="on"{/if}><span class="overview"><a href="{$siteAdr}page.php?mod={$mod}">Overview</a></span>
                                                        <li{if $block == 'museums'} class="on"{/if}><span class="museums"><a href="{$siteAdr}page.php?mod={$mod}&block=museums">Museums</a></span>
                                                        <li{if $block == 'parks'} class="on"{/if}><span class="parks"><a href="{$siteAdr}page.php?mod={$mod}&block=parks">Parks</a></span>
                                                        <li{if $block == 'fests'} class="on"{/if}><span class="fest"><a href="{$siteAdr}page.php?mod={$mod}&block=fests">Festivals</a></span>
                                                        <li{if $block == 'trips'} class="on"{/if}><span class="dayt"><a href="{$siteAdr}page.php?mod={$mod}&block=trips">Day Trips</a></span>
                                                        <li{if $block == 'live'} class="on"{/if}><span class="livep"><a href="{$siteAdr}page.php?mod={$mod}&block=live">Live Performances</a></span>
                                                        <li{if $block == 'churches'} class="on"{/if}><span class="church"><a href="{$siteAdr}page.php?mod={$mod}&block=churches">Churches</a></span>
                                                        <li{if $block == 'interest'} class="on"{/if}><span class="palcei"><a href="{$siteAdr}page.php?mod={$mod}&block=interest">Places of Interest</a></span>
                                                        <li{if $block == 'shops'} class="on"{/if}><span class="shops"><a href="{$siteAdr}page.php?mod={$mod}&block=shops">Shops</a></span>
                                                </ul>
                                        </div>
                                </div>
                        </div>
                        <div class="spacer s8"><!-- --></div>
                        <div class="rightmenu m-grey">
                                <div class="bg-top">
                                        <div class="bg-bottom">
                                                <ul>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=museums&action=add">Add a museum review</a>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=parks&action=add">Add a park review</a>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=fests&action=add">Add a festival review</a>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=trips&action=add">Add a day trip review</a>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=live&action=add#">Add a live performance review</a>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=churches&action=add">Add a church review</a>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=interest&action=add">Add a place of interest review</a>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=shops&action=add">Add a shop review</a>
                                                </ul>
                                        </div>
                                </div>
                        </div>
                {include file="mods/nightlife/_search.tpl"}
                </div>