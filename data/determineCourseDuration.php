<?php 
	if(isset($_POST['md_show_b'])){
		$course_ = $_POST['course'];
		
		if($course_ == ''){
			$error[2] = 'no_selection';
			return  $error;
		}else{
			for($i=0;$i<count($course);$i++){
				if($course[$i] == $course_){
					$d_ = $course_duration[$i];
				}
			}
		}
	}
	if(isset($_POST['md_show_d'])){
		$course_ = $_POST['course'];
		
		if($course_ == ''){
			$error[2] = 'no_selection';
			return  $error;
		}else{
			for($i=0;$i<count($course);$i++){
				if($course[$i] == $course_){
					$d_ = $course_duration[$i];
				}
			}
		}
	}
?>