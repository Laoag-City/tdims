<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    protected $hidden = [
        'password',
    ];

    //https://stackoverflow.com/questions/43467328/laravel-5-authentication-without-remember-token
    //https://laravel.io/forum/05-21-2014-how-to-disable-remember-token
    public function setAttribute($key, $value)
	{
    	$isRememberTokenAttribute = $key == $this->getRememberTokenName();
    	if (!$isRememberTokenAttribute)
    	{
    		parent::setAttribute($key, $value);
    	}
	}
}
