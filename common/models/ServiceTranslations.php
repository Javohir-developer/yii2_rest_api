<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_translations".
 *
 * @property int $id
 * @property int $service_id
 * @property string $language
 * @property string $value
 */
class ServiceTranslations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_translations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'language', 'value'], 'required'],
            [['service_id'], 'integer'],
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
            'service_id' => 'Service ID',
            'language' => 'Language',
            'value' => 'Value',
        ];
    }
}
