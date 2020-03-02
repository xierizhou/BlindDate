<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Means;
use App\Models\MeansPhoto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Image;
class IndexController extends Controller
{
    public function index(){
        return view('home.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        try{
            DB::transaction(function () use($request) {
                $means = Means::create([
                    'nickname'=>$request->nickname,
                    'province' => $request->province,
                    'city' => $request->city,
                    'area' => $request->area,
                    'occupation' => $request->occupation,
                    'sex' => $request->sex,
                    'birthday' => $request->birthday,
                    'height' => $request->height,
                    'education' => $request->education.$request->education_qi,
                    'monthly_income' => $request->monthly_income,
                    'marriage_history' => $request->marriage_history,
                    'introduce' => $request->introduce,
                    'ideal' => $request->ideal,
                    'wechat' => $request->wechat,
                ]);

                if ($request->photos) {
                    foreach ($request->photos as $val) {
                        if($val){
                            $photos[] = [
                                'means_id' => $means->id,
                                'img' => $val
                            ];
                        }

                    }
                    if ($photos) {
                        MeansPhoto::insert($photos);
                    }

                }
            });
            return response()->json(['code'=>200,'message'=>'提交成功']);
        }catch (\Exception $exception){
            return response()->json(['code'=>400,'message'=>'系统异常！','error_message'=>$exception->getMessage()]);
        }



    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request){
        $file = $request->file('photo');
        try{
            //判断文件是否上传成功
            if ($file->isValid()){
                //原文件名
                $originalName = $file->getClientOriginalName();
                //扩展名
                $ext = $file->getClientOriginalExtension();
                //MimeType
                $type = $file->getClientMimeType();
                //临时绝对路径
                $realPath = $file->getRealPath();


                $filename = '/means/'.date('Ymd').'/'.uniqid().'.'.$ext;
                $bool = Storage::disk('uploads')->put($filename,file_get_contents($realPath));
                Image::make($file)->resize(30,30)->save(public_path('/uploads'.$filename."_30x30.".$ext));//压缩并保存照片
                Image::make($file)->resize(50,50)->save(public_path('/uploads'.$filename."_50x50.".$ext));//压缩并保存照片
                //判断是否上传成功
                if($bool){
                    return response()->json(['code'=>200,'input_img'=>'/uploads'.$filename,'img'=>'/uploads'.$filename."_30x30.".$ext]);
                }else{
                    return response()->json(['code'=>400,'message'=>'上传失败！']);
                }
            }
        }catch (\Exception $exception){
            return response()->json(['code'=>400,'message'=>'上传失败！']);
        }

    }
}
