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


默认SQL

```sql
DROP TABLE IF EXISTS `auth_assignment`;

LOCK TABLES `auth_assignment` WRITE;
INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`)
VALUES
    ('一般用户','2',1473145480),
    ('管理员','1',1473145464);

UNLOCK TABLES;

LOCK TABLES `auth_item` WRITE;
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`)
VALUES
    ('/*',2,NULL,NULL,NULL,1473145707,1473145707),
    ('/admin/*',2,NULL,NULL,NULL,1473145524,1473145524),
    ('/admin/assignment/assign',2,NULL,NULL,NULL,1473145340,1473145340),
    ('/admin/assignment/index',2,NULL,NULL,NULL,1473144337,1473144337),
    ('/admin/assignment/revoke',2,NULL,NULL,NULL,1473145340,1473145340),
    ('/admin/assignment/view',2,NULL,NULL,NULL,1473145340,1473145340),
    ('/admin/default/index',2,NULL,NULL,NULL,1473144220,1473144220),
    ('/admin/menu/create',2,NULL,NULL,NULL,1473145343,1473145343),
    ('/admin/menu/delete',2,NULL,NULL,NULL,1473145343,1473145343),
    ('/admin/menu/index',2,NULL,NULL,NULL,1473144222,1473144222),
    ('/admin/menu/update',2,NULL,NULL,NULL,1473145343,1473145343),
    ('/admin/menu/view',2,NULL,NULL,NULL,1473145343,1473145343),
    ('/admin/permission/assign',2,NULL,NULL,NULL,1473145345,1473145345),
    ('/admin/permission/create',2,NULL,NULL,NULL,1473145345,1473145345),
    ('/admin/permission/delete',2,NULL,NULL,NULL,1473145345,1473145345),
    ('/admin/permission/index',2,NULL,NULL,NULL,1473144337,1473144337),
    ('/admin/permission/remove',2,NULL,NULL,NULL,1473145345,1473145345),
    ('/admin/permission/update',2,NULL,NULL,NULL,1473145345,1473145345),
    ('/admin/permission/view',2,NULL,NULL,NULL,1473145345,1473145345),
    ('/admin/role/assign',2,NULL,NULL,NULL,1473145349,1473145349),
    ('/admin/role/create',2,NULL,NULL,NULL,1473145349,1473145349),
    ('/admin/role/delete',2,NULL,NULL,NULL,1473145349,1473145349),
    ('/admin/role/index',2,NULL,NULL,NULL,1473144337,1473144337),
    ('/admin/role/remove',2,NULL,NULL,NULL,1473145349,1473145349),
    ('/admin/role/update',2,NULL,NULL,NULL,1473145349,1473145349),
    ('/admin/role/view',2,NULL,NULL,NULL,1473145349,1473145349),
    ('/admin/route/assign',2,NULL,NULL,NULL,1473145351,1473145351),
    ('/admin/route/create',2,NULL,NULL,NULL,1473145351,1473145351),
    ('/admin/route/index',2,NULL,NULL,NULL,1473144337,1473144337),
    ('/admin/route/refresh',2,NULL,NULL,NULL,1473145351,1473145351),
    ('/admin/route/remove',2,NULL,NULL,NULL,1473145351,1473145351),
    ('/admin/rule/create',2,NULL,NULL,NULL,1473145353,1473145353),
    ('/admin/rule/delete',2,NULL,NULL,NULL,1473145353,1473145353),
    ('/admin/rule/index',2,NULL,NULL,NULL,1473144337,1473144337),
    ('/admin/rule/update',2,NULL,NULL,NULL,1473145353,1473145353),
    ('/admin/rule/view',2,NULL,NULL,NULL,1473145353,1473145353),
    ('/admin/user/activate',2,NULL,NULL,NULL,1473145356,1473145356),
    ('/admin/user/change-password',2,NULL,NULL,NULL,1473145356,1473145356),
    ('/admin/user/delete',2,NULL,NULL,NULL,1473145356,1473145356),
    ('/admin/user/index',2,NULL,NULL,NULL,1473144337,1473144337),
    ('/admin/user/login',2,NULL,NULL,NULL,1473145356,1473145356),
    ('/admin/user/logout',2,NULL,NULL,NULL,1473145356,1473145356),
    ('/admin/user/request-password-reset',2,NULL,NULL,NULL,1473145356,1473145356),
    ('/admin/user/reset-password',2,NULL,NULL,NULL,1473145356,1473145356),
    ('/admin/user/signup',2,NULL,NULL,NULL,1473145356,1473145356),
    ('/admin/user/view',2,NULL,NULL,NULL,1473145356,1473145356),
    ('/site/*',2,NULL,NULL,NULL,1473145527,1473145527),
    ('/site/error',2,NULL,NULL,NULL,1473145361,1473145361),
    ('/site/index',2,NULL,NULL,NULL,1473145361,1473145361),
    ('/site/login',2,NULL,NULL,NULL,1473145361,1473145361),
    ('/site/logout',2,NULL,NULL,NULL,1473145361,1473145361),
    ('一般用户',1,'一般用户拥有普通查看权限',NULL,NULL,1473145320,1473145320),
    ('未登录用户',1,'未登录用户权限',NULL,NULL,1473145387,1473145410),
    ('管理员',1,'全站权限',NULL,NULL,1473145291,1473145291);

UNLOCK TABLES;


DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `auth_item_child` WRITE;

INSERT INTO `auth_item_child` (`parent`, `child`)
VALUES
    ('管理员','/*'),
    ('一般用户','/admin/assignment/index'),
    ('一般用户','/admin/assignment/view'),
    ('一般用户','/admin/default/index'),
    ('一般用户','/admin/menu/index'),
    ('一般用户','/admin/menu/view'),
    ('一般用户','/admin/permission/index'),
    ('一般用户','/admin/permission/view'),
    ('一般用户','/admin/role/index'),
    ('一般用户','/admin/role/view'),
    ('一般用户','/admin/route/index'),
    ('一般用户','/admin/rule/index'),
    ('一般用户','/admin/rule/view'),
    ('一般用户','/admin/user/index'),
    ('一般用户','/admin/user/view'),
    ('未登录用户','/site/error'),
    ('未登录用户','/site/login'),
    ('未登录用户','/site/logout');

UNLOCK TABLES;


DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `menu` WRITE;

INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`)
VALUES
    (1,'权限管理',NULL,'/admin/default/index',1,NULL),
    (2,'角色列表',1,'/admin/role/index',2,NULL),
    (3,'权限列表',1,'/admin/permission/index',3,NULL),
    (4,'路由列表',1,'/admin/route/index',4,NULL),
    (5,'规则管理',1,'/admin/rule/index',5,NULL),
    (6,'分配用户到角色',1,'/admin/assignment/index',6,NULL),
    (7,'菜单列表',1,'/admin/menu/index',7,NULL),
    (8,'用户列表',1,'/admin/user/index',8,NULL);

UNLOCK TABLES;
```




