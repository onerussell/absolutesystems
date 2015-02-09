		<div class="leftpart">
			<div class="rightmenu m-green">
				<div class="bg-top">
					<div class="bg-bottom">
						<ul class="me-menu">
							<li{if $block == ''} class="on"{/if}><span class="overview"><a href="page.php?mod=nightlife">Overview</a></span>
							<li{if $block == 'bars'} class="on"{/if}><span class="bars"><a href="page.php?mod=nightlife&block=bars">Bars</a></span>
							<li{if $block == 'clubs'} class="on"{/if}><span class="clubdisco"><a href="page.php?mod=nightlife&block=clubs">Clubs/Discos</a></span>
						</ul>
					</div>
				</div>
			</div>
			<div class="spacer s8"><!-- --></div>
			<div class="rightmenu m-grey">
				<div class="bg-top">
					<div class="bg-bottom">
						<ul>
							<li><a href="page.php?mod=nightlife&block=bars&action=add">Add a bar review</a>
							<li><a href="page.php?mod=nightlife&block=clubs&action=add">Add a club review</a>
						</ul>
					</div>
				</div>
			</div>
            {include file="mods/nightlife/_search.tpl"}
		</div>
