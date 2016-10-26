<?php

namespace App\Http\Controllers\Chatter;

use \DevDojo\Chatter\Controllers\ChatterPostController as ChatterRootController;

class ChatterPostController extends ChatterRootController {

	public function __construct()
    {
        $this->middleware('auth');
    }
    
}
