<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tblrides */

$this->title = 'Update Route: ' . $model->r_name;
$this->params['breadcrumbs'][] = ['label' => 'Routes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->r_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tblrides-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUpdate', [
        'model' => $model,'model2' => $model2, 'model3' => $model3
    ]) ?>

</div>
