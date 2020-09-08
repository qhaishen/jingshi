<?php

namespace App\Http\Controllers\Admin;

use App\Models\Circle;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CircleController extends Controller
{
    public function index()
    {       
        return view('admin.circle.index');
    }


    /**
     * 
     * 获取动态列表
     */
    public function data(Request $request)
    {

        $model = Circle::query();
    
        if ($request->get('title')){
            $model = $model->where('content','like','%'.$request->get('title').'%');
        }
        $list = $model->orderBy('date','desc')->with('members')->paginate($request->get('limit',30))->toArray();
        foreach ($list['data'] as $k=>$v){
            $list['data'][$k]['date'] = date('Y-m-d H:s',$v['date']);
            $list['data'][$k]['nickname'] = $v['members']['nickname'];
            $list['data'][$k]['avatar'] = $v['members']['avatar'];
        }
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $list['total'],
            'data'  => $list['data']
        ];
        
        return response()->json($data);
    }


    public function comments()
    {
        return view('admin.circle.comments');
    }


    /**
     * 获取动态对应的评论的列表
     */
    public function commentsData(Request $request)
    {
        $list = Comment::where('circle_id',$request->cid)->orderBy('date','desc')->with('users')->paginate($request->get('limit',30))->toArray();
        foreach ($list['data'] as $k=>$v){
            $list['data'][$k]['date'] = date('Y-m-d H:s',$v['date']);
            $list['data'][$k]['nickname'] = $v['users']['nickname'];
            $list['data'][$k]['avatar'] = $v['users']['avatar'];
        }
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $list['total'],
            'data'  => $list['data']
        ];
        
        return response()->json($data);
    }


    /**
     * 
     * 删除动态
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        if(Circle::destroy($ids))
        {
            return response()->json(['code'=>0,'msg'=>'删除成功']);

        }else{
            return response()->json(['code'=>1,'msg'=>'删除失败']);
        }
        
    }

    /**
     * 删除评论
     */
    public function delComments(Request $request)
    {
        $ids = $request->get('ids');
        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        if(Comment::destroy($ids))
        {
            return response()->json(['code'=>0,'msg'=>'删除成功']);

        }else{
            return response()->json(['code'=>1,'msg'=>'删除失败']);
        }
        
    }
}