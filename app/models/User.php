<?php

use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Class User
 */
class User extends Cartalyst\Sentry\Users\Eloquent\User implements  RemindableInterface
{
   /**
    * The name of the table.
    *
    * @var string
    */
   protected $table = 'users';

   /**
    * Properties that are hidden.
    *
    * @var array
    */
   protected $hidden = array('remember_token');

   /**
    * User registration validation rules.
    *
    * @var array
    */
   public static $registerRules = array(
      'username'              => 'required|unique:users|between:4,16',
      'email'                 => 'required|email|unique:users',
      'password'              => 'required|min:8|confirmed',
      'password_confirmation' => 'required|min:8'
   );

   /**
    * User login validation rules.
    *
    * @var array
    */
   public static $sessionRules = array(
      'email'                 => 'required|email|exists:users',
      'password'              => 'required|min:8'
   );

   /**
    * Get username.
    *
    * @return mixed
    */
   public function getUsername()
   {
      return $this->username;
   }

   /**
    * Get email.
    *
    * @return mixed|string
    */
   public function getReminderEmail()
   {
      return $this->email;
   }

   /**
    * Get first name.
    *
    * @return mixed
    */
   public function getFirstName()
   {
      return $this->first_name;
   }

   /**
    * Get last name.
    *
    * @return mixed
    */
   public function getLastName()
   {
      return $this->last_name;
   }

   /**
    * Get permissions.
    *
    * @return array|mixed
    */
   public function getPermissions()
   {
      return $this->permissions;
   }

   /**
    * Get password.
    *
    * @return mixed
    */
   public function getAuthPassword()
   {
      return $this->password;
   }

   /**
    * Get user session/login validation rules.
    *
    * @return array
    */
   public function getSessionRules()
   {
      return $this::$sessionRules;
   }

   /**
    * Get user registration rules.
    *
    * @return array
    */
   public function getRegisterRules()
   {
      return $this::$registerRules;
   }

   public function getRememberToken()
   {
      return $this->remember_token;
   }

   public function setRememberToken($value)
   {
      $this->remember_token = $value;
   }

   public function getRememberTokenName()
   {
      return 'remember_token';
   }

   /**
    * User has many questions.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function questions()
   {
      return $this->hasMany('Question', 'user_id');
   }

   public function votes()
   {
      return $this->belongsToMany('Vote', 'questions_votes', 'answers_votes');
   }
}