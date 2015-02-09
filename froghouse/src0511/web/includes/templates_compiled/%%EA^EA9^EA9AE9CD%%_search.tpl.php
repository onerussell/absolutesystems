<?php /* Smarty version 2.6.12, created on 2006-05-07 05:10:43
         compiled from mods/_search.tpl */ ?>
	<div class="maincontainer">
		<div class="leftpart">

			<div class="rightmenu m-grey">
				<div class="bg-top">
					<div class="bg-bottom">
						<div class="left-search">Quick search
							<div class="spacer s8"><!-- --></div>
							<span>&nbsp;</span>
							<div class="spacer s15"><!-- --></div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="rightpart">

			<div class="title-block"><div>Advanced Search</div></div>
			<div class="block">
				<div class="pad">
					<form name="fs" method="get" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php">
                    <input type="hidden" name="mod" value="search" />
                    <div class="search-form">
						<div class="inp"><input type="text" name="sstr" value="" /></div>
						<div class="sel"><select name="stype"><option value="all">All the words</option><option value="and">AND</option><option value="or">OR</option></select></div>
						<div class="but"><a href="#" onClick="document.fs.submit();"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/b-search.gif" width="26" height="22" alt="Search"></a></div>
						<div class="spacer s15"><!-- --></div>
						<b>Searching in:</b>
						<div class="spacer s9"><!-- --></div>
							<div class="radio"><span><input type="radio" name="where" value="all" checked /></span><span class="name">&nbsp;All</span></div>
							<div class="radio"><span><input type="radio" name="where" value="people" /></span><span class="name">&nbsp;People</span></div>
							<div class="radio"><span><input type="radio" name="where" value="nightlife" /></span><span class="name">&nbsp;Nighlife</span></div>
							<div class="radio"><span><input type="radio" name="where" value="culture" /></span><span class="name">&nbsp;Culture</span></div>
							<div class="radio"><span><input type="radio" name="where" value="food" /></span><span class="name">&nbsp;Food</span></div>
							<div class="radio"><span><input type="radio" name="where" value="lodging" /></span><span class="name">&nbsp;Lodging</span></div>
							<div class="radio bigradio"><span><input type="radio" name="where" value="necessities" /></span><span class="name">&nbsp;Necessities</span></div>
						<div class="spacer s20"><!-- --></div>
					</div>
                    </form>
				</div>
			</div>

		</div>

	<div class="spacer"><!-- --></div>
	</div>