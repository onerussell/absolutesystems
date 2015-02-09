<?
error_log("test");
print "&xmldata=<?xml version=\"1.0\"?>\n<root>";
for($i = 0; $i < count($data); $i++)
{
//если грузим фирмы и в этой фирме нет моделей - не грузим
	if(@$data[$i]["make_vis"] != "0")
	{
		$val = true;
		print "<data ";
		$dt = array_keys ($data[$i]);
		for ($a = 0; $a < count($data[$i]); $a++)
		{
			if($dt[$a] != "modelsale_description") {print($dt[$a]."=\"".$data[$i][$dt[$a]]."\" ");
		}else{ print ("><![CDATA[".$data[$i][$dt[$a]]); $val = false;}
		}
		if($val) print "></data>";
		else print "]]></data>";
		
	}
}	
print "</root>";
?>