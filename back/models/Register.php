<?php
namespace app\models;


use yii\base\Model;

class Register extends Model
{
    public $email;
    public $password;

    public function rules(){
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\models\User'],
            ['password', 'string', 'min' => 2, 'max' => 16]
        ];
    }

    public function register(){
        $user = new User();
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}