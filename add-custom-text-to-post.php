

function changeTextOnSave($content){
	if(get_post_type()=='int_ques'){
		if( current_user_can('administrator')){
			return 'This is admin post';
		}else{
			$text = " - This post is not created by admin";
    		$content = str_ireplace($text,  '', $content);
			return $content." - This post is not created by admin";
		}
	}
}

add_filter('content_save_pre','changeTextAfterSave');
