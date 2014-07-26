<?php

class User extends Cartalyst\Sentry\Users\Eloquent\User
{
   public static $registerRules = array(
      'username'              => 'required|unique:users|between:4,16',
      'email'                 => 'required|email|unique:users',
      'password'              => 'required|min:8|confirmed',
      'password_confirmation' => 'required|min:8'
   );

   public static $sessionRules = array(
      'email'                 => 'required|email|exists:users',
      'password'              => 'required|min:8',
   );

   public function getUsername()
   {
      return $this->username;
   }

   public function getReminderEmail()
   {
      return $this->email;
   }

   public function getFirstName()
   {
      return $this->first_name;
   }

   public function getLastName()
   {
      return $this->last_name;
   }

   public function getPermissions()
   {
      return $this->permissions;
   }

   public function getAuthPassword()
   {
      return $this->password;
   }

   public function getSessionRules()
   {
      return $this::$sessionRules;
   }

   public function getRegisterRules()
   {
      return $this::$registerRules;
   }
}