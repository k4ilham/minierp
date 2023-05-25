<?php

namespace app\models\hrd;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\hrd\Translog;

/**
 * TranslogSearch represents the model behind the search form of `app\models\hrd\Translog`.
 */
class TranslogSearch extends Translog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_log', 'id_user', 'created_by', 'updated_by'], 'integer'],
            [['timelog', 'desc', 'userIP', 'scriptUrl', 'scriptFile', 'pathInfo', 'port', 'method', 'origin', 'userAgent', 'created_at', 'updated_at'], 'safe'],
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
        $query = Translog::find();

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
            'id_log' => $this->id_log,
            'timelog' => $this->timelog,
            'id_user' => $this->id_user,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'userIP', $this->userIP])
            ->andFilterWhere(['like', 'scriptUrl', $this->scriptUrl])
            ->andFilterWhere(['like', 'scriptFile', $this->scriptFile])
            ->andFilterWhere(['like', 'pathInfo', $this->pathInfo])
            ->andFilterWhere(['like', 'port', $this->port])
            ->andFilterWhere(['like', 'method', $this->method])
            ->andFilterWhere(['like', 'origin', $this->origin])
            ->andFilterWhere(['like', 'userAgent', $this->userAgent]);

        return $dataProvider;
    }
}
