<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{	

	/**
	 * 留言api
	 * 
	 * @param  Request $Request array
	 * @return  json
	 */
    public function messages(Request $request)
    {	
    	$data = $request->get('params');
    	

    	if (Message::create($data))
    	 {
    		// return repsonse()->json(['code'=>0 , 'msg'=>'留言成功']);
    		return 0;
    	} else {
    		return 1;
    	}
    }
}
