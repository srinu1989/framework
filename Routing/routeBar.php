<?php
class Route {

	public function Sanitize($data) {
		if (is_array($data)) {
			return htmlspecialchars_decode(htmlentities(stripslashes(strip_tags(implode(',', $data)))));
		}
		if (!is_array($data)) {
			return htmlspecialchars_decode(htmlentities(stripslashes(strip_tags(trim($data)))));
		}
	}
	public function allParams() {
		$req_uri  	=  	parse_url($this->Sanitize($_SERVER['REQUEST_URI']));
		$params 	= 	explode('&', $this->Sanitize($req_uri["query"]));
		return $params;
	}
	public function param($args) {
		$req_uri  	=  	parse_url($this->Sanitize($_SERVER['REQUEST_URI']));
		$params 	= 	explode('&', $this->Sanitize($req_uri["query"]));
	if ($args <= count($params)) {
				if (!$params[$args]) {
					return "Please Check Parameter Index";
				} else {
					return $params[$args];
				}
		} else {
			return "Please Check Parameter Index";
		}
	}
}
$get = new Route();
?>