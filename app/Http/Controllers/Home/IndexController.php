<?php

namespace App\Http\Controllers\Home;

use App\Models\Service;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function team()
    {
    	return view('home.index.team');
    }

    public function teeth()
    {   
        $lists = DB::table('polulars')->get();
    	return view('home.index.teeth',compact('lists'));
    }

    public function teethDetails($id)
    {   
        $teeths = DB::table('polulars')->where('id',$id)->first();
        $teeths->created_at =  substr($teeths->created_at,0,10);
        return view('home.index.teethDetails',compact('teeths'));
    }

    public function active()
    {   
        $lists = DB::table('actives')->get();
    	return view('home.index.active',compact('lists'));
    }


    public function activeDetails($id)
    {   
        $actives = DB::table('actives')->where('id',$id)->first();
        $actives->created_at =  substr($actives->created_at,0,10);
        return view('home.index.activeDetails',compact('actives'));
    }


    public function service()
    {	

    	return view('home.index.service');
    }

    public function give()
    {   
        $enjoins = DB::table('enjoins')->get();
        return view('home.index.give',compact('enjoins'));
    }

    public function address()
    {   

        $lists = DB::table('address')->get();
        return view('home.index.address',compact('lists'));
    }

    public function about()
    {   
        $config = About::pluck('value','key');
        return view('home.index.about',compact('config'));
    }

    public function users()
    {   
        $users = DB::table('equitys')->where('id',1)->first();
        return view('home.index.users',compact('users'));
    }

    public function client()
    {   

        return view('home.index.client');
    }

    public function message(Request $request)
    {
    	$data = $request->all();
    	if(Service::create($data))
    	{
    		return response()->json(['code'=>1,'msg'=>'留言成功']);
    	}else{
    		return response()->json(['code'=>0,'msg'=>'系统错误']);
    	}
    }
}
