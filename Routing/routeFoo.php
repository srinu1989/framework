<?php
class Routing {

	public function Sanitize($data) {
		if (is_array($data)) {
			return htmlspecialchars_decode(htmlentities(stripslashes(strip_tags(implode(',', $data)))));
		}
		if (!is_array($data)) {
			return htmlspecialchars_decode(htmlentities(stripslashes(strip_tags(trim($data)))));
		}
	}
	
	public function route($url,$params) {
		$link = pathinfo($url);
		if (is_array($params)) {
			$values = implode('/', $params);
		} else {
			$values = $params;
		}
		$path =  $this->Sanitize($link['basename']).'?'.implode('&', $params);
		$final_link = filter_var($path, FILTER_SANITIZE_URL);	
		return $this->Sanitize($final_link);
	}
}
$make 		=	 	new Routing();
?>