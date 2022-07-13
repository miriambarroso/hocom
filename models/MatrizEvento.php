<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%matriz_evento}}".
 *
 * @property int $id
 * @property int|null $evento_id
 * @property int|null $matriz_id
 * @property int|null $carga_horaria_max
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Evento $evento
 * @property Matriz $matriz
 * @property MatrizSubevento[] $matrizSubeventos
 */
class MatrizEvento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%matriz_evento}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['evento_id', 'matriz_id', 'carga_horaria_max', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['evento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Evento::className(), 'targetAttribute' => ['evento_id' => 'id']],
            [['matriz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Matriz::className(), 'targetAttribute' => ['matriz_id' => 'id']],
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
            'matriz_id' => Yii::t('app', 'Matriz ID'),
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
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getEvento()
    {
        return $this->hasOne(Evento::className(), ['id' => 'evento_id']);
    }

    /**
     * Gets query for [[Matriz]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getMatriz()
    {
        return $this->hasOne(Matriz::className(), ['id' => 'matriz_id']);
    }

    /**
     * Gets query for [[MatrizSubeventos]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getMatrizSubeventos()
    {
        return $this->hasMany(MatrizSubevento::className(), ['matriz_evento_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return MatrizEventoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MatrizEventoQuery(get_called_class());
    }
}
