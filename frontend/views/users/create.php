<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Users */

$this->title = 'Create Driver';
$this->params['breadcrumbs'][] = ['label' => 'Drivers', 'url' => ['driver']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelrides' => $modelrides,
        'modelridesschedule' => $modelridesschedule,
        'ridesArray' => $ridesArray,
        'schedulesArray' => $schedulesArray
    ]) ?>

</div>
