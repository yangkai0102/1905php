<?php

namespace App\Http\Controllers\Index;

use App\Admin\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegisterPost;
use App\Index\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function send(){
        $email =  request()->email;
//        echo $email;die;
        $reg='/^\w+@\w+\.com$/';
        if(empty($email)){
            echo json_encode(['font'=>'邮箱必填','code'=>2]);die;
        }else if(!preg_match($reg,$email)){
            echo json_encode(['font'=>'邮箱格式有误','code'=>2]);die;
        }else{
            $res=User::where('email',$email)->first();
//            echo $res;die;
            if($res){
                echo json_encode(['font'=>'邮箱已存在','code'=>2]);die;
            }
        }
//        $email='y15034512803@163.com';
        $code=rand(100000,999999);
        $massage="您现在正在注册全国最大珠宝商会员,验证码:".$code;
        $res=$this->sendemail($email,$massage);
        if(!$res){
            $emailInfo=['email'=>$email,'code'=>$code,'send_time'=>time()];
            session(['emailInfo'=>$emailInfo]);
            echo json_encode(['font'=>'发送成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'发送失败','code'=>2]);die;
        }
    }
     function sendemail($email,$massage){
        \Mail::raw($massage ,function($message)use($email){
            //设置主题
            $message->subject("欢迎注册滕浩有限公司");
            //设置接收方
            $message->to($email);
        });
    }

    public function regDo(){
        $post=request()->except('_token');
//        dd($post);
        $emailInfo=session('emailInfo');
        $reg='/^\w+@\w+\.com$/';
        if(empty($post['email'])){
            echo '邮箱必填';
        }else if(!preg_match($reg,$post['email'])){
            echo '邮箱格式有误';
        }else if($post['email']!=$emailInfo['email']){
           echo '发送邮件邮箱与将要注册邮箱不一致';
        }else{
            $count=User::where('email',$post['email'])->count();
            if($count>0){
                echo '邮箱已被注册';
            }
        }

        //验证 验证码
        if(empty($post['code'])){
            echo '验证码必填';
        }else if($post['code']!=$emailInfo['code']){
            echo '验证码错误';
        }else if((time()-$emailInfo['send_time'])>300){
            echo '验证码已失效，五分钟内输入有效';
        }

        //验证密码
        if(empty($post['pwd'])){
            echo '密码必填';
        }else if(strlen($post['pwd'])<6||strlen($post['pwd'])>10){
            echo '密码允许6-10位之间';
        }

        if($post['pwd2']!=$post['pwd']){
            echo '确认密码必须与密码一致';
        }

        //入库

        unset($post['pwd2']);
        $res=User::create($post);
        return redirect('index');
    }

    //执行登录
    public function loginDo(){
        $user=cache('user');
        if(!$user) {
            $post = request()->except('_token');
//        dd($post);

            $validator = \Validator::make($post, [
                'email' => 'required',
                'pwd' => 'required',
            ], [
                'email.required' => '用户名必填',

                'pwd.required' => '密码必填'
            ]);
            if ($validator->fails()) {
                return redirect('login')
                    ->withErrors($validator)
                    ->withInput();
            }
//        echo encrypt(123123);die;


            $where = [
                ['email', '=', $post['email']],
                ['pwd', '=', $post['pwd']]
            ];
            $user = User::where($where)->first();
            cache(['user' => $user], 10);
        }
//        dd($login);
        if($user){
            session(['index'=>$user]);
            return redirect('/index')->with('msg','登录成功');
        }else{
            return redirect('login')->with('msg','账号或密码错误');
        }
    }

    function test(){
        print_r(session('index'));
    }
}
