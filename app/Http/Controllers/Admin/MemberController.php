<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{   

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('admin.member.index');
    }

    /**
     * 获取会员列表
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function data(Request $request)
    {
        $model = Member::query();
        if ($request->get('name')){
            $model = $model->where('nickname','like','%'.$request->get('name').'%');
        }
        if ($request->get('phone')){
            $model = $model->where('phone','like','%'.$request->get('phone').'%');
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
    
    /**
     * 更新用户发布动态权限
     * @param  Request $request array
     * @param  int  $id      
     * @return json           
     */
    public function permissions(Request $request)
    {   
        $result = Member::where('id',$request->get('id'))->update(['permissions'=>$request->get('permissions')]);
        if($result){
            return response()->json(['code'=>0,'msg'=>'开通权限成功']);
        }else{
            return response()->json(['code'=>1,'msg'=>'系统错误，请重试！']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        if (Member::destroy($ids)){
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
        return response()->json(['code'=>1,'msg'=>'删除失败']);
    }
}
