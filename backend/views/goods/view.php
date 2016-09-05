<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (Helper::checkRoute('update')) { 
        echo Html::a('Update ', ['update','id' => $model->id], ['class' => 'btn btn-success']); }?>

        <?php if  (Helper::checkRoute('delete')) { 
Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]); } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'goods_name',
            'goods_number',
            'goods_desc',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
