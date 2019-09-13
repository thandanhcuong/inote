<?php
class Session{

    // start session
    public function start(){
        session_start();
    }

    public function send($user){
        // send data
        $_SESSION['user'] = $user;

    }

    public function get(){

        // kt neu session ton tai 'user'
        if (isset($_SESSION['user'])){

            $user = $_SESSION['user'];

        }else{
            $user = '';
        }

        return $user;

    }

    // finish session
    public function finish(){
       session_destroy();
    }
}