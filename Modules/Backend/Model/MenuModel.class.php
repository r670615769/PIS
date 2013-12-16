<?php
/**
 *
 * Created by Session.chiu on 13-12-8.
 * Copyright 2013 Session. All rights reserved
 * 
 * Reversion history
 * 13-12-8 | Session | First draft
 * 
 * 
 */
class MenuModel extends Model{
    /**
     * get modules
     * @return array
     */
    public function getModules(){
        $amodules = $this->table('permission')
                        ->where('showInMenu=1 and pId=0 and type="backend_menu"')
                        ->order('level')
                        ->getField('id,title,URL,icon');
        return $amodules;
    }

    /**
     * get menu match with current url
     * @param $modelName
     * @return array
     */
    public function getMenuByModelName($modelName){
        $amenu = $this->table('permission')
            ->where('showInMenu=1 and type="backend_menu" and `level` like (SELECT CONCAT(p2.`level`,",","%") as `level` FROM permission p1 LEFT JOIN permission p2 ON p1.pId=p2.id WHERE p1.`name`="'.$modelName.'")')
            ->order('`level`')
            ->getField('id,pId,name,title,URL,icon,level');
        //dump($this->getlastsql());
        return $amenu;
    }
}
?>