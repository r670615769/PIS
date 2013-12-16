<?php
/**
 *
 * Created by Session.chiu on 13-12-9.
 * Copyright 2013 Session. All rights reserved
 * 
 * Reversion history
 * 13-12-9 | Session | First draft
 * 
 * Administrate user
 */
class UserModel extends Model{
    /**
     *
     * Check username and return user infomation if user exists
     *
     * @param $username | username
     * @param $password | password
     * @return array | user infomation
     */
    public function checkUsername($username,$password){
        $auserInfo = $this->table(C('AUTH_CONFIG.AUTH_USER').' u')
                        ->join('userstatus us on u.status=us.id')
                        ->where('u.username = "'.$username.'" and u.password = "'.$password.'" and u.nullIfDeleted is null and us.name = "Active"')
                        ->limit(1)
                        ->getField('"userInfo",u.id as uid,u.username');
        return $auserInfo['userInfo'];
    }
}
?>