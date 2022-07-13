<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%certificado}}".
 *
 * @property int $id
 * @property string|null $nome
 * @property int|null $quantidade_de_horas
 * @property int|null $validado
 * @property string|null $data
 * @property int|null $username
 * @property resource|null $imagem
 * @property int|null $subevento_id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Subevento $subevento
 * @property User $user
 */
class Certificado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%certificado}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantidade_de_horas', 'validado', 'username', 'subevento_id', 'created_by', 'updated_by'], 'integer'],
            [['data', 'created_at', 'updated_at'], 'safe'],
            [['imagem'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['nome'], 'string', 'max' => 255],
            [['subevento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subevento::class, 'targetAttribute' => ['subevento_id' => 'id']],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['username' => 'username']],
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
            'quantidade_de_horas' => Yii::t('app', 'Quantidade De Horas'),
            'validado' => Yii::t('app', 'Validado'),
            'data' => Yii::t('app', 'Data'),
            'username' => Yii::t('app', 'Username'),
            'imagem' => Yii::t('app', 'Imagem'),
            'subevento_id' => Yii::t('app', 'Subevento ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Subevento]].
     *
     * @return ActiveQuery
     */
    public function getSubevento()
    {
        return $this->hasOne(Subevento::class, ['id' => 'subevento_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['username' => 'username']);
    }

}
