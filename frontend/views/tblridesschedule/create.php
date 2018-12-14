<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Tblridesschedule */

$this->title = 'Create Tblridesschedule';
$this->params['breadcrumbs'][] = ['label' => 'Tblridesschedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblridesschedule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
