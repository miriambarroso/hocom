<?php

use app\models\Evento;
use app\models\Matriz;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MatrizEvento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matriz-evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'evento_id')->widget(Select2::class, [
        'data' =>ArrayHelper::map( Evento::find()->all(),'id','nome'),
        'options' => [
            'placeholder' => Yii::t('main','Select o Evento'),
            'disabled' => (bool)$model->id,
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(Yii::t('main', 'Evento'))
    ?>

    <?= $form->field($model, 'matriz_id')->widget(Select2::class, [
        'data' =>ArrayHelper::map( Matriz::find()->all(),'id','nome'),
        'options' => [
            'placeholder' => Yii::t('main','Select o Evento'),
            'disabled' => (bool)$model->id,
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(Yii::t('main', 'Evento'))
    ?>

    <?= $form->field($model, 'carga_horaria_max')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
