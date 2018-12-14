<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tblrides */

$this->title = $model->r_name;
$this->params['breadcrumbs'][] = ['label' => 'Route', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;



?>
<?php $this->registerJsFile('js/moment.js', [yii\web\JqueryAsset::className()]); ?>

<div class="tblrides-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this Route?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'r_name',
            's_location',
            //'start_latitute',
            //'start_longitude',
            'd_location',
            //'end_latitude',
            //'end_longitude',
            // [   
            //     'attribute'=>'created_at',
            //     'label' => 'Created At(UTC)',
            //     'format' => 'raw',
            //     'value'=> '<span class="createdAt" data-time="'.$model->created_at.'">'.date('Y-m-d H:i:s',$model->created_at).'</span>',
            // ],
            // [
            //     'attribute'=>'updated_at',
            //     'label' => 'Updated At(UTC)',
            //     'format' => 'raw',
            //     'value'=> '<span class="updatedAt" data-time="'.$model->updated_at.'">'.date('Y-m-d H:i:s', $model->updated_at).'</span>',
            // ],  
        ],
    ]) ?>

</div>
<?php 
// $this->registerJs(' 
//     jQuery(document).ready(function() {
//         console.log("createdAt------", new Date($(".createdAt").text()));
//         console.log("updatedAt-------", new Date($(".updatedAt").text()));
//         var offset = new Date().getTimezoneOffset();
//         console.log(offset);
//         var createdAt = moment(new Date($(".createdAt").text())).add(+330, "minutes").utcOffset(+330).format("YYYY-MMM-DD h:mm A");
//         var updatedAt = moment(new Date($(".updatedAt").text())).add(-(offset), "minutes").utcOffset(-(offset)).format("YYYY-MMM-DD h:mm A");
//         $(".createdAt").text(createdAt).show();
//         $(".updatedAt").text(updatedAt).show();
//     }); 
//  ')
?>