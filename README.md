## Yii2.0 Rbac 示例

### 说明
- 这只是一个基于Yii2.0.9 和 依赖[mdmsoft/yii2-admin](https://github.com/mdmsoft/yii2-admin) 的RBAC的简单示例，为了界面的美观还使用了[dmstr/yii2-adminlte-asset](https://github.com/dmstr/yii2-adminlte-asset),可以很方便的扩展一下应用到实际项目中。

### 安装

1. clone代码到本地, 地址:`git clone git@github.com:curder/yii2_rbac_admin.git`

2. 保证系统安装了[composer](https://getcomposer.org/download/),来到clone的目录使用`composer install`下载相关依赖。

3. 修改配置文件`<project>/common/config/main.php`的数据库连接

4. 执行迁移(在项目根目录下)
```shell
php yii migrate --migrationPath=@mdm/admin/migrations
php yii migrate --migrationPath=@yii/rbac/migrations
```







