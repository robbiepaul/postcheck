<?php

namespace PostCheck;

use Illuminate\Foundation\Auth\User as Authenticatable;
use SammyK\LaravelFacebookSdk\SyncableGraphNodeTrait;

class User extends Authenticatable
{
    use SyncableGraphNodeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role',
        'facebook_user_id',
        'access_token',
    ];

    protected $guarded = ['id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'access_token'
    ];

    protected static $graph_node_fillable_fields = ['name', 'facebook_user_id', 'email'];

    protected static $graph_node_field_aliases = [
        'id' => 'facebook_user_id',
        'name' => 'name'
    ];

    public function feeds()
    {
        return $this->hasMany('PostCheck\Feeds');
    }

}
