<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class changeDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mg:changedata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
         $ret =  DB::table('users')->get();
         $ret = $this->convertsArray($ret);
         $insertData = [];
         $time = date('Y-m-d H:i:s');
         foreach ($ret as $one){
            $insertData[] = [
                'name'=>$one['name'].'02',
                'password'=>$one['password'],
                'created_at'=>$time,
                'updated_at'=>$time,
            ];
         }
         DB::table('users')->insert($insertData);
    }


    public function convertsArray($object)
    {
        return collect($object)->map(function ($x) {
            return (array)$x;
        })->toArray();
    }
}
