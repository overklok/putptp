<?php

namespace app\modules\users\models;

use common\modules\user\models\UserSettings;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form about `app\modules\admin\models\User`.
 */
class UserSearch extends Model
{
    public $user_id;
    public $user_name;
    public $user_first_name;
    public $user_last_name;
    public $user_DOB;
    public $user_email;
    public $user_status;
    public $date_from;
    public $date_to;
   // public $age;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'user_status'], 'integer'],
            [['user_name', 'user_first_name', 'user_last_name'], 'string'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'ID',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
            'user_name' => 'Username',
            'user_email' => 'Email',
            'user_DOB' => 'Date of Birth',
            'user_status' => 'Status',
            'date_from' => 'Date From',
            'date_to' => 'Date To',
            'age' => 'Age',
        ];
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['user_id' => SORT_DESC],
            ]
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            $query->joinWith(['settings']);
            return $dataProvider;
        }
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'user_status' => $this->user_status,
        ]);
        $query
            ->andFilterWhere(['like', 'user_name', $this->user_name])
           // ->andFilterWhere(['like', 'user_first_name', $this->user_first_name])
        //	->andFilterWhere(['like', 'user_last_name', $this->user_last_name])
            ->andFilterWhere(['>=', 'user_DOB', $this->age])
            ->andFilterWhere(['>=', 'user.created_at', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            ->andFilterWhere(['<=', 'user.created_at', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null]);

        $query->joinWith(['settings' => function ($q)
        {
            $q->where(['like', 'user_settings.user_first_name', $this->user_first_name])
              ->where(['like', 'user_settings.user_last_name', $this->user_last_name]);
            //('user_settings.user_first_name LIKE ' . $this->user_first_name);
        }]);

        return $dataProvider;
    }

}