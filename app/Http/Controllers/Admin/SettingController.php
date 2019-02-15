<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class SettingController extends Controller{


    public $img_route = '/images/admin/avatar';

    // 只允许以下后缀名的图片文件上传
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    /**
     * 个人设置
     * */
    public function nset(Request $request){
        $id = $request->session()->get('admin_id');
        $admin_user = DB::table('admin')->where('admin_id',$id)->first();
        return view('Admin/Setting/nset',['admin_user'=>$admin_user]);
    }


    /**
     * 保存个人设置
     * */
    public function nSave(){
        $post = $_POST;
        $updateArray = array();
        $updateArray['admin_name'] = $post['admin_name'];
        if(!empty($post['admin_password'])){
            $updateArray['admin_password'] = md5($post['admin_password']);
        }
        $updateArray['admin_avatar'] = $post['admin_avatar'];
        $res = DB::table('admin')->where('admin_id',1)->update($updateArray);
        if($res){
            return view('message')->with(['message'=>'编辑成功','jumpTime'=>3,'url'=>'/login/logout']);
        }else{
            return view('message')->with(['message'=>'编辑失败','jumpTime'=>3,'url'=>'/admin/setting']);
        }
    }

    /**
     * 图片的压缩
     * */
    public function nMake(){
        // open an image file
        $img = Image::make('images/admin/avatar/1.png');//打开图片资源
        // now you are able to resize the instance
        $img->resize(200, 200);//压缩成大小

        // and insert a watermark for example
        $img->insert('images/admin/avatar/3.png');//添加水印图片

        // finally we save the image as a new file
        $res = $img->save('images/admin/avatar/2.png');//保存图片

    }

    /**
     * 上传头像
     * */
    public function nupload(Request $request){
        $images = $request->file('file');
        if(!empty($images)){
            $avatar = $this->AUpload($images);
            echo json_encode(array('code'=>'200','message'=>'上传成功','route'=>$avatar));
        }else{
            echo json_encode(array('code'=>'400','message'=>'上传失败','route'=>''));
        }
    }


    /**
     * 文章图片上传处理(单图片)
     * @param $image =>图片资源
     * */
    public function AUpload($images){
        $filedir = $this->img_route; //2、定义图片上传路径
        $imagesName=$images->getClientOriginalName(); //3、获取上传图片的文件名
        $extension = $images -> getClientOriginalExtension(); //4、获取上传图片的后缀名
        $newImagesName=md5(time()).random_int(5,5).".".$extension;//5、重新命名上传文件名
        $res = $images->move($filedir,$newImagesName); //6、使用move方法移动文件.
        if($res){
            return $filedir.$newImagesName;
        }else{
            return '';
        }
    }

}
