<?php namespace PostCheck\Core\Feeds;

interface FeedInterface
{
    public function getRecentPosts();
    public function getMostRecentPost();
}