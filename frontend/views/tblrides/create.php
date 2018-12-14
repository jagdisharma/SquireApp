<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Tblrides */

$this->title = 'Create Route';
$this->params['breadcrumbs'][] = ['label' => 'Routes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblrides-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,'model2'=>$model2,'model3'=>$model3
    ]) ?>

</div>
