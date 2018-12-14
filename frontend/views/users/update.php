<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Users */

$this->title = 'Update User: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Drivers', 'url' => ['driver']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUpdate', [
        'model' => $model,
        'modelridesschedule' => $modelridesschedule,
        'modelrides' => $modelrides,
        'ridesArray' => $ridesArray,
        'schedulesArray' => $schedulesArray,
        'selectedSchduleId' => $selectedSchduleId
    ]) ?>

</div>
