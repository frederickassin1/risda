<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\web\ForbiddenHttpException;
use yii\web\User;
use yii\helpers\VarDumper;

class UAPI extends Component
{
    const DEFAULT_PASSWORD = 'RISDA@2024'; // Replace with your actual default password

    /**
     * Checks if the user's password is the default password and prompts them to change it.
     *
     * @param User $user The user object containing the password hash.
     * @throws ForbiddenHttpException if the user is using the default password.
     */
    public function checkDefaultPassword($user)
    {
        // VarDumper::dump( $user, $depth = 10, $highlight = true);die;
        // Ensure the user object has a password_hash attribute
        if (!isset($user)) {
            throw new \InvalidArgumentException('The user object does not contain a password_hash attribute.');
        }

        // Validate if the password matches the default password
        if (Yii::$app->getSecurity()->validatePassword(self::DEFAULT_PASSWORD, $user)) {
            Yii::$app->session->setFlash('warning', 'You are using the default password. Please change your password.');

            // Redirect to the change password page
            Yii::$app->response->redirect(['users/change-password'])->send();
            Yii::$app->end();
        }
    }
    public function checkPassword($user)
    {
        // VarDumper::dump( $user, $depth = 10, $highlight = true);die;
        // Ensure the user object has a password_hash attribute
        if (!isset($user)) {
            throw new \InvalidArgumentException('The user object does not contain a password_hash attribute.');
        }

        // Validate if the password matches the default password
        if (Yii::$app->getSecurity()->validatePassword(self::DEFAULT_PASSWORD, $user)) {
            Yii::$app->session->setFlash('warning', 'You are using the default password. Please change your password.');

            // Redirect to the change password page
          return true;
        }
        return false;
    }
}
