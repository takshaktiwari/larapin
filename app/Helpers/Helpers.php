<?php

function get_pages(){
	return \App\Page::where('status', '1')
						->orderBy('title', 'ASC')
						->get()->all();
}

function get_feat_categories($value='')
{
	return \App\Category::with('child_categories')
						->where('status', '1')
						->where('featured', '1')
						->orderBy('category', 'ASC')
						->get()->all();
}

function get_categories($value='')
{
	return \App\Category::with('child_categories')
						->where('status', '1')
						->whereNull('parent')
						->orderBy('category', 'ASC')
						->get()->all();
}

function all_categories($value='')
{
	return \App\Category::with('child_categories')
						->where('status', '1')
						->orderBy('category', 'ASC')
						->get()->all();
}

function posts_featured($limit=''){
	$query = \App\Post::with('category')
						->where('status', '1')
						->where('featured', '1');

	if ($limit != '') {
		$query = $query->limit($limit);
	}

	$query = $query->inRandomOrder()
					->get()->all();

	return $query;				
}

function posts_latest($limit=''){
	$query = \App\Post::with('category')
						->where('status', '1')
						->where('featured', '1')
						->orderBy('id', 'DESC');

	if ($limit != '') {
		$query = $query->paginate($limit);
	}else{
		$query = $query->get()->all();
	}

	return $query;				
}

function setting($key='')
{
	$setting = 	cache()->rememberForever('settings', function () {
				    $settings = \App\Setting::get()->all();
				    $setting_arr = array();
				    foreach ($settings as $key => $setting) {
				    	$setting_arr[$setting->option] = $setting->option_value;
				    }

				    return $setting_arr;
				});

	if (isset($setting[$key])) {
		return $setting[$key];
	}
}

function selected($val1='', $val2='', $arr=false)
{
	if ($arr==true) {
		if (is_array($val2)) {
			#in_array($val1-needle, $val2-haystack)

			if (in_array($val1, $val2)) {
				return 'selected';
			}
		}
	}else{
		if ($val1 == $val2) {
			return 'selected';
		}
	}
}

function checked($val1='', $val2='', $arr=FALSE)
{
	if ($arr == FALSE) {
		if ($val1 == $val2) {
			return 'checked';
		}
	}else{
		if (in_array($val2, $val1)) {
			return 'checked';
		}
	}
}

function get($key='')
{
	if (isset($_GET[$key])) {
		return $_GET[$key];
	}
}

function send_sms($mobile='', $msg='')
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  	CURLOPT_URL => "https://api.msg91.com/api/sendhttp.php?mobiles=".$mobile."&authkey=290169ALYEqViM5d5a8342&route=4&sender=BMFCph&message=".$msg."&country=91",
	  	CURLOPT_RETURNTRANSFER => true,
	  	CURLOPT_ENCODING => "",
	  	CURLOPT_MAXREDIRS => 10,
	  	CURLOPT_TIMEOUT => 30,
	  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  	CURLOPT_CUSTOMREQUEST => "GET",
	  	CURLOPT_SSL_VERIFYHOST => 0,
	  	CURLOPT_SSL_VERIFYPEER => 0,
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);
}





?>