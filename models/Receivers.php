<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "receivers".
 *
 * @property int $id
 * @property string|null $fullname
 * @property int|null $is_active
 *
 * @property Invoices[] $invoices
 */
class Receivers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receivers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_active'], 'integer'],
            [['fullname'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'ФИО',
            'is_active' => 'Активный',
        ];
    }

    /**
     * Gets query for [[Invoices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoices::className(), ['receiver_id' => 'id']);
    }

    static function getList(){
        return self::find()->where(['is_active' => 1])->asArray()->all();
    }
}
