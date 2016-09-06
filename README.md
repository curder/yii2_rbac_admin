## Yii2.0 Rbac 示例

### 说明
- 这只是一个基于Yii2.0.9 和 依赖 [mdmsoft/yii2-admin](https://github.com/mdmsoft/yii2-admin) 的RBAC的简单示例，为了界面的美观还使用了 [dmstr/yii2-adminlte-asset](https://github.com/dmstr/yii2-adminlte-asset) ,可以很方便的扩展一下应用到实际项目中。

### 安装
0. 安装前端依赖 `composer global require "fxp/composer-asset-plugin:^1.2.0"`

1. clone代码到本地, 地址:`git clone git@github.com:curder/yii2_rbac_admin.git`

2. 保证系统安装了[composer](https://getcomposer.org/download/),来到clone的目录使用`composer install`下载相关依赖。

3. 修改数据库连接信息
	- 数据库建库语句 `create database yii2advanced charset utf8;`
	- 数据库授权语句 `grant all on yii2advaced.* to yii2advanced@localhost identified by 'yii2advanced_password';`
   - 修改配置文件`<project>/common/config/main-local.php`的数据库连接
	
	```
	'db' => [
	    'class' => 'yii\db\Connection',
	    'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
	    'username' => 'yii2advanced',
	    'password' => 'yii2advanced_password',
	    'charset' => 'utf8',
	],
	```

4. 执行迁移(在项目根目录下)
	```shell
	php yii migrate --migrationPath=@mdm/admin/migrations
	php yii migrate --migrationPath=@yii/rbac/migrations
	```

5. 配置虚拟主机
	以nginx的虚拟主机为例进行配置
	
	```
	server {
	    charset utf-8;
	    client_max_body_size 128M;
	
	    listen 81;
	
	    server_name 192.168.207.128;
	    root        /usr/local/nginx/html/yii2/yii2_rbac_admin/backend/web;
	    index       index.php;
	
	    access_log  logs/backend_access.log;
	    error_log   logs/backend_error.log;
	
	    location / {
	        try_files $uri $uri/ /index.php$is_args$args;
	    }
	
	    # uncomment to avoid processing of calls to non-existing static files by Yii
	    #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
	    #    try_files $uri =404;
	    #}
	    #error_page 404 /404.html;
	
	    location ~ \.php$ {
	        include fastcgi_params;
	        fastcgi_param SCRIPT_FILENAME $document_root/$fastcgi_script_name;
	        fastcgi_index  index.php;
	        fastcgi_pass   127.0.0.1:9000;
	        #fastcgi_pass unix:/var/run/php5-fpm.sock;
	        try_files $uri =404;
	    }
	
	    location ~ /\.(ht|svn|git) {
	        deny all;
	    }
	}
	```

6. 访问后台
访问后台，地址`http://192.168.207.128:81/index.php?r=site%2Flogin`查看效果。

7. 登录后台访问`/admin/menu/create`


### URLs
登录： `/site/login`

角色列表：`/admin/role/index`

用户列表：`/admin/user/index`

分配用户到角色： `/admin/assignment/index`

权限列表：`/admin/permission/index`

路由列表：`/admin/route/index`

规则列表: `/admin/rule/index`

菜单列表：`/admin/menu/index`







