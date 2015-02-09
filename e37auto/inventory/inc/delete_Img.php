<?php

	
	if (file_exists(DIR_UPLOAD.$fileName)) {
		if (unlink(DIR_UPLOAD.$fileName)) $status = 1;
		else $status = 3;
	} else {$status = 2;}
	
?>
