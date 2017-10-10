<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MarketingImage;

/**
 * MarketingImageSearch represents the model behind the search form about `backend\models\MarketingImage`.
 */

class MarketingImageSearch extends MarketingImage
{
    public $statusName;
    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['id', 'marketingImageIsFeatured', 'marketingImageIsActive', 'status_id'], 'integer'],
            [['marketingImagePath', 'marketingImageName', 'marketingImageCaption',
                'marketingImageCaptionTitle', 'marketingImageWeight', 'created_at',
                'status_name',  'updated_at'], 'safe'],
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
        $query = MarketingImage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->setSort([
            'attributes' => [
                'id',
                'marketingImageName',
                'marketingImagePath',
                'marketingImageCaption',
                'marketingImageCaptionTitle',
                'marketingImageIsFeatured',
                'marketingImageIsActive',
                'marketingImageWeight',
                'statusName' => [
                    'asc' => ['status.status_name' => SORT_ASC],
                    'desc' => ['status.status_name' => SORT_DESC],
                    'label' => 'Status'
                ],


            ]
        ]);

        if (!($this->load($params) && $this->validate())) {

            $query->joinWith(['status']);

            return $dataProvider;
        }

        $this->addSearchParameter($query, 'id');
        $this->addSearchParameter($query, 'marketingImageName', true);
        $this->addSearchParameter($query, 'marketingImagePath', true);
        $this->addSearchParameter($query, 'marketingImageCaption', true);
        $this->addSearchParameter($query, 'marketingImageCaptionTitle', true);
        $this->addSearchParameter($query, 'marketingImageIsFeatured');
        $this->addSearchParameter($query, 'marketingImageIsActive');
        $this->addSearchParameter($query, 'marketingImageWeight');
        $this->addSearchParameter($query, 'status_id');


        // filter by gender name

        $query->joinWith(['status' => function ($q) {

            $q->andFilterWhere(['=', 'status.status_name', $this->statusName]);

        }]);

        return $dataProvider;

    }

    protected function addSearchParameter($query, $attribute, $partialMatch = false)
    {
        if (($pos = strrpos($attribute, '.')) !== false) {
            $modelAttribute = substr($attribute, $pos + 1);
        } else {
            $modelAttribute = $attribute;
        }

        $value = $this->$modelAttribute;
        if (trim($value) === '') {
            return;
        }

        /*
      * The following line is additionally added for right aliasing
      * of columns so filtering happen correctly in the self join
      */

        $attribute = "marketingImage.$attribute";

        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}