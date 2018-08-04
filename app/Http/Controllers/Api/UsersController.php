<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;

class UsersController extends Controller
{
	/**
	 * 用户注册
	 * @return [type] [description]
	 */
    public function store(UserRequest $request){

    	$verifyData = \Cache::get($request->verification_key);

        if (!$verifyData) {
            return $this->response->error('验证码已失效', 422);
        }


        if (!hash_equals($verifyData['code'], $request->verification_code)) {
            // 返回401
            return $this->response->errorUnauthorized('验证码错误');
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $verifyData['phone'],
            'password' => bcrypt($request->password),
        ]);

        if($user){
        	// 清除验证码缓存
       		\Cache::forget($request->verification_key);
       		// return $this->response->created();
       		$this->response->array($user->toArray());
        }else{
	        return $this->response->error('操作失败,请重试!', 422);
        }

        

        
    }
}
