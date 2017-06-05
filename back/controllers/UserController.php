<?php
namespace app\controllers;

use app\models\Invite;
use app\models\User;
use Yii;
use app\models\Register;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function actionRegister(){
        $model = new Register();
        $postUser = Yii::$app->request->post()['user'];

        if($invite = Invite::findByToken($postUser['inviteToken'])){
            if($invite['email'] == $postUser['email']){
                $model->email = $postUser['email'];
                $model->password = $postUser['password'];
                if($model->validate()){
                    $invite->delete();
                    return ['code' => 0, 'content' => $model->register()];
                }else{
                    return ['code' => 1, 'error' => 'Data is not valid!'];
                }
            }else{
                return ['code' => 1, 'error' => "Email is wrong!"];
            }
        }else{
            return ['code' => 1, 'error' => "Unknown invite link! Sorry!"];
        }


    }

    public function actionLogin(){
        $post = Yii::$app->request->post();
        $user = User::findByEmail($post['email']);
        if($user && $user->validatePassword($post['password']))
            return ['code' => 0, 'content' => $user];
        else return ['code' => 1, 'error' => 'Login failed!'];
    }

    public function actionLogout(){
        return 'IHHA!';
    }

    public function actionInvite(){
        $post = Yii::$app->request->post();
        if(User::findByEmail($post['email']))
            return ['code' => 1, 'error' => 'This email already registered!'];
        $sender = User::findIdentity($post['sender']);
        $model = new Invite();
        $model->fk_inviter = $sender->id;
        $model->email = $post['email'];
        $model->subject = $post['subject'];
        $model->text = $post['text'];
        $model->fromName = empty($sender->name) ? 'noname' : $sender->name;
        $model->fromEmail = 'czzzech@gmail.com';
        return $model->sendInvite();
    }
}