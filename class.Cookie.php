<?php

Class Cookie {

    private $cookieName = null;        
    private $cookieValue = null;      
    private $cookiExpire = null;      
    private $cookiePath = null;        
    private $cookieDomain = null;      
    private $cookieSecure = false;    
    private $cookieHttpOnly = null;    
    
    private $cookieErrorReport = "Faild to the Cookie";
    
    public function setCookieOptions($name, $value, $day, $path, $httpOnly){
        $this->cookieDomain = "." . $_SERVER['HTTP_HOST'];
        $this->cookieName = $name;
        $this->cookieValue = $value;
        $this->cookiePath = $path;
        $this->cookieHttpOnly = $httpOnly || true;
        $this->isSecure();
        $this->setExpirationDate( $day );
    }
    
    private function isSecure() {
        if( !empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443 ) {
            $this->cookieSecure = true;
        }
    }
    
    private function setExpirationDate( $day ) {
        $this->cookieExpire = time() + ($day * 24 * 60 * 60);
    }
    
    public function setCookie() {
            if(!setcookie( $this->cookieName, $this->cookieValue, $this->cookieExpire, $this->cookiePath, $this->cookieDomain, $this->cookieSecure, $this->cookieHttpOnly )){
              throw new Exception($this->cookieErrorReport);
            }
    }
    
    public function getCookie($name){
        return (isset($_COOKIE[$name]))? true : false ;  
    }
}