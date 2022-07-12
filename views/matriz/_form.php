<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Matriz */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matriz-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?php
    $script = <<< SCRIPT
        function (chrs, buffer, pos, strict, opts) {
           var valExp2 = new RegExp("4[0-5]|[01][0-9]");
           return valExp2.test(buffer[pos - 1] + chrs);
        }
SCRIPT;
    echo $form->field($model, 'ano')->widget(MaskedInput::class, [
        'mask' => 'y',
        'definitions' => ['y' => [
            'validator' => new \yii\web\JsExpression($script),
            'cardinality' => 4,
            'definitionSymbol' => 'i'
        ]],
        'options' =>['class' => 'required col-lg-3 form-control'],
        'clientOptions' => [
            'removeMaskOnSubmit' => true
        ]
    ]); ?>

    <?= $form->field($model, 'semestre')->textInput() ?>

    <?= $form->field($model, 'carga_horaria')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
