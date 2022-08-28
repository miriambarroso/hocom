<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MatrizEvento */

$this->title = Yii::t('app', 'Create Matriz Evento');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Matriz Eventos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matriz-evento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
