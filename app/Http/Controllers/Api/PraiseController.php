<?php

namespace App\Http\Controllers\Api;

use App\Models\Praise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PraiseController extends Controller
{	

    /**
     * 操作点赞或者取消赞
     * 
     * @param  Request $Request [description]
     * @return [type]           [description]
     */
    public function praiseHandle(Request $request)
    {
        $data = $request->all();
        $list = Praise::where($data)->get();
        if(!$list->isEmpty()){
            Praise::where($data)->delete();
            $praiseTotal = Praise::where('circle_id',$request->circle_id)->count();
            $myPraiseTotal = Praise::where('openid',$request->openid)->get();
            return response()->json(['status'=>1,'praiseTotal'=>$praiseTotal,'myPraiseTotal'=>$myPraiseTotal]);
        }else{
            $data['date'] = time();
            Praise::create($data);
            $praiseTotal = Praise::where('circle_id',$request->circle_id)->count();
             $myPraiseTotal = Praise::where('openid',$request->openid)->get();
            return response()->json(['status'=>0,'praiseTotal'=>$praiseTotal,'myPraiseTotal'=>$myPraiseTotal]);
        }
    }

    public function confirmPraise(Request $request)
    {
        $data = $request->all();
        $result = Praise::where($data)->get();
        $praiseTotal = Praise::where('circle_id',$request->circle_id)->count();
        if(!$result->isEmpty()){
            return response()->json(['status'=>0,'praiseTotal'=>$praiseTotal]);
        }else{
            return response()->json(['status'=>1,'praiseTotal'=>$praiseTotal]);
        }
    }

    public function myPraiseTotal(Request $request)
    {
        $data = $request->all();
        $list = Praise::where('openid',$request->openid)->get();
        foreach ($list as $value) {
            $praises[] = $value['circle_id'];
        }
        return $praises;
    }

    public function myPraise(Request $request)
    {
        $data = $request->all();
        $list = Praise::where($data)->get();
        if($list->isEmpty()){
            $data['date'] = time();
            Praise::create($data);
        }else{
            Praise::where($data)->delete();
        }

        $myPraises = Praise::where('openid',$request->openid)->get();
        return $myPraises;
    }
}
