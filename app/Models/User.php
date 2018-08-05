<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Model
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
}
