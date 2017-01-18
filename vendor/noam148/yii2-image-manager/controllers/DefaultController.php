<?php

namespace noam148\imagemanager\controllers;

use yii;
use yii\web\Controller;
use app\models\User;

/**
 * Default controller for the `imagemanager` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->render('index');
        }
        return $this->render('//login/login', [
            'model' => $userMdl,
        ]);
    }
}
