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
/**
 * to get permission
 * @return string
 */
function getCurrentPagePermissionName(){
    return MODULE_NAME.'-'.ACTION_NAME;
}

/**
 * get element type chinese name by english name
 * @param $type element type name(english)
 * @return string element type name(chinese)
 */
function getElementTypeName($type){
    switch($type){
        case 'text':
            $typeName = '单行文本';
            break;
        case 'texteara':
            $typeName = '多行文本';
            break;
        case 'radio':
            $typeName = '单选框';
            break;
        case 'checkbox':
            $typeName = '复选框';
            break;
        case 'select':
            $typeName = '下拉列表';
            break;
        case 'select multiple':
            $typeName = '多选框';
            break;
    }
    return $typeName;
}
?>