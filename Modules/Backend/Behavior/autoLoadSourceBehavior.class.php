<?php
/**
 *
 * Created by Session.chiu on 13-12-13.
 * Copyright 2013 Session. All rights reserved
 * 
 * Reversion history
 * 13-12-13 | Session | First draft
 * 
 * 
 */
class autoLoadSourceBehavior extends Behavior{
    protected $options = array(
        'SOURCE_PATH' => APP_TMPL_PATH,
        'SOURCE_CSS' => 'css/',
        'SOURCE_JS' => 'js/'
    );
    public function run(& $content){
        if(!C('CURRENT_TEMP_NAME')) return;

        import('ORG.Util.File');
        import('ORG.Util.ArrayList');
        $sourceFile = THEME_PATH.'source.ini';
        if($sourceContent = File::read_file($sourceFile)){
            $source = (array) json_decode($sourceContent);
            $sourcePath = C('SOURCE_PATH');
            if($source['SOURCE_PATH'] !== null){
                C('SOURCE_PATH',$sourcePath.$source['SOURCE_PATH']);
            }else{
                C('SOURCE_PATH',$sourcePath.'Public/');
            }
            if($source['SOURCE_CSS']) C('SOURCE_CSS',$source['SOURCE_CSS']);
            if($source['SOURCE_JS']) C('SOURCE_JS',$source['SOURCE_JS']);
            $cssPath = C('SOURCE_PATH').C('SOURCE_CSS');
            $jsPath = C('SOURCE_PATH').C('SOURCE_JS');
            preg_match("/\/(\w+)".C('TMPL_FILE_DEPR')."(\w+)".C('TMPL_TEMPLATE_SUFFIX')."$/",C('CURRENT_TEMP_NAME'),$match);
            if(empty($match)) return;
            $module = $match[1];
            $action = $match[2];
            $sourceList = ($source['SOURCE'] && $source['SOURCE']->$module) ? $source['SOURCE']->$module->$action : array();
            // auto load css file the name same as template
            $dir = File::get_dirs(APP_PATH.C('SOURCE_PATH').'css/');
            $ocssList = new ArrayList($dir['file']);
            if($ocssList->indexOf($module.'_'.$action.'.css') !== false) $sourceList[] = $module.'_'.$action.'.css';
            // auto load js file the name same as template
            $dir = File::get_dirs(APP_PATH.C('SOURCE_PATH').'js/');
            $ojsList = new ArrayList($dir['file']);
            if($ojsList->indexOf($module.'_'.$action.'.js') !== false) $sourceList[] = $module.'_'.$action.'.js';
            $css = '';
            $js = '';
            foreach($sourceList as $v){
                if(strpos($v,'/') === 0){
                    if(preg_match("/\w+\.css$/i",$v)){
                        // load css
                        $css .= '<link type="text/css" rel="stylesheet" href="'.C('SOURCE_PATH').preg_replace("/^\//","",$v).'" />';
                    }elseif(preg_match("/\w+\.js$/i",$v)){
                        // load js
                        $js .= '<script type="text/javascript" src="'.C('SOURCE_PATH').preg_replace("/^\//","",$v).'"></script>';
                    }
                }elseif(strpos($v,'/')===false){
                    if(preg_match("/\w+\.css$/i",$v)){
                        // load css
                        $css .= '<link type="text/css" rel="stylesheet" href="'.$cssPath.$v.'" />';
                    }elseif(preg_match("/\w+\.js$/i",$v)){
                        // load js
                        $js .= '<script type="text/javascript" src="'.$jsPath.$v.'"></script>';
                    }
                }elseif(preg_match("/^(http|https):\/\/\w+(\.\w+)+/",$v)){
                    if(preg_match("/(\w+\.css$|\w+\/\w*css?.+$)/i",$v)){
                        // load css
                        $css .= '<link type="text/css" rel="stylesheet" href="'.$v.'" />';
                    }elseif(preg_match("/(\w+\.js$|\w+\/\w*js?.+$)/i",$v)){
                        // load js
                        $js .= '<script type="text/javascript" src="'.$v.'"></script>';
                    }
                }else{
                    if(preg_match("/\w+\.css$/i",$v)){
                        // load css
                        $css .= '<link type="text/css" rel="stylesheet" href="'.C('SOURCE_PATH').$v.'" />';
                    }elseif(preg_match("/\w+\.js$/i",$v)){
                        // load js
                        $js .= '<script type="text/javascript" src="'.C('SOURCE_PATH').$v.'"></script>';
                    }
                }
            }

            $content = str_replace('__JS__',$js,$content);
            $content = str_replace('__CSS__',$css,$content);
            return $content;
        }
    }
}
?>