<?
function xml_connect($data)
 {
	$dat = "<?xml version=\"1.0\"?>\n<root>";
	for ($i = 0; $i < count($data); $i++){
		//если грузим фирмы и в этой фирме нет моделей - не грузим
		if ($data[$i]["make_vis"] != "0"){
		
			$val = true;
			$dat .= "<data ";
			$dt = array_keys ($data[$i]);
			for ($a = 0; $a < count($data[$i]); $a++){
				if ($dt[$a] != "modelsale_description") {$dat .= ($dt[$a]."=\"".$data[$i][$dt[$a]]."\" ");
				} else { $dat .= ("><description><![CDATA[".$data[$i][$dt[$a]]); $val = false;}
			}
			if ($val) $dat .= "></data>";
			else $dat .= "]]></description></data>";
		}
	}	
	$dat .= "</root>";
	return $dat;
}
?>