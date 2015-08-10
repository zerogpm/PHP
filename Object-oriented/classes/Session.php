<?php
/**
 * Created by PhpStorm.
 * User: Jian Su
 * Date: 8/5/2015
 * Time: 2:50 PM
 */
class Session {
    public $session;

    public function save(array $data = null) {
        foreach($data as $key => $value) {
            $this->session[$key] = $value;
        }
    }


    public function start() {
        session_start();
        $this->session = &$_SESSION;
    }

    public function get($key = null) {
        if(!$this->session && !$key) return false;
        return $this->session[$key];
    }

    public function destory() {
        session_destroy($this->session);
    }
}