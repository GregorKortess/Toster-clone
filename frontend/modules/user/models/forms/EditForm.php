<?php

namespace frontend\modules\user\models\forms;

use Yii;
use yii\base\Model;
use frontend\models\user;
use yii\db\ActiveRecord;

class EditForm extends model
{
    const MAX_STATUS_LENGTH = 250;
    const MAX_ABOUT_LENGTH = 2500;

    private $user;

    public $nickname;
    public $firstName;
    public $lastName;
    public $user_status;
    public $about;

    public function rules()
    {
        return [
            [['firstName', 'lastName'], 'string', 'max' => 30],
            [['nickname'], 'string', 'max' => 50],
            [['about'], 'string', 'max' => self::MAX_ABOUT_LENGTH],
            [['user_status'], 'string', 'max' => self::MAX_STATUS_LENGTH],

        ];
    }

    public function __construct($user)
    {
        $this->user = $user;
        $this->nickname = $user->nickname;
        $this->lastName = $user->lastName;
        $this->firstName = $user->firstName;
        $this->user_status = $user->userStatus;
        $this->about = $user->about;

    }


    public function save()
    {
       if ($this->validate()) {

           $this->user->nickname = $this->nickname;
           $this->user->firstName = $this->firstName;
           $this->user->lastName = $this->lastName;
           $this->user->userStatus = $this->user_status;
           $this->user->about = $this->about;

           $this->user->save(false);
           return true;

       }
    }

}
