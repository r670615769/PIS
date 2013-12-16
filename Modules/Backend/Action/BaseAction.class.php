<?php
/**
 *
 * Created by Session.chiu on 13-12-7.
 * Copyright 2013 Session. All rights reserved
 * 
 * Reversion history
 * 13-12-7 | Session | First draft
 * 
 * Base class to be extended by all action
 *
 */
class BaseAction extends Action{
    private $oauth;
    public function _initialize(){
       $this->_init();
    }
    /**
     * Init system
     */
    private function _init(){
        $this->_auth();
        $this->_showPublic();
    }

    /**
     * Use to check current page permission for current user or specific permission item
     *
     * @param null $permission
     * @return bool
     */
    protected function _auth($permission = null,$uid = null){
        import('ORG.Util.Auth');
        if(empty($this->oauth) && !is_object($this->oauth)){
            $oauth = new Auth();
            $this->oauth =& $oauth;
        }

        if($permission){
            $uid = $uid ? $uid : session('uid');
            if($this->oauth->check($permission,$uid)){
                return true;
            }else{
                return false;
            }
        }
        if(!$permission && !(in_array(MODULE_NAME, C('AUTH_CONFIG.NOT_AUTH_MODEL')) || in_array(ACTION_NAME, C('AUTH_CONFIG.NOT_AUTH_ACTION')))){
            if(!($uid = $this->checkLogin())) redirect(C('AUTH_CONFIG.AUTH_LOGIN_GATEWAY'));
            if(!$this->oauth->check(MODULE_NAME.'_'.ACTION_NAME,$uid)) _404('no permission');
        }
    }

    /**
     * Check current user whether login
     *
     * @param string $username
     * @return bool|mixed
     */
    protected function checkLogin($check = ''){
        $uid = (int) session('uid');
        $username = session('username');
        if($check == '' && !empty($uid) && $uid > 0 ){
            return $uid;
        }elseif($check != '' && $check == $username && !empty($uid) && $uid > 0){
            return $uid;
        }else{
            return false;
        }
    }

    /**
     * to show public content like module list, menu, submenu, nav, subnav and so on
     */
    private function _showPublic(){
        $omenu = D('Menu');
        $amodules = $omenu->getModules();
        $this->assign('modules',$amodules);
        $amenu = $omenu->getMenuByModelName(MODULE_NAME);
        $asubNav = array();
        $amenus = array();
        $asubmenus = array();
        $temp = array();
        foreach($amenu as $v){
            if(!$this->_auth($v['name'])) continue;
            switch(count(explode(',',$v['level']))){
                case 2:
                    $amenus[$v['id']] = array(
                        'title' => $v['title'],
                        'URL' => $v['URL'],
                        'icon' => $v['icon']
                    );
                    if(MODULE_NAME == $v['name']){
                        $anav[] = array(
                            'title' => $amodules[$v['pId']]['title'],
                            'URL' => $amodules[$v['pId']]['URL'],
                            'icon' => $amodules[$v['pId']]['icon']
                        );
                        $anav[] = array(
                            'title' => $v['title'],
                            'URL' => $v['URL']
                        );
                        $amenus[$v['id']]['active'] = true;
                        $icon = $v['icon'];
                    }else{
                        $amenus[$v['id']]['active'] = false;
                    }
                    break;
                case 3:
                    $amenus[$v['pId']]['submenu'][$v['id']] = array(
                        'title' => $v['title'],
                        'URL' => $v['URL']
                    );
                    if($foundSubNav){
                        $stop = true;
                        break;
                    }else{
                        $asubNav = array();
                    }

                    if($v['name'] == MODULE_NAME.'_'.ACTION_NAME){
                        $bnatchNav || $bmatchNav = true;
                        $foundSubNav = true;
                        $anav[] = array(
                            'title' => $v['title'],
                            'URL' => $v['URL'],
                            'class' => 'current'
                        );
                        $tcontentTitle = $v['title'];
                    }else{
                        $temp = array(
                            'title' => $v['title'],
                            'URL' => $v['URL'],
                        );
                        $bmatchNav && $bmatchNav = false;
                    }
                    break;
                case 4:
                    if($foundSubNav && $stop) break;
                    if($bmatchNav){
                        $asubNav[] = array(
                            'title' => $v['title'],
                            'URL' => $v['URL']
                        );
                        $tsubContentTitle = $tcontentTitle;
                    }else{
                        $asubNav[] = array(
                            'title' => $v['title'],
                            'URL' => $v['URL']
                        );
                        //$tsubContentTitle = $temp['name'];
                        if(MODULE_NAME.'_'.ACTION_NAME == $v['name']){
                            $foundSubNav = true;
                            $tsubContentTitle = $v['title'];
                            $tcontentTitle = $temp['title'];
                            $anav[] = array(
                                'title' => $temp['title'],
                                'URL' => $temp['URL']
                            );
                            $anav[] = array(
                                'title' => $v['title'],
                                'URL' => $v['URL'],
                                'class' => 'current'
                            );
                            $asubNav[count($asubNav)-1]['active'] = true;
                        }
                    }
                    break;
            }
        }
        $this->assign('menu',$amenus);
        $this->assign('nav',$anav);
        $this->assign('contentTitle',$tcontentTitle);
        $this->assign('subnav',$asubNav);
        $this->assign('subContentTitle',$tsubContentTitle);
        $this->assign('icon',$icon);
    }

    /**
     * show confirm message at heade
     * @param $info message content, support array
     * @param $type message type (0: success, 1: info, 2: warning, 3: error)
     */
    public function showConfirmInfo($info,$type){
        if(is_array($info)) $info = implode('<br />',$info);
        switch($type){
            case 1: // note info
                $this->_note($info);
                break;
            case 2: // waring info
                $this->_warning($info);
                break;
            case 3: // error info
                $this->_error($info);
                break;
            case 0:
            default: // success info
                $this->_success($info);
                break;
        }
    }

    /**
     * private function to show success message in heade, call by showConfirmInfo
     * @param string | $info message content
     */
    private function _success($info){
        $confirm = array(
            'class' => 'alert-success',
            'head' => '成功！',
            'body' => $info
        );
        $this->assign('confirmInfo',$confirm);
    }

    /**
     * private function to show note info in heade, call by showConfirmInfo
     * @param string | $info message content
     */
    private function _note($info){
        $confirm = array(
            'class' => 'alert-info',
            'head' => '提示：',
            'body' => $info
        );
        $this->assign('confirmInfo',$confirm);
    }

    /**
     * private function to show warning message in heade, call by showConfirmInfo
     * @param $info | string message content
     */
    private function _warning($info){
        $confirm = array(
            'class' => 'alert-warning',
            'head' => '警告！',
            'body' => $info
        );
        $this->assign('confirmInfo',$confirm);
    }

    /**
     * private function to show error message in heade, call by showConfirmInfo
     * @param $info | string
     */
    private function _error($info){
        $confirm = array(
            'class' => 'alert-danger',
            'head' => '错误！',
            'body' => $info
        );
        $this->assign('confirmInfo',$confirm);
    }
}
?>