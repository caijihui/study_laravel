## 实现功能

（数据库，查看 database/data.sql）

### 邮件发送及队列

-  邮件发送  /mail

### laravel自定义登录
- 登陆地址  /api/v1/login

### jwt 运用  
```bash 
    composer require tymon/jwt-auth:1.0.x-dev 
    
    php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
   
    php artisan jwt:secret
```

参考：[JWT 完整使用详解](https://laravel-china.org/articles/10885/full-use-of-jwt)

###  mq学习

- mq 文件夹

### laravel 事件和观察者模式

- /app/Event 



- /app/Observers

使用观察者模式需要在AppServiceProvider-> boot 中添加监听的model 和观察者类
如：Jobs::observe(JobsObserver::class);

有遇到没有触发事件的：
目前根据论坛查询和个人实践 
- save() , 
- find ($id)->update 
- first () ->update () 
是可以触发观察者事件 updated() 的。


### command 命令

示例，创建个command
```bash
    php artisan make:command changeDataCommand
```

- /app/Console/Commands
 
 执行命令格式：
```bash
    php artisan mg:changedata
```

###  resource 路由

```bash
    ## 快捷创建resource控制器
    php artisan make:controller UsersController --resource
```
- 路由中配置的这种情势路由代表下面的意思
Route::resource('users', 'UsersController');

| HTTP请求 |	URL | 动作 |	路由名称 | 作用 |
| ---- | :----: | :---: | :---: | :---: |
| GET |	/users |	UsersController@index |	users.index |显示所有用户列表的页面 |
| GET |	/users/{user} |	UsersController@show | users.show |	显示用户个人信息的页面 |
| GET |	/users/create |	UsersController@create | users.create |创建用户的页面 |
| POST |	/users |	UsersController@store	| users.store | 创建用户 |
| GET |	/users/{user}/edit | UsersController@edit | users.edit | 编辑用户个人资料的页面 |
| PATCH |	/users/{user} |	UsersController@update | users.update | 更新用户 |
| DELETE |	/users/{user} |	UsersController@destroy	| users.destroy | 删除用户 |
---------------------
