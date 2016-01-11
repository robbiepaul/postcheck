<?php namespace PostCheck\Core\Feeds;

use PostCheck\Feeds;

class Twitter implements FeedInterface
{

    protected $feed;

    public function __construct(Feeds $feed)
    {
        $this->feed = $feed;
    }

    public function getRecentPosts()
    {
        $username = self::getUsernameFromUrl($this->feed->link);
        $recent = collect(\TwitterAPI::getUserTimeline(['screen_name' => $username, 'count' => 20, 'format' => 'object']));
        $tweets = $recent->reject(function($t){
            return !empty($t->in_reply_to_status_id) || $t->retweeted == true;
        });
        return $tweets;
    }

    public static function getUsernameFromUrl($url)
    {
        if(preg_match('/https?:\/\/twitter.com\/[#!\/]?([^\/]*)/i', $url, $matches)) {
            return $matches[1];
        }
    }

    public function getMostRecentPost()
    {
        return $this->getRecentPosts()->first();
    }

    // make abstract
    public function getId($post)
    {
        return $post->id;
    }

}