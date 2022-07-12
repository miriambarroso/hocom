<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubEvent */

$this->title = Yii::t('app', 'Create Sub Event');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
