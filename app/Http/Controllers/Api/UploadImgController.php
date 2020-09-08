<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadImgController extends Controller
{
    public function index(Request $request)
    {
    	//上传文件最大大小,单位M
        $maxSize = 10;
        //支持的上传图片类型
        $allowed_extensions = ["png", "jpg", "gif"];
        //返回信息json
        $data = ['code'=>200, 'msg'=>'上传失败', 'data'=>''];
        $file = $request->file('file');
	
        //检查文件是否上传完成
        if ($file->isValid()) {
            //检测图片类型
            $ext = $file->getClientOriginalExtension();
            if (!in_array(strtolower($ext), $allowed_extensions)) {
                $data['msg'] = "请上传".implode(",", $allowed_extensions)."格式的图片";
                return response()->json($data);
            }
            //检测图片大小
            if ($file->getClientSize() > $maxSize*1024*1024) {
                $data['msg'] = "图片大小限制".$maxSize."M";
                return response()->json($data);
            }
        } else {
            $data['msg'] = $file->getErrorMessage();
            return response()->json($data);
        }
        $newFile = date('Y-m-d')."_".time()."_".uniqid().".".$ext;
        $bool = Storage::disk('public')->put($newFile, file_get_contents($file->getRealPath()));
        if ($bool) {
        	return $newFile;
          
        } else {
             $data['data'] = $file->getErrorMessage();
             return response()->json($data);
        }
         
    }
}
