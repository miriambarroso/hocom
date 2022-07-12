<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\db\ActiveQuery;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $id
 * @property int|null $username
 * @property string|null $role
 * @property string|null $password
 * @property int|null $matriz_id
 * @property string|null $auth_key
 * @property int|null $ativo
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Certificado[] $certificados
 * @property Matriz $matriz
 * @property string|null $matrizName
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'matriz_id', 'ativo', 'created_by', 'updated_by'], 'integer'],
            [['role'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['password', 'auth_key'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['matriz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Matriz::class, 'targetAttribute' => ['matriz_id' => 'id']],
            [['role'], 'default', 'value' => 'estudante'],
            [['ativo'], 'default', 'value' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'role' => Yii::t('app', 'Role'),
            'password' => Yii::t('app', 'Password'),
            'matriz_id' => Yii::t('app', 'Matriz ID'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'ativo' => Yii::t('app', 'Ativo'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @throws Exception
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }

    /**
     * Gets query for [[Certificados]].
     *
     * @return ActiveQuery
     */
    public function getCertificados()
    {
        return $this->hasMany(Certificado::class, ['username' => 'username']);
    }

    /**
     * Gets query for [[Matriz]].
     *
     * @return ActiveQuery
     */
    public function getMatriz()
    {
        return $this->hasOne(Matriz::class, ['id' => 'matriz_id']);
    }

    /**
     * Gets query for [[$model->username]].
     *
     * @return int
     */
    public function getUsername()
    {
        return $this->username;
    }


    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string a chave de autenticação do usuário atual
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool se a chave de autenticação do usuário atual for válida
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}
