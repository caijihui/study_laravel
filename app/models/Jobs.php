<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model

{
    protected $table = 'jobs';

    protected $guarded = [];

    public $timestamps = false;

    public function getList()
    {

    }

//   public  function setContentAttribute($value){
//        if (is_array($value)){
//            $this->attributes['content'] = json_encode($value);
//        }
//        $this->attributes['content'] = '';
//
//   }

   public function getContentssAttribute($value)
   {
        var_dump($this->content);
        $c=json_decode($this->content);

        var_dump($c);
       return $c;

   }
    public function getStextAttribute($value)
    {
        $sn = '';
        switch ($this->status){
            case 1 :
                $sn = "1111";
                break;
            case 2 :
                $sn = '22222';
                break;
            case 3 :
                $sn = '3333';
                break;
            default:
                $sn = '未知';
                break;
        }

        echo $this->status;
        return $sn;

    }


}

