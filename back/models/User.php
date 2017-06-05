<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $authKey
 *
 * @property Event[] $events
 * @property Invite[] $invites
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */

    public function fields()
    {
        $fields = parent::fields();

        unset($fields['password']);

        return $fields;
    }

    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password'], 'string'],
            [['name'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 30],
            [['authKey'], 'string', 'max' => 50],
            [['email'], 'unique'],
            [['authKey'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'authKey' => 'Auth Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['author' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvites()
    {
        return $this->hasMany(Invite::className(), ['fk_inviter' => 'id']);
    }

    public static function findIdentity($id){
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){

    }

    public function getId(){
        return $this->id;
    }

    public function getAuthKey(){
        return $this->authKey;//Here I return a value of my authKey column
    }

    public function validateAuthKey($authKey){
        return $this->authKey === $authKey;
    }

    public function generateAuthKey(){
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    public static function findByEmail($email){
        return self::findOne(['email'=>$email]);
    }

    public function validatePassword($password){
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password){
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
}
