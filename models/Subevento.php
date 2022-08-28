<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * This is the model class for table "{{%subevento}}".
 *
 * @property int $id
 * @property string|null $nome
 * @property int|null $evento_id
 * @property int|null $ativo
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Certificado[] $certificados
 * @property Evento $evento
 * @property MatrizSubevento[] $matrizSubeventos
 */
class Subevento extends \yii\db\ActiveRecord
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
        return '{{%subevento}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'string'],
            [['evento_id', 'ativo', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['evento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Evento::class, 'targetAttribute' => ['evento_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Nome'),
            'evento_id' => Yii::t('app', 'Evento ID'),
            'ativo' => Yii::t('app', 'Ativo'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Certificados]].
     *
     * @return ActiveQuery|CertificadoQuery
     */
    public function getCertificados()
    {
        return $this->hasMany(Certificado::class, ['subevento_id' => 'id']);
    }

    /**
     * Gets query for [[Evento]].
     *
     * @return ActiveQuery|EventoQuery
     */
    public function getEvento()
    {
        return $this->hasOne(Evento::class, ['id' => 'evento_id']);
    }

    /**
     * Gets query for [[MatrizSubeventos]].
     *
     * @return ActiveQuery|MatrizEventoQuery
     */
    public function getMatrizSubeventos()
    {
        return $this->hasMany(MatrizSubevento::class, ['subevento_id' => 'id']);
    }

}
