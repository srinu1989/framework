<?php
class LandingPage
{
		public function MainPage($page) {
			header('Location:Pages/'.$page);
		}
}
$make = new LandingPage();
$page = 'welcome.php';
$make->MainPage($page);
?>