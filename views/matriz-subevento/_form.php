<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MatrizSubevento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matriz-subevento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'evento_id')->textInput() ?>

    <?= $form->field($model, 'subevento_id')->textInput() ?>

    <?= $form->field($model, 'matriz_evento_id')->textInput() ?>

    <?= $form->field($model, 'carga_horaria_max')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
