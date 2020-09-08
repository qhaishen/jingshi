<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Enters;
use App\Models\Resume;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enters = Enters::orderBy('id', 'desc')->get();
        return view('admin.test.index', compact('enters'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.test.create');
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
        if (Enters::create($data)) {
            return redirect(route('admin.test'))->with(['status' => '添加完成']);
        }
        return redirect(route('admin.test'))->with(['status' => '系统错误']);
    }


    public function showTree(Request $request)
    {   
        $data = Resume::where('eid',$request->get('eid'))->orderBy('sort','asc')->get();
        $arrs = array();
        $nodes = json_encode($this->recur($arrs,$data));
        return $nodes;
    }


    public function recur($arrs, $category, $parent_id = 0)
    {
        foreach ($category as $k => $v) {
            if ($v['parent_id'] == $parent_id) {
                $arr = array('title' => $v["name"],'eid'=>$v['eid'],'pid'=> $v['parent_id'], 'id' => $v['id'], 'children' => array());
                $arr['children'] = $this->recur($arr["children"], $category, $v['id']);
                array_push($arrs, $arr);
            }
        }
        return $arrs;
    }

    
}
