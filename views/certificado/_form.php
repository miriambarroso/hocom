<?php

use app\models\Subevento;
use app\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Certificado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="certificado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantidade_de_horas')->textInput() ?>

    <?= $form->field($model, 'validado')->textInput() ?>

    <?= $form->field($model, 'data')->widget(DatePicker::class,
        [
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'options' => [
                'format' => 'dd/mm/yyyy',
                'required'=>true,
                'autoclose' => true,
                'minDate' => '2010-01-01',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                    'yearRange' => '1980:'.date('Y'),
                ],
            ],
               'pluginOptions' => ['minDate' => '2010-01-01']

        ]) ?>

    <?= $form->field($model, 'username')->widget(Select2::class, [
        'data' =>ArrayHelper::map( User::find()->all(),'username','username'),
        'options' => [
            'placeholder' => Yii::t('main','Select o username'),
            'disabled' => (bool)$model->id,
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(Yii::t('main', 'Username'))
    ?>

    <?= $form->field($model, 'imagem')->fileInput() ?>

    <?= $form->field($model, 'subevento_id')->widget(Select2::class, [
        'data' =>ArrayHelper::map( Subevento::find()->all(),'id','nome'),
        'options' => [
            'placeholder' => Yii::t('main','Select o subevento'),
            'disabled' => (bool)$model->id,
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(Yii::t('main', 'Sub-evento'))
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
