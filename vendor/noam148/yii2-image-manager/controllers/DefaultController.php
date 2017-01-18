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
        $model = new User();
        if (!Yii::$app->user->isGuest) {
            return $this->render('/login');
        }
        return $this->render('//login/login', [
            'model' => $model,
        ]);
    }
}
