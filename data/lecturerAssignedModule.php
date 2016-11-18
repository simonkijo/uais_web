<?php 
	$module = getAnyField('lec_md_title','module');
	$module_ = printJSONDATA($module);
	$count_ = count($module_);
	
	if(getField('status') == 'student' && getAnyField('st_role','role') == 'Class Representative'){
		$year = getAnyField('st_role','year');
		$semester = getAnyField('st_role','semester');
		$course_ = getAnyField('st_role','cs');
		$pro_ = getAnyField('st_role','programme');
		$qu_ = "SELECT `module` FROM `1948040_uais`.`module` WHERE `year`='".$year."' AND `semester`='".$semester."' AND `cs`='".$course_."' AND `programme`='".$pro_."'";
		$ru_ = mysql_query($qu_);
		while($row = mysql_fetch_array($ru_)){
			$_module_[] = $row['module'];
		}
	}
?>