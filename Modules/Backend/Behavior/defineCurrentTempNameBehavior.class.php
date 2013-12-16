<?php
/**
 *
 * Created by Session.chiu on 13-12-13.
 * Copyright 2013 Session. All rights reserved
 * 
 * Reversion history
 * 13-12-13 | Session | First draft
 * 
 * to define current template name
 */
class defineCurrentTempNameBehavior extends Behavior{
    public function run(& $templateFile){
        C('CURRENT_TEMP_NAME',$templateFile['file']);
    }
}
?>