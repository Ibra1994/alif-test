<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%key}}".
 *
 * @property int $id
 * @property string $name
 * @property int $lock_id
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Lock $lock
 * @property User $user
 */
class Key extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%key}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'lock_id'], 'required'],
            [['lock_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['lock_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lock::class, 'targetAttribute' => ['lock_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'lock_id' => Yii::t('app', 'Lock'),
            'user_id' => Yii::t('app', 'User'),
            'created_at' => Yii::t('app', 'Created at'),
            'updated_at' => Yii::t('app', 'Updated at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLock()
    {
        return $this->hasOne(Lock::class, ['id' => 'lock_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\KeyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\KeyQuery(get_called_class());
    }
}
