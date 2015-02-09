    <div class="maincontainer">
        <div class="leftpart">

            <div class="rightmenu m-grey">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <div class="left-search">Here you can choose other city
                            <div class="spacer s15"><!-- --></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="rightpart">

            {if $iso2_cntr != ''}
            <div class="title-block"><div>Choose City</div></div>
            <div class="block">
                <div class="pad">
                    <div class="city-list">
                    {section name=iic loop=$cities}
                        <img src="{$siteAdr}includes/templates/images/industry.png" alt="" width="32" height="32" border="0" /> &nbsp;{if $UserInfoCurrentCity != $cities[iic].city_id}<a href="{$siteAdr}?mod={$mod}&amp;iso2_cntr={$iso2_cntr}&amp;city_id={$cities[iic].city_id}">{$cities[iic].name}</a>{else}<b>{$cities[iic].name}</b>{/if}<br />
                    {/section}
                    </div>
                </div>
            </div>
            {else}
            <div class="title-block"><div>Choose Country</div></div>
            <div class="block">
                <div class="pad">
                    <div class="city-list">
                    {section name=iic loop=$countries}
                        <img src="{$siteAdr}includes/templates/images/world.png" alt="" width="16" height="16" border="0" /> &nbsp;<a href="{$siteAdr}?mod={$mod}&amp;iso2_cntr={$countries[iic].iso2}">{$countries[iic].name}</a><br />
                    {/section}
                    </div>
                </div>
            </div>
            {/if}


        </div>
    </div>