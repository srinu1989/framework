<?php
	class Assets
	{
			public function rootpath() {
				$link = pathinfo($_SERVER["PHP_SELF"]);
				return $link["dirname"];
			}
			public function Styles() {
					$styles = [
						'<link rel="stylesheet" href="'.$this->rootpath().'/assets/css/bootstrap.min.css">'
					];
					echo implode('', array_values($styles));
			}
			public function Scripts() {
					$scripts = [
						'<script src="'.$this->rootpath().'/assets/js/jquery.min.js"></script>',
						'<script src="'.$this->rootpath().'/assets/js/popper.min.js"></script>',
						'<script src="'.$this->rootpath().'/assets/js/bootstrap.min.js"></script>'
					];
					echo implode('', array_values($scripts));
			}
	}
	 	$page = new Assets();
	 	$page->rootpath();
?>