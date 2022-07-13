<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MatrizSubevento */

$this->title = Yii::t('app', 'Create Matriz Subevento');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Matriz Subeventos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matriz-subevento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
