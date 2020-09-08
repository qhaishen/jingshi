<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Enters;

class EnterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('admin.enter.index');
    }


    public function data(Request $request)
    {

        $model = Enters::query();
    
        if ($request->get('title')){
            $model = $model->where('name','like','%'.$request->get('title').'%');
        }
        $res = $model->orderBy('created_at','desc')->paginate($request->get('limit',30))->toArray();
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res['total'],
            'data'  => $res['data']
        ];
       
        return response()->json($data);
    }
    
}
