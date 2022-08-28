<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%matriz_subevento}}".
 *
 * @property int $id
 * @property int|null $evento_id
 * @property int|null $subevento_id
 * @property int|null $matriz_evento_id
 * @property int|null $carga_horaria_max
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Evento $evento
 * @property MatrizEvento $matrizEvento
 * @property Subevento $subevento
 */
class MatrizSubevento extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestampBehaviors' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            'blameableBehaviors' => [
                'class' => BlameableBehavior::class,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%matriz_subevento}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['evento_id', 'subevento_id', 'matriz_evento_id', 'carga_horaria_max', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['evento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Evento::class, 'targetAttribute' => ['evento_id' => 'id']],
            [['matriz_evento_id'], 'exist', 'skipOnError' => true, 'targetClass' => MatrizEvento::class, 'targetAttribute' => ['matriz_evento_id' => 'id']],
            [['subevento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subevento::class, 'targetAttribute' => ['subevento_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'evento_id' => Yii::t('app', 'Evento ID'),
            'subevento_id' => Yii::t('app', 'Subevento ID'),
            'matriz_evento_id' => Yii::t('app', 'Matriz Evento ID'),
            'carga_horaria_max' => Yii::t('app', 'Carga Horaria Max'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Evento]].
     *
     * @return \yii\db\ActiveQuery|EventoQuery
     */
    public function getEvento()
    {
        return $this->hasOne(Evento::class, ['id' => 'evento_id']);
    }

    /**
     * Gets query for [[MatrizEvento]].
     *
     * @return \yii\db\ActiveQuery|MatrizEventoQuery
     */
    public function getMatrizEvento()
    {
        return $this->hasOne(MatrizEvento::class, ['id' => 'matriz_evento_id']);
    }

    /**
     * Gets query for [[Subevento]].
     *
     * @return \yii\db\ActiveQuery|SubeventoQuery
     */
    public function getSubevento()
    {
        return $this->hasOne(Subevento::class, ['id' => 'subevento_id']);
    }
}
