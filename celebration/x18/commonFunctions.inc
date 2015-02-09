<?php
	function toDataBaseString($val) {
		return quotemeta(htmlspecialchars($val));
	}
	
	function toDataBaseLiteString($val) {
		return quotemeta($val);
	}
?>