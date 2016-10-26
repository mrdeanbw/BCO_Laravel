<?php

namespace App\Http\Controllers\Chatter;

use \DevDojo\Chatter\Controllers\ChatterController as ChatterRootController;

class ChatterController extends ChatterRootController {

	public function __construct()
    {
        $this->middleware('auth');
    }
    
}
