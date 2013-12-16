<?php
/**
 *
 * Created by Session.chiu on 13-12-7.
 * Copyright 2013 Session. All rights reserved
 * 
 * Reversion history
 * 13-12-7 | Session | First draft
 * 
 * 
 */
class UserAndUserGroupAction extends BaseAction{
    // TODO: user main page search page
    public function user(){
        //dump($_SESSION);
        $this->show();
    }
    // TODO: user edit page same as user feature edit page have a search form and edit form.
    // TODO: when search result more than one item, will show a user list to let user choose one among them to edit.
    // TODO: in user edit page maybe have some tab include each user feature category.
    public function userEdit(){}
    // TODO: this page to add a new user, only one form to add user. Field include system items and custom item that is require.
    public function userNew(){}

    /**
     * user Featur page show feature summary or single item detail
     */
    public function userFeature(){
        $featureModel = D('Feature');
        if(I('op') == 'detail' && I('id')){
            $fid = I('id');
            $this->assign('subContentTitle','用户栏目详细');
            $result = $featureModel->getFeatureById($fid);
            $featureDetail = array(
                'title' => $result['title'],
                'description' => $result['description'],
                'elementType' => getElementTypeName($result['elementType']),
                'size' => $result['size'],
                'available' => $result['available'] ? 'icon-ok' : 'icon-remove',
                'require' => $result['require'] ? 'icon-ok' : 'icon-remove',
                'enableToMember' => $result['enableToMember'] ? 'icon-ok' : 'icon-remove',
                'enableToUser' => $result['enableToUser'] ? 'icon-ok' : 'icon-remove',
                'condition' => $result['condition'] ? $result['condition'] : '无需验证',
                'rank' => $result['rank'],
                'systemItem' => $result['systemItem'] ? 'icon-ok' : 'icon-remove'
            );
            $this->assign('featureDetail',$featureDetail);
            $this->display('userFeatureDetail');
        }else{
            $result = $featureModel->getFeatureList();
            $featureList = array();
            foreach($result as $v){
                $feature = array(
                    'title' => $v['title'],
                    'available' => $v['available'] ? 'icon-ok' : 'icon-remove',
                    'enableToUser' => $v['enableToUser'] ? 'icon-ok' : 'icon-remove',
                    'enableToMember' => $v['enableToMember'] ? 'icon-ok' : 'icon-remove',
                    'rank' => $v['rank']
                );
                $detailUrl = U('userFeature',array('op'=>'detail','id'=>$v['id']),false);
                $op = array(
                    array('详情',$detailUrl)
                );
                if($this->_auth('UserAndUserGroup_userFeatureEdit')){
                    $editeUrl = U('userFeatureEdit','',false);
                    $op[] = array('编辑',$editeUrl);
                }
                $feature['ops'] = $op;
                $featureList[] = $feature;
            }
            $this->assign('featureList',$featureList);
            $this->display();
        }
    }

    /**
     * add new feature item page
     */
    public function userFeatureNew(){
        if(I('op') == 'new'){
            $featureModel = D('Feature');
            $result = $featureModel->saveFeature();
            if(!$result[0]){
                $featureInfo = I('post.');
                $this->assign('featureInfo',$featureInfo);
                $this->showConfirmInfo($result[1],3);
                $this->display();
            }else{
                $this->success('添加用户栏目成功','userFeature',3);
            }
        }else{
            $this->display();
        }
    }

    /**
     * feature edit page
     */
    // TODO: user feature edit page include search and edit maybe need two template to realize it.
    public function userFeatureEdit(){
        if(I('op') == 'edit' && I('id')){
            $fid = I('id');
            $featureModel = D('Feature');
            $featureModel->getFeatureById($fid);
        }
        $this->display();
    }
}
?>