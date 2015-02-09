	<div class="maincontainer">

	   {include file="mods/food/_left_menu.tpl"}

   	    <div class="rightpart">
			<div class="title-block"><div>{$bl_inf.c1} Reviews</div></div>
			<div class="block">
				<div class="padd">
					<div class="link linkpad"><div class="left"><div class="b"><a href="{$lsort[0]}" {if $psort == '1a' || $psort == '1b'}style="color:#677569"{/if}>Recent</a></div>
					                                            <div class="bs"><a href="{$lsort[1]}"{if $psort == '2a' || $psort == '2b'}style="color:#677569"{/if}>By Rank</a></div>
																<div><a href="{$lsort[2]}"{if $psort == '3a' || $psort == '3b'}style="color:#677569"{/if}>All</a></div></div>{$_pagging}</div>
					<div class="spacer s9"><!-- --></div>
				<div class="paddl">
                   {section name = i loop = $list}
					<div class="item">
						<div class="name"><a href="{$list[i].link}">{$list[i].title}</a></div>
						<div class="frog"><img src="{$siteAdr}includes/templates/images/frog-{$list[i].rate}.gif" alt=""></div>
						<div class="comm"><a href="{$list[i].link}">{if $list[i].pcnt == 0}{#nocomments#}{else}{$list[i].pcnt} {#comments#}{/if}</a></div>
						<div class="spacer"><!-- --></div>
					</div>
					<div class="spacer s9"><!-- --></div>
				   {/section}
				</div>
					<div class="link linkpad">{$_pagging}</div>
				</div>
			</div>

		</div>

	<div class="spacer"><!-- --></div>
	</div>
