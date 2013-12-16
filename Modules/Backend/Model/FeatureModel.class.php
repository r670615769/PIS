<?php
/**
 *
 * Created by Session.chiu on 13-12-15.
 * Copyright 2013 Session. All rights reserved
 * 
 * Reversion history
 * 13-12-15 | Session | First draft
 * 
 * 
 */
class FeatureModel extends Model{
    protected $_auto = array(
        array('createId','session',1,'function','uid'),
        array('updateId','session',3,'function','uid'),
        array('creator','getCurrentPagePermissionName',1,'function'),
        array('editer','getCurrentPagePermissionName',3,'function'),
        array('createTime','date',1,'function','Y-m-d H:i:s')
    );
    protected $_validate = array(
        array('title','','此标题已存在。',1,'unique'),
        array('title','1,32','必须填入一个有效的标题。',1,'length'),
        array('elementType','require','必须选择一个表单类型。',1),
        array('size','number','必须填入一个有效的大小限制。',1),
        array('description','0,100','栏目介绍必须少于100个字符。',1,'length'),
        array('rank','number','排序必须填入数字。',2)
    );
    protected $patchValidate = true;

    /**
     * save user feature
     * @return array
     */
    public function saveFeature(){
        if($this->create() === false){
            return array(false,$this->getError());
        }else{
            $result = $this->add();
            if($result !== false){
                return array(true,$result);
            }else{
                return array(false,$this->getDbError());
            }
        }
    }

    /**
     * get feature list
     * @return array
     */
    public function getFeatureList(){
        $featureList = $this->order('available desc,rank')
            ->getField('id,title,enableToMember,enableToUser,available,rank');
        return $featureList;
    }

    /**
     * @param $fid
     * @return mixed
     */
    public function getFeatureById($fid){
        $feature = $this->field('id,title,description,elementType,size,available,require,enableToMember,enableToUser,condition,systemItem,rank')->find($fid);
        return $feature;
    }
    public function getFeatureTitleList(){
        $featureTitleList = $this->order('available desc,rank')->getField('id,title');
        return $featureTitleList;
    }
}
?>