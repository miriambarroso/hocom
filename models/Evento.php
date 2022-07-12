<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%evento}}".
 *
 * @property int $id
 * @property string|null $nome
 * @property int|null $ativo
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property MatrizEvento[] $matrizEventos
 * @property MatrizSubevento[] $matrizSubeventos
 * @property Subevento[] $subeventos
 */
class Evento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%evento}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ativo', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nome'], 'string', 'max' => 255],
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
            'ativo' => Yii::t('app', 'Ativo'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[MatrizEventos]].
     *
     * @return \yii\db\ActiveQuery|MatrizEventoQuery
     */
    public function getMatrizEventos()
    {
        return $this->hasMany(MatrizEvento::class, ['evento_id' => 'id']);
    }

    /**
     * Gets query for [[MatrizSubeventos]].
     *
     * @return \yii\db\ActiveQuery|MatrizSubeventoQuery
     */
    public function getMatrizSubeventos()
    {
        return $this->hasMany(MatrizSubevento::class, ['evento_id' => 'id']);
    }

    /**
     * Gets query for [[Subeventos]].
     *
     * @return \yii\db\ActiveQuery|SubeventoQuery
     */
    public function getSubeventos()
    {
        return $this->hasMany(Subevento::class, ['evento_id' => 'id']);
    }
}
