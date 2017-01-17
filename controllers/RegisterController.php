<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\User;
use app\models\Register;

class RegisterController extends Controller
{
    public function actionForward() {
        $model = new Register();
        return $this->render('/register/register', [
            'model' => $model,
        ]);
    }

    public function actionRegister() {
        $registerMdl = new Register();
        if($registerMdl->load(Yii::$app->request->post()) && $registerMdl->registerUser()) {
            $userMdl = new User();
            $userMdl->username = $registerMdl->username;
            $userMdl->password = $registerMdl->password;
            $userMdl->setMessage($registerMdl->getMessage());

            return $this->render('/login/login', [
                'model' => $userMdl,
            ]);
        }
        return $this->render('/register/register', [
            'model' => $registerMdl,
        ]);

    }


}
