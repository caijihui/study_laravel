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