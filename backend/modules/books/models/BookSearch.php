<?php

namespace app\modules\books\models;

use common\modules\user\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\books\models\Book;
use yii\helpers\VarDumper;

/**
 * BookSearch represents the model behind the search form about `app\modules\book\models\Book`.
 */
class BookSearch extends Book
{
    public $user_name;

    public $user_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'author_id', 'book_type_id', 'genre_id', 'book_status', 'created_at', 'updated_at'], 'integer'],
            [['user_name', 'book_title'], 'safe'],
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
        if ($this->user_name != '') {
            $query->joinWith(['author']);
            $query->where(['user.user_name' => $this->user_name]);
        }

        else if ($params['author_id']){
            $query->joinWith(['author']);
            $query->where(['user.user_id' => $params['author_id']]);
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

    public function getUser_name()
    {
        return Book::getAuthorNameById($this->user_id);
    }
}
