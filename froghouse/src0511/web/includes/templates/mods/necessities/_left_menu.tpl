                <div class="leftpart">

                        <div class="rightmenu m-green">
                                <div class="bg-top">
                                        <div class="bg-bottom">
                                                <ul class="me-menu">
                                                        <li{if $block == ''} class="on"{/if}><span class="overview"><a href="{$siteAdr}page.php?mod={$mod}">Overview</a></span>

                                                        <li{if $block == 'money'} class="on"{/if}><span class="money"><a href="{$siteAdr}page.php?mod={$mod}&block=money">Money</a></span>
                                                        <li{if $block == 'health'} class="on"{/if}><span class="health"><a href="{$siteAdr}page.php?mod={$mod}&block=health">Health and Safety</a></span>
                                                        <li{if $block == 'around'} class="on"{/if}><span class="getar"><a href="{$siteAdr}page.php?mod={$mod}&block=around">Getting Around</a></span>
                                                        <li{if $block == 'lingo'} class="on"{/if}><span class="locall"><a href="{$siteAdr}page.php?mod={$mod}&block=lingo">Local Lingo</a></span>
                                                        <li{if $block == 'random'} class="on"{/if}><span class="random"><a href="{$siteAdr}page.php?mod={$mod}&block=random">Random</a></span>
                                                </ul>
                                        </div>
                                </div>
                        </div>
                        <div class="spacer s8"><!-- --></div>
                        <div class="rightmenu m-grey">
                                <div class="bg-top">
                                        <div class="bg-bottom">
                                                <ul>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=money&action=add">Add a money post</a>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=health&action=add">Add a health and safety post</a>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=around&action=add">Add a getting around post</a>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=lingo&action=add">Add a local lingo post</a>
                                                        <li><a href="{$siteAdr}page.php?mod={$mod}&block=random&action=add">Add a random post</a>
                                                </ul>
                                        </div>
                                </div>
                        </div>
            {include file="mods/nightlife/_search.tpl"}
                </div>