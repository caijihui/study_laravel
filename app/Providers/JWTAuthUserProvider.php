<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider as UserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class JWTAuthUserProvider extends UserProvider
{

    /**
     * 验证用户密码是否正确
     * @param UserContract $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plain = $credentials['password'];
        return md5($plain) === $user->getAuthPassword();
    }

    /**
     * 支持用户名和密码登录，重写该方法
     * @param array $credentials
     * @return UserContract|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function retrieveByCredentials(array $credentials)
    {
        $query = $this->createModel()->newQuery();

        $query->from('users')
            ->where('email', '=', $credentials['username'])
            ->orWhere('name', '=', $credentials['username']);

        return $query->first();
    }

    public function retrieveById($identifier)
    {
        $query = $this->createModel()->newQuery();

        $query->from('users as a')
            ->where('a.id', '=', $identifier);

        return $query->first();
    }
}