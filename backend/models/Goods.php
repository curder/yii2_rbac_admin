<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property integer $id
 * @property string $goods_name
 * @property integer $goods_number
 * @property string $goods_desc
 * @property string $created_at
 * @property string $updated_at
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_number'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['goods_name'], 'string', 'max' => 30],
            [['goods_desc'], 'string', 'max' => 120],
            [['goods_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_name' => '商品名称',
            'goods_number' => '商品库存',
            'goods_desc' => '商品描述',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }
}
