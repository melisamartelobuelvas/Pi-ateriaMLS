<?php

class DefaultController
{
	
	function __construct()
	{
		# code...
	}

	public function Index(){
		require_once 'view/header.php';
		require_once 'view/default.php';
        require_once 'view/footer.php';
	}
}

?>