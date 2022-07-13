<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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

    public function behaviors()
    {
        return [
            'dateBeforeSave' => [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'data',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'data',
                ],
                'value' => function($event) {
                    $dateArray = explode('/', $this->data);
                    return $dateArray[2] . '-' . $dateArray[1] . '-'. $dateArray[0];
                }
            ],
            'dateAfterFind' => [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => 'data'
                ],
                'value' => function($event) {
                    $dateArray = explode('-', $this->data);
                    return $dateArray[2] . '/' . $dateArray[1] . '/'. $dateArray[0];
                }
            ]
        ];
    }

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

    public function upload()
    {
        if ($this->validate()) {
            $this->imagem->saveAs('uploads/' . $this->imagem->baseName . '.' . $this->imagem->extension);
            return true;
        } else {
            return false;
        }
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
