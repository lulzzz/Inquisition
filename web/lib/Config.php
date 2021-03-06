<?php
/**
 *  Config.php - library for reading in and manipulating config values
 */

class Config
{
    public $configVals = [];

    public function __construct($configFile = '')
    {
        if(empty($configFile))
        {
            // use default file
            $configFile = '/opt/inquisition/conf/main.cfg';
        }

        // try to read in configs
        if(!$this->readConfigFile($configFile))
        {
            throw new \Exception('could not read configuration file');
        }
    }

    public function readConfigFile($configFilename)
    {
        /*         *
         *  Params:
         *      * $configFileName :: STR :: filename of config file to read in
         *
         *  Returns: BOOL
         */

        if(file_exists($configFilename))
        {
            if($this->configVals =parse_ini_file($configFilename, true, INI_SCANNER_RAW))
            {
                return true;
            }
            else
            {
                error_log('could not parse config file :: [ SEV: CRIT ] :: [ FILENAME: '.$configFilename.' ]');
            }
        }
        else
        {
            error_log('could not find config file :: [ SEV: CRIT ] :: [ FILENAME: '.$configFilename.' ]');
        }

        return false;
    }
}