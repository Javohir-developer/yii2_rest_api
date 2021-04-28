<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_translations".
 *
 * @property int $id
 * @property int $category_id
 * @property string $language
 * @property string $value
 * @property int $status
 */
class CategoryTranslations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_translations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'language', 'value'], 'required'],
            [['category_id', 'status'], 'integer'],
            [['language', 'value'], 'string', 'max' => 225],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'language' => 'Language',
            'value' => 'Value',
            'status' => 'Status',
        ];
    }
}
