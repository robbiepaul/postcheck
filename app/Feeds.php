<?php

namespace PostCheck;

use Illuminate\Database\Eloquent\Model;
use PostCheck\Core\Feeds\Twitter;
use PostCheck\Core\FeedService;

class Feeds extends Model
{
    protected $fillable = ['user_id', 'link', 'type', 'notify_by'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'last_checked_at'];

    public function user()
    {
        return $this->belongsTo('PostCheck\User');
    }

    public function checkNow()
    {
        $service = FeedService::get($this);
        try {
            $post = $service->getMostRecentPost();
            $last_id = $service->getId($post);
            $this->last_checked_id = $last_id;
            $this->last_checked_at = date('Y-m-d H:i:s');
            $this->save();

        } catch (\Exception $e) {
            dd($e);
        }

    }

}
