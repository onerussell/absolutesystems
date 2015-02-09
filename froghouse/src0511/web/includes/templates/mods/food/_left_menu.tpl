		<div class="leftpart">

			<div class="rightmenu m-green">
				<div class="bg-top">
					<div class="bg-bottom">
						<ul class="me-menu">
							<li{if $block == ''} class="on"{/if}><span class="overview"><a href="{$siteAdr}page.php?mod={$mod}">Overview</a></span>
							<li{if $block == 'quick'} class="on"{/if}><span class="quicke"><a href="{$siteAdr}page.php?mod={$mod}&block=quick">Quick Eats</a></span>
							<li{if $block == 'sitdown'} class="on"{/if}><span class="sitdown"><a href="{$siteAdr}page.php?mod={$mod}&block=sitdown">Sit Down Places</a></span>
							<li{if $block == 'coffe'} class="on"{/if}><span class="cofeesh"><a href="{$siteAdr}page.php?mod={$mod}&block=coffe">Coffee Shops</a></span>
							<li{if $block == 'pubs'} class="on"{/if}><span class="pubs"><a href="{$siteAdr}page.php?mod={$mod}&block=pubs">Pubs</a></span>
						</ul>
					</div>
				</div>
			</div>
			<div class="spacer s8"><!-- --></div>
			<div class="rightmenu m-grey">
				<div class="bg-top">
					<div class="bg-bottom">
						<ul>
							<li><a href="{$siteAdr}page.php?mod={$mod}&block=quick&action=add">Add a quick eat review</a>
							<li><a href="{$siteAdr}page.php?mod={$mod}&block=sitdown&action=add">Add a sit down place review</a>
							<li><a href="{$siteAdr}page.php?mod={$mod}&block=coffe&action=add">Add a coffee shop review</a>
							<li><a href="{$siteAdr}page.php?mod={$mod}&block=pubs&action=add">Add a pub review</a>
						</ul>
					</div>
				</div>
			</div>
            {include file="mods/nightlife/_search.tpl"} 
		</div>
