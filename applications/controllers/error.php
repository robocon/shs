<?php

/**
 * 
 */
class Error extends Controller	
{
	public function base(){
		
		$view = $this->load_view('error');
		$view->render();
	}
}
