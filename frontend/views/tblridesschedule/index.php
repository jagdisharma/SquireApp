<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TblridesscheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tblridesschedules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblridesschedule-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tblridesschedule', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ride_id',
            'start_time:datetime',
            'created_at',
            'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
