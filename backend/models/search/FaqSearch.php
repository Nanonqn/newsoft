<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\ActiveQuery;
use yii\db\Query;
use backend\models\Faq;
use yii\data\SqlDataProvider;

/**
 * FaqSearch represents the model behind the search form about `backend\models\Faq`.
 */
class FaqSearch extends Faq
{
            public $faqCategoryName;
            public $faqCategoryList;
            public $faqIsFeaturedName;
            public $createdByUsername;
            public $updatedByUsername;
            public $faqCategory;
            public $faqWeight;
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'faqCategory_id', 'faqWeight', 'faqIsFeatured', 'created_by', 'updated_by'], 'integer'],
            [['faqQuestion', 'faqAnswer', 'created_at', 'updated_at','faqCategoryName', 'faqCategoryList', 'faqIsFeaturedName',
            'createdByUsername', 'updatedByUsername', 'faqCategory', 'faqWeight'], 'safe'],
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
        $query = Faq::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
           
        ]);
        
         /**
     * Setup your sorting attributes
     * Note: This is setup before the $this->load($params) 
     * statement below
     */
     $dataProvider->setSort([
     
        'defaultOrder' => [
            'faqWeight' => SORT_ASC, 
            
        ],
   
        'attributes' => [
            'id',
            'faqQuestion' => [
                'asc' => ['faq.faqQuestion' => SORT_ASC],
                'desc' => ['faq.faqQuestion' => SORT_DESC],
                'label' => 'Pregunta'
            ],
            'faqAnswer' => [
                'asc' => ['faq.faqAnswer' => SORT_ASC],
                'desc' => ['faq.faqAnswer' => SORT_DESC],
                'label' => 'Respuesta'
            ],
            
            'faqCategoryName' => [
                'asc' => ['faqCategory.faqCategoryName' => SORT_ASC],
                'desc' => ['faqCategory.faqCategoryName' => SORT_DESC],
                'label' => 'Categoria'
            ],
           
                    
            'faqWeight' => [
                'asc' => ['faq.faqWeight' => SORT_ASC],
                'desc' => ['faq.faqWeight' => SORT_DESC],
                'label' => 'Importancia'
            ],
             'faqIsFeaturedName' => [
                'asc' => ['faq.faqIsFeatured' => SORT_ASC],
                'desc' => ['faq.faqIsFeatured' => SORT_DESC],
                'label' => 'Destacada?'
            ],
            
           
        ]
    ]);

        if (!($this->load($params) && $this->validate())) {
            
             $query->joinWith(['faqCategory']);
            
            return $dataProvider;
        }

        $this->addSearchParameter($query, 'id');
        $this->addSearchParameter($query, 'faqCategory_id');
        $this->addSearchParameter($query, 'faqWeight');
        $this->addSearchParameter($query, 'faqIsFeatured');
        $this->addSearchParameter($query, 'created_by');
        $this->addSearchParameter($query, 'updated_by');
        $this->addSearchParameter($query, 'faqQuestion', true);
        $this->addSearchParameter($query, 'faqAnswer', true);
       
         
        
         // filter by category
    $query->joinWith(['faqCategory' => function ($q) {
        $q->andFilterWhere(['=', 'faqCategory.faqCategoryName', $this->faqCategoryName]);
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
        $attribute = "faq.$attribute";
        
        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
    
    public function frontendProvider()
    {
    	
    	$query = new Query;
    	$provider = new ArrayDataProvider([
    			'allModels' => $query->from('faq')->all(),
    			'sort' => [
    					'defaultOrder' => [
    							'faqWeight' => SORT_ASC,
    							
    					],
    					'attributes' => ['faqQuestion', 'faqAnswer', 'faqWeight'],
    			],
    			'pagination' => [
    					'pageSize' => 10,
    			],
    	]);
    	
    	return $provider;
    	
    }

    /*public function featuredProvider()
    {

        $query = new Query;
        $featuredProvider = new ArrayDataProvider([
            'allModels' => $query->from('faq')->where(['faqIsFeatured' =>1])->all(),
            'sort' => [
                'defaultOrder' => [
                    'faq_weight' => SORT_ASC,

                ],
                'attributes' => ['faqQuestion', 'faqAnswer', 'faqWeight'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $featuredProvider;

    }*/

    public function featuredProvider()
    {

        $count = Yii::$app->db->createCommand('
                SELECT COUNT(*) FROM `faq` WHERE `faqIsFeatured` = :faqIsFeatured', [':faqIsFeatured' => 1])->queryScalar();

        $featuredProvider = new SqlDataProvider([
            'sql' => 'SELECT * FROM `faq` WHERE `faqIsFeatured` = :faqIsFeatured ORDER BY `faqWeight` ASC',
            'params' => [':faqIsFeatured' => 1],
            'totalCount' => $count,
            'sort' => [
                'attributes' => [
                    'id',
                    'faqQuestion'
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],

        ]);

        return $featuredProvider;

    }


}