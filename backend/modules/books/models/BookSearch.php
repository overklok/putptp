<?php

namespace app\modules\books\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\books\models\Book;

/**
 * BookSearch represents the model behind the search form about `app\modules\books\models\Book`.
 */
class BookSearch extends Book
{
    public $user_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'author_id', 'book_type_id', 'genre_id', 'book_status', 'created_at', 'updated_at'], 'integer'],
            [['user_name', 'book_title', 'book_description', 'book_images_url'], 'safe'],
            ['user_name', 'string'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Book::find();
        if ($this->user_name != '')
        {
            $query->joinWith(['author' => function ($query)
            {
                $query->where(['user.user_name' => $this->user_name]);
            }
            ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['book_id' => SORT_DESC],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'book_id' => $this->book_id,
            'book_status' => $this->book_status,
        ]);

        $query->andFilterWhere(['like', 'book_title', $this->book_title])
              ->andFilterWhere(['like', 'book_type_id', $this->book_type_id])
              ->andFilterWhere(['like', 'genre_id', $this->genre_id]);


        return $dataProvider;
    }
}
