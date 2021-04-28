<?php

namespace common\models;
use common\models\Category;
use common\models\CategoryTranslations;
use Yii;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property int $category_id
 * @property float $price
 * @property int $user_id
 * @property string $date
 * @property string $language
 */
class Service extends \yii\db\ActiveRecord
{
    public $language;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'price'], 'required'],
            [['category_id', 'user_id'], 'integer'],
            [['price'], 'number'],
            [['date', ], 'safe'],
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
            'price' => 'Price',
            'user_id' => 'User ID',
            'date' => 'Date',
        ];
    }


    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getServicetrans()
    {
        return $this->hasMany(ServiceTranslations::className(), ['service_id' => 'id']);
    }


    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id']);
    }


    public function getCategorytrans()
    {
        return $this->hasMany(CategoryTranslations::className(), ['category_id' => 'id'])->via('category');
    }

    public function Creates($request)
    {
        $service = new Service();
        $servicetrans = new ServiceTranslations();
        $service->category_id = $this->category_id;
        $service->price = $this->price;
        $service->user_id = Yii::$app->user->identity->id;
        if ($service->save(false)){
            $servicetrans->service_id = $service->id;
            $servicetrans->language = $request->getBodyParam('language');
            $servicetrans->value = $request->getBodyParam('value');
            $servicetrans->save(false);
        }
        return true;
    }

    public function Updates($request)
    {
        $service = Service::findOne($request->getBodyParam('id'));
        $servicetrans = ServiceTranslations::findOne($request->getBodyParam('id'));
        $service->category_id = $request->getBodyParam('category_id');
        $service->price = $request->getBodyParam('price');
        if ($service->save(false)){
            $servicetrans->language = $request->getBodyParam('language');
            $servicetrans->value = $request->getBodyParam('value');
            $servicetrans->save(false);
        }
        return true;
    }


}
