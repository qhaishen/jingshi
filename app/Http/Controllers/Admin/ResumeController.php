<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Resume;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('admin.resume.index');
    }


    public function data(Request $request)
    {

        $model = Resume::query();
        $ids = $request->get('eid');
        
        $res = $model->where('eid',$ids)->orderBy('created_at','desc')->paginate($request->get('limit',30))->toArray();
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res['total'],
            'data'  => $res['data']
        ];
       
        return response()->json($data);
    }

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($eid)
    {   
        $permissions = $this->level($eid);
        $eid = $eid;
        return view('admin.resume.create',compact('permissions','eid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data =  $request->all();
        if(Resume::create($data))
        {
            return redirect(route('admin.resume'))->with(['status'=>'添加完成']);
        }
            return redirect(route('admin.resume'))->with(['status'=>'系统错误']);
   
    }

    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        if (Resume::destroy($ids)){
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
        return response()->json(['code'=>1,'msg'=>'删除失败']);
    }
}
