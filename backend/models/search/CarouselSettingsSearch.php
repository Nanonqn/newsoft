<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CarouselSettings;

/**
 * CarouselSettingsSearch represents the model behind the search form about `backend\models\CarouselSettings`.
 */
class CarouselSettingsSearch extends CarouselSettings
{

    public $statusName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'carousel_autoplay', 'show_indicators',
                'show_captions', 'show_controls',
                'show_caption_background','show_caption_title',
                'status_id'], 'integer'],
            [['carousel_name', 'image_height', 'image_width', 'caption_font_size',
                'statusName', 'created_at', 'updated_at'], 'safe'],
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
        $query = CarouselSettings::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'carousel_name',
                'image_height',
                'image_width',
                'carousel_autoplay',
                'show_indicators',
                'show_captions',
                'show_caption_title',
                'show_caption_background',
                'caption_font_size',
                'show_controls',
                'statusName' => [
                    'asc' => ['status.status_name' => SORT_ASC],
                    'desc' => ['status.status_name' => SORT_DESC],
                    'label' => 'Status'
                ],
                'updated_at',


            ]
        ]);

        if (!($this->load($params) && $this->validate())) {

            $query->joinWith(['status']);

            return $dataProvider;
        }

        $this->addSearchParameter($query, 'id');
        $this->addSearchParameter($query, 'carousel_name', true);
        $this->addSearchParameter($query, 'image_height');
        $this->addSearchParameter($query, 'image_width');
        $this->addSearchParameter($query, 'carousel_autoplay');
        $this->addSearchParameter($query, 'show_indicators');
        $this->addSearchParameter($query, 'show_captions');
        $this->addSearchParameter($query, 'show_caption_title');
        $this->addSearchParameter($query, 'show_caption_background');
        $this->addSearchParameter($query, 'caption_font_size');
        $this->addSearchParameter($query, 'show_controls');
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

        $attribute = "carousel_settings.$attribute";

        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }


    public static function getCarouselSettings($carousel_name)
    {
        $carouselSettings = CarouselSettings::find()
            ->where(['carousel_name' => $carousel_name])
            ->one();

        return $carouselSettings;

    }
}