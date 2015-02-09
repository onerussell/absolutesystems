	<div class="maincontainer">
       
	   {include file="mods/food/_left_menu.tpl"}
		
		<div class="rightpart">
			{section name = j loop = $list}
			<div class="title-block"><div>Recent {$list[j].title} Reviews</div></div>
			<div class="block">
				<div class="pad">
					{section name = i loop = $list[j].pd}
					<div class="item">
						<div class="name"><a href="{$list[j].pd[i].link}">{$list[j].pd[i].title}</a></div>
						<div class="frog"><img src="{$siteAdr}includes/templates/images/frog-{$list[j].pd[i].rate}.gif" alt=""></div>
						<div class="comm"><a href="{$list[j].pd[i].link}">{if $list[j].pd[i].pcnt == 0}{#nocomments#}{else}{$list[j].pd[i].pcnt} {#comments#}{/if}</a></div>
						<div class="spacer"><!-- --></div>
					</div>
					<div class="spacer s9"><!-- --></div>
                    {/section}

					<div class="link"><a href="{$list[j].link}">View all {$list[j].title|lower} reviews ({$list[j].cnt})</a></div>
				</div>
			</div>

			<div class="spacer s8"><!-- --></div>
            {/section}
		</div>

	<div class="spacer"><!-- --></div>
	</div>