<?php

use yii\db\Migration;

/**
 * Handles the creation for table `goods`.
 */
class m160905_014627_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'goods_name'=>$this->string(30)->unique()->comment('商品名称'),
            'goods_number'=>$this->smallInteger()->unsigned()->comment('商品库存'),
            'goods_desc'=>$this->string(120)->comment('商品描述'),
            'created_at'=>$this->timestamp()->comment('创建时间'),
            'updated_at'=>$this->timestamp()->comment('修改时间')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods');
    }
}
