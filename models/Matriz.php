<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%matriz}}".
 *
 * @property int $id
 * @property string|null $nome
 * @property int|null $ano
 * @property int|null $semestre
 * @property int|null $carga_horaria
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property MatrizEvento[] $thisEventos
 * @property User[] $users
 */
class Matriz extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%matriz}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ano', 'semestre', 'carga_horaria', 'created_by', 'updated_by'], 'integer'],
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
            'ano' => Yii::t('app', 'Ano'),
            'semestre' => Yii::t('app', 'Semestre'),
            'carga_horaria' => Yii::t('app', 'Carga Horaria'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * nome - ano/semestre
     *
     * @return int
     */
    public function getMatrizName()
    {
        if ($this->nome) {
            if ($this->ano) {
                if ($this->semestre) {
                    return $this->nome . ' - ' . $this->ano . '/' . $this->semestre;
                }
                return $this->nome . ' - ' . $this->ano;
            }
            return $this->nome . ' - ' . $this->semestre? '/' . $this->semestre : '';
        } elseif ($this->ano) {
            return $this->ano . $this->semestre ? '/' . $this->semestre : '';
        }
        return $this->semestre;
    }

    /**
     * Gets query for [[MatrizEventos]].
     *
     * @return \yii\db\ActiveQuery|MatrizEventoQuery
     */
    public function getMatrizEventos()
    {
        return $this->hasMany(MatrizEvento::class, ['matriz_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['matriz_id' => 'id']);
    }
}
