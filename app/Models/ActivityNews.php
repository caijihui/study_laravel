<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ActivityNews extends Model
{
    use Searchable;

    protected $table = 'activity_news';
    protected $fillable = [
        'type_id',
        'title',
        'sub_title',
        'star_id',
        'content',
        'status',
        'is_open',
        'is_top',
    ];


    public static function getActivityIdByName($name)
    {
        return self::select('id')
            ->where([
//                ['status', '=', 1],
//                ['type_id', '=', 2],
                ['title', 'like', '%' . $name . '%']
            ])->get()->pluck('id');
    }

}