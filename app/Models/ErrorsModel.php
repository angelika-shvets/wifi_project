<?php

/**
 * Created by PhpStorm.
 * User: angelika
 * Date: 3/17/18
 * Time: 10:25 AM
 */
namespace  App\Models;


class ErrorsModel 
{
    /**
     * @var string
     */
    private  $_network_exist ='Network Already Exist';
    /**
     * @var string
     */
    private  $_system_problem = 'System problem';
    /**
     * @var string
     */
    private  $_network_not_exist = 'Network Not Exist';

    /**
     * @var string
     */
    private  $_network_not_created ='Network Not Created';

    /**
     * @var string
     */
    private  $_device_connected ='Device Connected To Network';
    /**
     * @return string
     */
    public function getNetworkExist()
    {
        return $this->_network_exist;
    }

    /**
     * @return string
     */
    public function getSystemProblem()
    {
        return $this->_system_problem;
    }

    /**
     * @return string
     */
    public function getNetworkNotExist()
    {
        return $this->_network_not_exist;
    }

    /**
     * @return string
     */
    public function getNetworkNotCreated()
    {
        return $this->_network_not_created;
    }

    /**
     * @return string
     */
    public function getDeviceConnected()
    {
        return $this->_device_connected;
    }

  

}