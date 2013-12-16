<?php
/**
 *
 * Created by Session.chiu on 13-12-9.
 * Copyright 2013 Session. All rights reserved
 * 
 * Reversion history
 * 13-12-9 | Session | First draft
 * 
 * Public page, this model no need check permission
 */
class PublicAction extends BaseAction{
    /**
     * Login gateway
     */
    public function login(){
         if($this->_post('op') && $this->_post('op') == 'login'){
            if($this->checkLogin($this->_post('username'))) redirect(__APP__);
            if($this->_post('username') && $this->_post('password')){
                $ouser = D('User');
                if($auserInfo = $ouser->checkUsername($this->_post('username'),$this->_post('password'))){
                        session('uid',$auserInfo['uid']);
                        session('username',$auserInfo['username']);
                        redirect(__APP__);
                }
            }
         }
        $this->show();
     }
    public function logout(){
        session('[destroy]');
        redirect(C('AUTH_CONFIG.AUTH_LOGIN_GATEWAY'));
    }
}
?>