<?php namespace PostCheck\Core;


use PostCheck\Feeds;

class FeedService
{
    protected static $notifyOptions = [
        'email' => 'Email',
        'sms' => 'SMS',
        'none' => 'None',
    ];

    protected static $classes = [
        'twitter' => 'PostCheck\Core\Feeds\Twitter'
    ];

    protected static $instances = [];

    public static function notifyOptions()
    {
        return self::$notifyOptions;
    }

    public static function get(Feeds $feed)
    {
        $classname = self::$classes[$feed->type];
        return class_exists($classname) ? new $classname($feed) : null;
    }

    public static function type($link)
    {
        switch(true) {
            case preg_match('/twitter.com/i', $link, $matches):
                return 'twitter';
            case preg_match('/facebook.com/i', $link, $matches):
                return 'facebook';
            default:
                return 'website';
        }
    }


}