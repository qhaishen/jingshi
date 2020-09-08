<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Resume;

class TreeController extends Controller
{
    public function index()
    {
        return '123';
    }

    public function create(Request $request)
    {   
        $param = $request->all();
        $param['name'] = '未命名';
        $param['title'] = '未命名';
        $param['sex'] = '男';
        if(Resume::create($param))
        {
            return redirect(route('admin.test'))->with(['status' => '添加完成']);  
        }
    }


    public function destroy(Request $request)
    {
        
        if(Resume::destroy($request->get('id')))
        {
            return response()->json(['code'=>0,'msg'=>'删除成功']);

        }else{
            return response()->json(['code'=>1,'msg'=>'删除失败']);
        }
        
    }

    public function edit($id)
    {   
        $permissions = Resume::all();
        $trees = Resume::FindOrFail($id);
        return view('admin.tree.index',compact('trees','permissions'));
    }


    public function update(Request $request)
    {
        $position = Resume::findOrFail($request->get('id'));
        if ($position->update($request->all())){
            return response()->json(['code'=>0,'msg'=>'操作成功']);
        }
        return response()->json(['code'=>1,'msg'=>'系统错误']);
    }
}
