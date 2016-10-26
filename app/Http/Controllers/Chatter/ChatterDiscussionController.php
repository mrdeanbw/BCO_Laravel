<?php

namespace App\Http\Controllers\Chatter;

use \DevDojo\Chatter\Controllers\ChatterDiscussionController as ChatterRootController;

class ChatterDiscussionController extends ChatterRootController {

	public function __construct()
    {
        $this->middleware('auth');
    }
    
}
