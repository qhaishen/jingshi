<?php

namespace App\Http\Controllers\Api;

use App\Models\Team;
use App\Models\Site;
use App\Models\View;
use App\Models\Reliable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class TeamController extends Controller
{	
	/**
	 * 获取团队成员列表api
	 * 
	 * @return [type] json
	 */
    public function index()
    {
    	$data = Team::orderBy('sort','asc')->orderBy('id','asc')->get();
    	foreach ($data as $value) {
    		$value['avatar'] = getenv('APP_URL').$value['avatar'];
    	}
    	return response()->json(['code'=>0 , 'data'=>$data ]);

    }


    /**
     * 获取团队某个成员详情api
     * 
     * @param  int $uid  成员ID
     * @return  json    
     */
    public function memberDetails($id)
    {
    	$members = Team::with('browseLimit')->withCount('browse')->withCount('reliable')->find($id);
        $data = Site::pluck('value', 'key');
        $data['avatar'] = getenv('APP_URL') . $data['avatar'];
    	$members['avatar'] = getenv('APP_URL').$members['avatar'];
    	return response()->json(['code'=>0 , 'data'=>$members ,'config'=>$data]);
    }

    /**
     * 浏览总数量
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function browseTotal(Request $request)
    {
        $data = DB::table('views')
                 ->join('members', 'views.openid', '=', 'members.openid')
                 ->where('views.tid',$request->tid)
                 ->distinct()
                 ->count();

         $limits = DB::table('views')
                 ->join('members', 'views.openid', '=', 'members.openid')
                 ->where('views.tid',$request->tid)
                 ->distinct()->limit(3)->orderBy('date','desc')
                 ->get();
            return response()->json(['total'=>$data,'limit'=>$limits]);
    }
    //添加浏览记录
    public function browseMembers(Request $request)
    {
        $data = $request->all();
        $data['date'] = time();
        if(View::create($data))
        {
            return response()->json(['code'=>0]);
        }
    }


    /**
     * 获取靠谱总数量
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function reliableTotal(Request $request)
    {
        $data = Reliable::where('tid',$request->tid)->count();
        return $data;
    }


    //点击靠谱
    public function reliable(Request $request)
    {
        $data = $request->all();
        $result = Reliable::where($data)->get();
        //如果为空，则进行添加数据
        if($result->isEmpty())
        {   
            $data['date'] = time();
            Reliable::create($data);
            $status = 1;
        }else{
            //如果不为空，则进行删除
            Reliable::where($data)->delete();
            $status = 0;
        }
        $count = Reliable::where('tid',$request->tid)->count();
        return response()->json(['status'=>$status,'data'=>$count]);
    }
}
