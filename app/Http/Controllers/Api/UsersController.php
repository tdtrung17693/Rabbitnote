<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\UserTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use League\Fractal\Manager;

class UsersController extends Controller
{
	use Helpers;

    public function index(Request $request, Manager $fractal)
    {
    	if ($requestedEmbeds = $request->get('include')) {
		    $fractal->parseIncludes($requestedEmbeds);
		}

        return $this->response->item($this->user, UserTransformer::class);
    }
}
