<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

class life extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'heart:life';

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

        $uuid = Uuid::uuid1()->getHex();
        $date = now()->format('Y-m-d H:i:s');
        Article::create(['uuid'=>$uuid,'title'=>'v1','content'=>"当前 入库时间： $date"]);
        echo "success";

    }
}
