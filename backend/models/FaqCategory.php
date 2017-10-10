<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "faqcategory".
 *
 * @property integer $id
 * @property string $faqCategoryName
 * @property integer $faqCategoryWeight
 * @property integer $faqCategoryIsFeatured
 *
 * @property Faq[] $faqs
 */
class FaqCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faqcategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'faqCategoryName'], 'required'],
            [['id', 'faqCategoryWeight', 'faqCategoryIsFeatured'], 'integer'],
        	['faqCategoryWeight', 'default','value'=>100],
        	[['faqCategoryWeight'],'in','range'=>range(1, 100)],
            [['faqCategoryName'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'faqCategoryName' => 'Faq Category Name',
            'faqCategoryWeight' => 'Faq Category Weight',
            'faqCategoryIsFeatured' => 'Faq Category Is Featured',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaqs()
    {
        return $this->hasMany(Faq::className(), ['faqCategory_id' => 'id']);
    }
    
    public static function getFaqCategoryIsFeaturedList()
    {
    	return $droptions = [0 => "no", 1 => "si"];
    }
}
