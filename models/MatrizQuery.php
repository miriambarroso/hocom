<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Matriz;

/**
 * MatrizQuery represents the model behind the search form of `app\models\Matriz`.
 */
class MatrizQuery extends Matriz
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ano', 'semestre', 'carga_horaria', 'created_by', 'updated_by'], 'integer'],
            [['nome', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Matriz::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ano' => $this->ano,
            'semestre' => $this->semestre,
            'carga_horaria' => $this->carga_horaria,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome]);
        $dataProvider->sort->attributes['nome'] = [
            'asc' => ['nome' => SORT_ASC],
            'desc' => ['nome' => SORT_DESC],
            'label' => Yii::t('main', 'Nome'),
            'default' => SORT_ASC
        ];
        return $dataProvider;
    }
}
