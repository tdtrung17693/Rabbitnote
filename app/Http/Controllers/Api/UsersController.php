<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\UserTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use JWTAuth;
use League\Fractal\Manager;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class UsersController extends Controller
{
	use Helpers;

	public function __construct() {
		$this->middleware('api.auth', ['only' => ['index']]);
	}

    public function index(Request $request, Manager $fractal)
    {
    	if ($requestedEmbeds = $request->get('include')) {
		    $fractal->parseIncludes($requestedEmbeds);
		}

        return $this->response->item($this->user, UserTransformer::class);
    }

    public function logout(Request $request)
    {
    	try {
	    	JWTAuth::invalidate( JWTAuth::getToken() );
	    } catch (TokenExpiredException $e) {
            return response()->json(['code' => $e->getStatusCode(), 'error' => $e->getMessage()], 401);
        } catch(JWTException $e) {
	    	return response()->json(['error' => $e->getMessage()], 500);
	    }
    }
}
