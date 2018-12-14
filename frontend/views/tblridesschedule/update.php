<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tblridesschedule */

$this->title = 'Update Tblridesschedule: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tblridesschedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tblridesschedule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
