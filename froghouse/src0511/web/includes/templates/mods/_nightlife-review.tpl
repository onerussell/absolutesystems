	<div class="maincontainer">

	   {include file="mods/nightlife/_left_menu.tpl"}

 	    <div class="rightpart">

			<div class="title-block"><div>{$inf.title}</div></div>
			<div class="block">
				<div class="pad">
					<div class="rev">
						<div class="pic">
						{if $inf.image <> ''}<a href="{$siteAdr}showimg.php?img={$inf.image}"  onClick="window.open('{$siteAdr}showimg.php?img={$inf.image}','popup','resizable=1,left=0,top=0, width=50, height=50, scrollbars=yes'); return false;"><img src="{$siteAdr}{$imagedir}{if $inf.cached == 1}{$cachedir}{/if}{$inf.image}" border="0" /></a>
						{else}
						<img src="{$siteAdr}includes/templates/images/nf.gif" alt="">
						{/if}
						</div>
						<div class="info">
							<div class="line"><b>Address:</b> {$inf.descr}</div>
							{section name = i loop = $inf.adi}
							<div class="line"><b>{$inf.adi[i].name}{if $inf.adi[i].name <> ''}:{/if}</b> {$inf.adi[i].val}</div>
							{/section}
							<div class="line"><b>Rank:</b> <img src="{$siteAdr}includes/templates/images/frog-{$inf.rate}.gif" alt=""></div>
						</div>
					</div>
					<div class="spacer s9"><!-- --></div>
					<div class="link link-left"><a href="{$inf.link}#addc">Add a new review</a>{if $uadmin}&nbsp;&nbsp;&nbsp;<a href="{$siteAdr}page.php?mod={$mod}&block={$block}&mid={$inf.id}&action=del">Delete </a>&nbsp;&nbsp;&nbsp;<a href="{$siteAdr}page.php?mod={$mod}&block={$block}&mid={$inf.id}&action=add">Edit</a>{/if}</div>
				</div>
			</div>

			<div class="spacer s13"><!-- --></div>

			<div class="title-block"><div>{$inf.title} Reviews</div></div>
			<div class="block">
				<div class="pad">
					{section name = i loop = $list}
					<div class="post">
						<div class="post-item">
							<div class="pic"><a href="{$siteAdr}users/{$list[i].user.nickname}/profile.html">{if $list[i].user_pic.res_image <> ''}<img src="{$siteAdr}includes/data/gallery/{$list[i].user_pic.res_image}" alt="{$list[i].user.nickname}" />
                                            {elseif $list[i].user_pic.name <> ''}<img src="{$siteAdr}includes/data/gallery/{$list[i].user_pic.name}" alt="{$list[i].user.nickname}">{/if}</a></div>
							<div class="text"><span class="name"><a href="{$siteAdr}users/{$list[i].user.nickname}/profile.html">{$list[i].user.nickname}</a> <img src="{$siteAdr}includes/templates/images/frog-{$list[i].rate}.gif" alt="">&nbsp;<br />{$list[i].pdate}</span>{$list[i].descr}
		                    {if $list[i].uid == $uinfo[0] || $uadmin == 1}<div class="links"><a href="{$list[i].link_ed}">Edit {#comment#}</a>&nbsp;|&nbsp;<a href="{$list[i].link_del}">{#tdelete#} {#comment#}</a></div>{/if}
							</div>
						</div>
						<div class="spacer"><!-- --></div>
					</div>
					<div class="spacer s9 bg-grey"><!-- --></div>
					{/section}
					<div class="link linkpad"><div class="left"><div><a href="{$inf.link}#addc">Add a new review</a></div></div>{$_pagging}&nbsp;</div>
				</div>
			</div>

			<div class="spacer s13" id="addc"><!-- --></div>
            {include file="mods/nightlife/_add_comment.tpl"}
		</div>

	<div class="spacer"><!-- --></div>
	</div>
