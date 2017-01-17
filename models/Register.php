<?php
namespace app\models;

use yii\base\Model;
use app\models\User;

class Register extends Model {
    public $username;
    public $password;
    public $passwordRetype;

    private $message;

    /**
     * Get the value of Message
     *
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of Message
     *
     * @param mixed message
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function rules()
    {
        return [
            // username is required
            [['username'], 'required', 'message' => 'Bitte wähle einen Usernamen!'],
            // password is reqired
            [['password'], 'required', 'message' => 'Bitte wähle ein Passwort!'],
            // retype password is required
            [['passwordRetype'], 'required', 'message' => 'Bitte bestätige dein Passwort!'],
            // remove whitespaces before and after
            [['username', 'password', 'passwordRetype'], 'trim'],
            // username is validated by validateUsername()
            ['username', 'validateUsername'],
            // retyped password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }
    /**
     * Checks whether the given username already exists in database
     * @return bool
     */
    public function validateUsername() {
        $user = new User();
        if(!$user->findIdentity(['username' => $this->username])) {
            return true;
        }
        $this->addError('username', 'Dieser Username existiert bereits!');
        return true;
    }
    /**
     * Checks if the given passwords match and if password.length > 4
     * @return bool
     */
    public function validatePassword() {
        // if passwords match
        if(strcmp($this->password, $this->passwordRetype) == 0) {
            // if password has 5 or more characters
            if(strlen($this->password ) > 4) {
                return true;
            }
            $this->addError('password', 'Das Passwort muss mindestens 5 Zeichen lang sein!');
        }
        $this->addError('password', 'Die Passwörter stimmen nicht überein!');
        return false;
    }
    /**
     * Registers a new user
     * @return bool
     */
    public function registerUser() {
        if($this->validate() && $this->insertUser()) {
            $this->setMessage('Registrierung erfolgeich! Du kannst dich einloggen, sobald dein Account freigegeben wurde!');
            return true;
        }
        return false;
    }
    /**
     * Adds user into database
     * @return bool
     */
    public function insertUser() {
        $user = new User();
        $user->username = $this->username;;
        $user->password = md5($this->password);
        if($user->save(false)) {
            return true;
        }
        return false;
    }
}
