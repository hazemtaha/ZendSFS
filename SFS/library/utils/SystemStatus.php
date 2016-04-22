<?php

class SystemStatus
{
    public function checkSystemAvailablitiy()
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini',
                          null,
                          array('skipExtends' => true,
                                'allowModifications' => true, ));

        return $config->production->SYSTEM_STATUS;
    }
}
