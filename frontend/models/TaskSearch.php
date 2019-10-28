<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Task;

/**
 * TaskSearch represents the model behind the search form of `common\models\Task`.
 */
class TaskSearch extends Task
{
    /**
     * {@inheritdoc}
     */

    public $projectName;
    public function rules()
    {
        return [
            [['id', 'author_id', 'status_id', 'priority_id', 'created_at', 'updated_at', 'project_id'], 'integer'],
            [['name', 'description'], 'safe'],
            [['projectName'], 'string']
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
        $query = Task::find();
        $query->where(['task.author_id'=>\Yii::$app->user->id]);
        $query->joinWith('project');

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
            'status_id' => $this->status_id,
            'priority_id' => $this->priority_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'project_id' => $this->project_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'project.name', $this->projectName]);


        return $dataProvider;
    }
}
