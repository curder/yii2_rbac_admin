<?php

use yii\db\Migration;
use mdm\admin\models\User;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        // add user
        $user = new User;
        $user->username = 'admin';
        $user->password_hash = 'admin123';
        $user->email = 'admin@admin.com';
        $user->save();

        $user->username = 'test';
        $user->password_hash = 'test123';
        $user->email = 'test@admin.com';
        $user->save();


    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
