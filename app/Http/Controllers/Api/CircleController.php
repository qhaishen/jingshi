<?php

namespace App\Http\Controllers\Api;

use App\Models\Circle;
use App\Models\Img;
use App\Models\Member;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class CircleController extends Controller
{	

    /**
     * 发布动态接口
     * @param   $uploadFileList  图片列表 
     * @param   $openid          微信用户openid
     * @param   $content         动态内容
     * @return  json
     */
    public function issueCircle(Request $request)
    {   
        $uploadFileList = $request->get('uploadFileList');
        $data['content'] = $request->get('content');
        $data['date']   =   time();
        $data['openid'] = $request->get('openid');
        $result = Circle::create($data);
        if($uploadFileList){
            foreach ($uploadFileList as $value) {
                $files['url'] = $value['url'];
                $files['circle_id'] = $result->id;
                DB::table('img')->insert($files);
            }
        }
        return response()->json(['code'=>0]);
    }

    /**
     * 获取用户是否有发不动态的权限
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function permissions(Request $request)
    {
        $result = Member::where('openid',$request->openid)->first();
        return $result->permissions;
    }

    /**
     * 获取律师圈动态列表，按发布时间顺序排序
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function  getCircleList(Request $request)
    {   
        $openid = $request->openid;
        //获取所有动态，以及对应的图片
        $circles = Circle::with('imgs')->with('members')->withCount('comments')->with('praise')->withCount('praise')->orderBy('id','desc')->get();
        foreach ($circles as $value) {
            $value['date'] =  $this->formatTime($value['date']);
            foreach ($value['praise'] as $v2) {
                if ($v2['openid'] = $openid) {
                    $value['praiseStatus'] = 0;
                } else {
                    $value['praiseStatus'] = 1;
                }
            }
        }
        return $circles;
    }

    /**
     * 获取单条动态详情
     * 
     * @param  int  $request->id
     * @return json  
     */
    public function circleAsComments(Request $request)
    {
        $details = Circle::with('imgs')->with('members')->find($request->id);
        $details['date'] = $this->formatTime($details['date']);
        return $details;
    }


    /**
     * 获取单条动态的评论列表
     * 
     * @param  int  $request->id
     * @return json
     */
    public function getCircleAllComments(Request $request)
    {
        $allComments = Circle::with('comments')->with('users')->withCount('comments')->withCount('praise')->find($request->id);
        $allComments['date'] = $this->formatTime($allComments['date']);
        return $allComments;
    }


    //获取某个动态所有评论列表
    public function commentsList(Request $request)
    {
        $data = Comment::where('circle_id',$request->circle_id)->orderBy('date','desc')->with('users')->get();
        foreach ($data as $value) {
            $value['date'] = $this->formatTime($value['date']);
        }
        return $data;
    }

    //获取某条动态的所有回复列表
    public function commentsReplyList(Request $request)
    {
        $data = Comment::where('circle_id',$request->circle_id)->where('type',1)->orderBy('date','asc')->with('receive')->with('users')->get();
        return $data;
    }

    //添加评论
    public function addItional(Request $request)
    {
        $data = $request->all();
        $data['date'] = time();
        if(Comment::create($data))
        {
            return response()->json(['code'=>0,'msg'=>'评论成功']);
        }
    }

    //获取某条评论的相关信息
    public function commentsToUser(Request $request)
    {
        $data = Comment::with('users')->find($request->id);
        return $data;
    }

    //格式化时间，把具体时间转换成类似于微信朋友圈时间格式
    public function formatTime($date)
    {
        $str = '';
        // $timer = strtotime($date);
        $timer = $date;
        $diff = $_SERVER['REQUEST_TIME'] - $timer;
        $day = floor($diff / 86400);
        $free = $diff % 86400;
        if ($day > 0) {
            return $day . "天前";
        } else {
            if ($free > 0) {
                $hour = floor($free / 3600);
                $free = $free % 3600;
                if ($hour > 0) {
                    return $hour . "小时前";
                } else {
                    if ($free > 0) {
                        $min = floor($free / 60);
                        $free = $free % 60;
                        if ($min > 0) {
                            return $min . "分钟前";
                        } else {
                            if ($free > 0) {
                                return $free . "秒前";
                            } else {
                                return '刚刚';
                            }
                        }
                    } else {
                        return '刚刚';
                    }
                }
            } else {
                return '刚刚';
            }
        }
    }

    /**
     * 删除动态
     */
    public  function deltetCircle(Request $request)
    {
        if(Circle::destroy($request->id)){
            return response()->json(200);
        }
        
    }


    //删除评论
    public function deleteComments(Request $request)
    {
       if(Comment::destroy($request->id))
       {
        return response()->json(200);
       } 
    }
}
