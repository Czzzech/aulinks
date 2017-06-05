<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invite".
 *
 * @property integer $id
 * @property string $hash
 * @property string $email
 * @property string $fk_inviter
 * @property string $text
 * @property string $subject
 *
 * @property User $fkInviter
 */
class Invite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $subject = '';
    public $text = '';
    public $fromEmail = '';
    public $fromName = '';

    public function extraFields()
    {
        return ['inviter', 'user' => function($model){
            return $model->inviter->user;
        }];
    }


    public static function tableName()
    {
        return 'invite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hash', 'email', 'fk_inviter', 'subject'], 'required'],
            [['subject', 'text'], 'string'],
            [['fk_inviter'], 'integer'],
            [['hash'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 30],
            [['email'], 'unique'],
            [['hash'], 'unique'],
            [['fk_inviter'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fk_inviter' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hash' => 'Hash',
            'email' => 'Email',
            'fk_inviter' => 'Fk Inviter',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkInviter()
    {
        return $this->hasOne(User::className(), ['id' => 'fk_inviter'])->joinWith('user');
    }

    public function sendInvite(){
        $this->hash = Yii::$app->security->generateRandomString();
        $this->text .= "\r\nRegister Link: http://perevozniy.000webhostapp.com/web/#!/user/register/{$this->hash}";
        if ($this->validate()) {
            if(Yii::$app->mailer->compose()
                ->setTo($this->email)
                ->setFrom('czzzech@gmail.com')
                ->setSubject($this->subject)
                ->setTextBody($this->text)
                ->send()){
                $this->save();

                return ['code' => 0, 'content' => 'Invitation successfully sent!'];
            }
        }
        return ['code' => 1, 'error' => 'Form validation failed!'];
    }

    public static function findByToken($token){
        return self::findOne(['hash' => $token]);
    }
}
