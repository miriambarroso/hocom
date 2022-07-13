<?php

namespace app\models;

use Psr\Container\NotFoundExceptionInterface;
use Yii;
use yii\base\Exception;
use yii\db\ActiveQuery;
use Da\User\Model\User as BaseUser;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property int|null $username
 * @property string|null $role
 * @property string|null $password
 * @property int|null $matriz_id
 * @property string|null $auth_key
 *
 * @property Certificado[] $certificados
 * @property Matriz $matriz
 * @property string|null $matrizName
 */
class User extends BaseUser
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'matriz_id', 'password'], 'required'],
            [['username', 'matriz_id'], 'integer'],
            [['role'], 'string'],
            [['password', 'auth_key', 'email'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['matriz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Matriz::class, 'targetAttribute' => ['matriz_id' => 'id']],
            [['role'], 'default', 'value' => 'estudante'],
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

    /**
     * Gets query for [[$model->username]].
     *
     * @param $username
     * @return array|ActiveRecord|null
     */
    public static function findByUsername($username)
    {
        return self::find()->where(['username' => $username])->one();
    }

    /**
     * Gets query for [[$model->username]].
     *
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
    }


}
