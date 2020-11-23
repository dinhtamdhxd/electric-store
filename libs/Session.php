<?php
    class Session{
        public static function init(){
            session_start();
        }      
        
        public static function set($key, $value){
            $_SESSION[$key] = $value;
        }

        public static function get($key){
            if(isset($_SESSION[$key])) return $_SESSION[$key];
        }

        public static function delete($key){
            if(isset($_SESSION[$key])) unset($_SESSION[$key]);
        }

        public static function destroy(){
            session_destroy();
        }

        public static function deleteInfoUser(){
            self::delete('login');
            self::delete('user');
            self::delete('timeLogin');
            self::delete('group_acp');
        }

        public static function setLoginUser($dataUser){
            self::set('login', true);
            self::set('user', $dataUser);
            self::set('group_acp', $dataUser['group_acp']);
            self::set('timeLogin', time());
        }
    }
?>