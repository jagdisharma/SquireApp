<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Users */

$this->title = $model->fname.' '.$model->lname;
$this->params['breadcrumbs'][] = ['label' => 'Drivers', 'url' => ['driver']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">
    <h1><?= Html::encode($this->title)?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'email:email',
            'fname',
            'lname',
            'username',
            'phone',
            'address',
            [   
                'attribute'=>'Type',
                'value'=> ($model->type == '1') ? 'Driver': 'User',
            ],
            [
                'attribute'=>'Status',
                'value'=> ($model->status == '1') ? 'In Active': 'Active',
            ],
            // [
            //     'attribute'=>'created_at',
            //     'label' => 'Created At(UTC)',
            //     'value'=> date('Y-m-d H:i:s', $model->created_at),
            // ],
            // [
            //     'attribute'=>'updated_at',
            //     'label' => 'Updated At(UTC)',
            //     'value'=> date('Y-m-d H:i:s', $model->updated_at),
            // ],
        ],
    ]) ?>

</div>
