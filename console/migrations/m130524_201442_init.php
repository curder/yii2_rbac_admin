<?php

use yii\db\Migration;
use mdm\admin\models\User;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        // add user
        $admin = new User;
        $admin->username = 'admin';
        $admin->setPassword('admin123');
        $admin->generateAuthKey();
        $admin->email = 'admin@admin.com';
        $admin->save();

        $test = new User;
        $test->username = 'test';
        $test->setPassword('test123');
        $test->generateAuthKey();
        $test->email = 'test@admin.com';
        $test->save();


    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
