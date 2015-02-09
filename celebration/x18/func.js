var nw;

function showEvent(name) {
	var windstatus;
	var top = (screen.height - 500)/2;
	var left = (screen.width - 700)/2;
	windstatus='width=700,height=500,top=' + top + ',left=' + left + ',status=no,resizable=yes,scrollbars=yes';
	nw=window.open('','',windstatus);
	nw.document.open();
	nw.document.writeln('<html>');
	nw.document.writeln('<head>');
	nw.document.writeln('<title>Celebration Photography</title>');
	nw.document.writeln('<style type="text/css">');
	nw.document.writeln('<!--');
	nw.document.writeln('.invisible {-moz-opacity: 0;  filter: alpha(opacity=0);}');
	nw.document.writeln('-->');
	nw.document.writeln('</style>');
	nw.document.writeln('</head>');
	nw.document.writeln('<body bgcolor=\"#FFFFFF\" leftmargin=\"0\" topmargin=\"0\" marginheight=\"0\" marginwidth=\"0\"  onLoad="document.form1.submit()">');
	nw.document.writeln('<div class="invisible" id="browseLayer" style="position:absolute; width:100px; height:10px; z-index:15; left: 0px; top: 0px; visibility:hidden;">');
	nw.document.writeln('<form name="form1" method="POST" action="http://www.partypics.com/ver2/checkpassword.aspx">');
	nw.document.writeln('<INPUT type="text" name="Eventpwd" size="20" value="' + name +'">'); 
	nw.document.writeln('</form>');
	nw.document.writeln('</div>');
	nw.document.writeln('</body>');
	nw.document.writeln('</html>');
	nw.document.close();
}

function openForm(address){
	var windstatus;
	var top = (screen.height - 600)/2;
	var left = (screen.width - 750)/2;
	windstatus='width=750,height=560,top=' + top + ',left=' + left + ',status=no,resizable=yes,scrollbars=yes';
	nw=window.open(address,'',windstatus);
}