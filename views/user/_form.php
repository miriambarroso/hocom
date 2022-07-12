<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Matriz;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(
            $options = ['disabled'=>(bool)$model->id]
            )->label(Yii::t('main', 'Username')) ?>

    <?= $form->field($model, 'matriz_id')->widget(Select2::class, [
            'data' =>ArrayHelper::map( Matriz::find()->all(),'id',function ($e){
               return $e->getMatrizName();
            }),
            'options' => [
                'placeholder' => Yii::t('main','Select a matriz'),
                'disabled' => (bool)$model->id,
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(Yii::t('main', 'Matriz'))
    ?>

    <?php $identity = Yii::$app->user->identity;
        if ($identity && $identity->role == 'gestor') {
            echo $form->field($model, 'role')->dropDownList(['gestor' => 'Gestor', 'estudante' => 'Estudante'])->label(Yii::t('main', 'Role'));
        }
    ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->label(Yii::t('main', 'Password')) ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', Yii::t('main','Save')), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
