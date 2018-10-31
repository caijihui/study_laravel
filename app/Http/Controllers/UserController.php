<?php
/**
 * Created by PhpStorm.
 * User: cjh
 * Date: 2017/12/27
 * Time: 上午9:45
 */
namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Queue\Queue;
use Illuminate\Support\Facades\Redis;
use App\Events\UserLogin;
use App\Models\Jobs;
use Illuminate\Support\Facades\Cache as Caches;
use Carbon\Carbon;

class UserController extends Controller
{


    /**
     *  计算年龄
     * @param Request $request
     * @return int
     */
    public function age(Request $request){
        $bday = $request->input('bday');

        $bday = $bday ?? '2012-09-08';
        list($year, $month, $day) = explode('-', $bday);
        $birthday = Carbon::createFromDate($year, $month, $day);
        $age = Carbon::now()->diffInYears($birthday);
        return $bday.' 年出生的年龄为：'.$age;
    }

    public function event()
    {

        $s_today= Carbon::now();
        $res = Jobs::firstOrCreate(['name'=>'ds22','status'=>45]);
        if (Caches::has('name')){
            Caches::get('name');
        }else{
            Caches::put('name','zhangsan',10);
        }
        Caches::remember('key',15,function (){
            return "11215454";
        });
        $ks  =  Caches::get('key');

        Caches::forget('key');

        $id = 2;

        $jobs = Jobs::where(['id'=> $id])->orderBy('id','desc')->first();

        $jobs->status = 2444;
        $jobs->save();
        event(new UserLogin($jobs));

        echo "ok";
    }

    /**
     * 测试队列和发送邮件
     */
    public function mail(){
        Queue::push('emails',array('messsage'=>'dsfghdjfhjks'));
        $id=1;
        $user = User::findOrFail($id);
        $job=(new SendEmail($user))->onQueue('emails')->delay(20);
        $this->dispatch($job);
    }

    public function send(){
        Redis::set('k111','45454');
        $v=Redis::get('k111');
        echo $v;
    }
}