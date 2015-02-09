	function  ShowHideBlock(hide)
	{
	    if (hide)
		{
		    _v('subcont').style.display   = 'block';
			_v('maincont').style.display  = 'none';
			_v('topim').style.display     = 'none';			
			_v('imfree').src = _v('imfull').src;
			
			_v('old').style.display = 'none';
			_v('compare').innerHTML = 'compare with previous revision';
		}
		else
		{
		    _v('subcont').style.display   = 'none';
			_v('maincont').style.display  = 'block';
			_v('topim').style.display     = 'block';			
		}	
    }
	
//Edit commentary

	var cedit = 0;
	function EditCom(id)
	{
		var t = 0;
		if (cedit)
		{
	        t =  (cedit == id) ? 1 : 0;
			CancelEdit(cedit);	
		}
		if (0 == t)
		{						
		    var req     = new JsHttpRequest();
		    req.caching = false;
	
	    	req.onreadystatechange = function() 
    		{
    		    if (req.readyState == 4) 
    	   	    {
    		    	if (req.responseJS)
    			    {
	    				cedit = id;
	    		        _v('ecom_'+id).innerHTML = req.responseJS.resu;
    			        _v('com_'+id).style.display='none';
  	     		    }
        		}
	        }
	 		req.open(null, ajaxPath, true);
	        req.send({ mod: "getCom", 
			    	   idc: id
				      });	
	    }			
	}
			
	function CancelEdit(id)
	{
	    cedit = 0;
		_v('ecom_'+id).innerHTML = '';
		_v('com_'+id).style.display='block';			
	}
		
		
	function SaveCom(id)
	{
											
		var req     = new JsHttpRequest();
		req.caching = false;
	
	    var internal   = ((_v('e_internal') && _v('e_internal').checked) ? 1 : 0);
	    var aprove     = ((_v('e_aprove') && _v('e_aprove').checked) ? 1 : 0);
		var del_attach = ((_v('del_attach') && _v('del_attach').checked) ? 1 : 0);
				 
		req.onreadystatechange = function() 
		{
		    if (req.readyState == 4) 
	   	    {
		    	if (req.responseJS)
			    {
			        _v('com_'+id).innerHTML = req.responseJS.resu;
							
							
					if (req.responseJS.efm && req.responseJS.efm == 1)
					{
					    _v('col_'+id).className = 'comment comment-h';
					}
					else if (req.responseJS.efm && req.responseJS.efm == 2)
					{
					    _v('col_'+id).className = 'comment';
					}
					else if (req.responseJS.efm && req.responseJS.efm == 3)
					{
					    _v('col_'+id).className = 'comment comment-x';
					}
					CancelEdit(id);
	 		    }
    		}
	    }
	 	req.open(null, ajaxPath, true);
	 	req.send({ mod: "saveCom", 
		           idc: id,
				   descr: (_v('e_comment') ? _v('e_comment').value : ''),
				   internal: internal,
				   aprove: aprove,
				   del_attach: del_attach
		         });	
    }	

//Show Uploader

	function ShowAt()
	{
	    if (_v('main').style.display == 'block')
	    {
	        _v('main').style.display = 'none';
			_v('al').innerHTML = '&nbsp;<b>+ Add file</b>&nbsp;';
		}
		else
		{
		    _v('main').style.display = 'block';
			_v('al').innerHTML = '&nbsp;<b>- Add file</b>&nbsp;';
		}
	}
					

    function ComSubm()
    {
	    if ('' == _v('comment').value)
		{
		    _v('errt').innerHTML = 'Please enter a commentary';
		}
		else
		{
	        _v('fmx').submit();
		}
	}			
	