<?php

namespace App\Observers;


use App\Models\Jobs;
use Exception;
use Illuminate\Support\Facades\Log;

class JobsObserver
{


    public function updating(Jobs $jobs)
    {

        info(' updating-- start');

        $parent = Jobs::find($jobs->id);
        //var_dump($parent);
        info(json_encode($parent).'updating   end!!!');
       // $this->handle($jobs);

    }

    public function creating(Jobs $jobs)
    {

        info("新增一个了".$jobs->id);
        Jobs::find($jobs->id);
        info(' add  end !!!!');
    }



    public function handle($jobs)
    {
        $jobs->updated_at = date('Y-m-d H:i:s', time());
        //$jobs->save();

    }



}