<?php
namespace App\Http\Controllers\api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Factory;
use Carbon\Carbon;

class LoginController extends Controller
{   
    
     /**
     * 首次登陆
     * @param LoginInterface $login
     * @return array
     */
    public function login(Request $request)
    {   
        $config = [
            'app_id' => 'wx67fd7b926f13d963',
            'secret' => '35789334b5ed84aeff6c660fea449f22',
        
            // 下面为可选项
            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',
        ];
        
        $app = Factory::miniProgram($config);
        $data = $app->auth->session($request->get('code'));

        $userInfo['openid'] = $data['openid'];
        $userInfo['session_key'] = $data['session_key'];
        $userInfo['nickname'] = $request->get('nickname');
        $userInfo['avatar'] = str_replace('/132', '/0', $request->get('avatar'));//拿到分辨率高点的头像
        $userInfo['country'] = $request->get('country');
        $userInfo['province'] = $request->get('province');
        $userInfo['city'] = $request->get('city');
        // $userInfo['gender'] = $request->get('gender') == '1' ? '1' : '2';//没传过性别的就默认女的吧，体验好些
        $userInfo['language'] = $request->get('language');

        $members = Member::where('openid',$data['openid'])->first();

        if(!$members){
           $members = Member::create($userInfo);
        }
        //如果注册过的，就更新下下面的信息
        $attributes['session_key'] = $data['session_key'];
        $attributes['avatar'] = $userInfo['avatar'];
        if ($request->get('nickname')) {
            $attributes['nickname'] =  $request->get('nickname');
        }
        // if ($request->get('gender')) {
        //     $attributes['gender'] = $request->get('gender');
        // }
        // 更新用户数据
        $members->update($attributes);
        
       

        return response()->json([
            'data' => $members,
        ], 200);

    }

    
}
