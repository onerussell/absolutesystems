	<div class="maincontainer">

	   {include file="mods/nightlife/_left_menu.tpl"}

   	    <div class="rightpart">
			<div class="title-block"><div>{$bl_inf.c1} Reviews</div></div>
			<div class="block">
				<div class="padd">
					<div class="link linkpad"><div class="left"><div class="b">Recent</div><div class="bs"><a href="#">By Rank</a></div><div><a href="#">Alphabetical</a></div></div>{$_pagging}</div>
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
