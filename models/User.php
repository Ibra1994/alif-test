<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $email
 * @property string $auth_key
 * @property string $access_token
 * @property string $password_hash
 * @property int role
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Key[] $keys
 */
class User extends ActiveRecord implements IdentityInterface
{
    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['email'], 'string', 'max' => 255],
            [['email'], 'unique'],
            ['role', 'in', 'range' => [self::ROLE_USER, self::ROLE_ADMIN]],
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'created_at' => Yii::t('app', 'Created at'),
            'updated_at' => Yii::t('app', 'Updated at'),
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public static function isAdmin()
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }

        if (static::findOne(['id' => Yii::$app->user->id, 'role' => static::ROLE_ADMIN])) {
            return true;
        }
        return false;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $security = Yii::$app->security;
                $this->access_token = $security->generateRandomString(36);
                $this->auth_key = $security->generateRandomString(36);
            }
            return true;
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeys()
    {
        return $this->hasMany(Key::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocks()
    {
        return $this->hasMany(Lock::class, ['id' => 'lock_id'])->viaTable('key', ['user_id' => 'id']);
    }
}
