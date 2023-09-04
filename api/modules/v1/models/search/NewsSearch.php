<?php

namespace api\modules\v1\models\search;

use api\modules\v1\models\News;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * SliderSearch represents the model behind the search form of `api\models\Slider`.
 */
class NewsSearch extends News
{
    /**
     * SliderSearch constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    /**
     * Creates data provider instance with search query applied
     * @return ActiveDataProvider
     */
    public function search(): ActiveDataProvider
    {
        $query = News::find();

        // grid filtering conditions

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
            'pagination' => false,
        ]);
    }
}
