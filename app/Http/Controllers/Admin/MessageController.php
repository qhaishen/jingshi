<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.message.index');
    }

    

    public function data(Request $request)
    {
        $res = Message::orderBy('id','desc')->paginate($request->get('limit',30))->toArray();
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res['total'],
            'data'  => $res['data']
        ];
        return response()->json($data);
    }
    
    /**
     * 删除操作.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Message::destroy($id))
        {
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
    }
}
