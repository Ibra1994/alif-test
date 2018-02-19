<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * SignupForm is the model behind the signup form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SignupForm extends Model
{
    public $email;
    public $password;
    public $password_confirm;



    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['email', 'password'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            ['email', 'unique',
                'targetClass'=> 'app\models\User',
                'message' => Yii::t('app', 'This email address has already been taken.')
            ],
            [['password', 'password_confirm'], 'string', 'min' => 6],
            ['password_confirm', 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'password_confirm' => Yii::t('app', 'Password comfirm'),
        ];
    }

    /**
     * @return User|null
     * @throws \Exception
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->email = $this->email;
            $user->setPassword($this->password);
            if(!$user->save()) {
                throw new \Exception("User couldn't be  saved");
            };

            return $user;
        }

        return null;
    }
}
