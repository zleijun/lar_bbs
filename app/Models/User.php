<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use SoftDeletes;
	//此为填充,表示哪些数据可添加到数据可
	protected $fillable = [
		'name','email','password','phone','remember_token','avatar','introduction','notification_count','last_actived_at','deleted_at','weixin_openid','weixin_unionid'
	];
	//时间戳化整型
	// protected $dateFormat = 'U';
	//表示这些字段存时间戳的
	protected $dates = ['created_at','updated_at','deleted_at'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
