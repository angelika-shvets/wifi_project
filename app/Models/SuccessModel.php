<?php

/**
 * Created by PhpStorm.
 * User: angelika
 * Date: 3/17/18
 * Time: 11:37 AM
 */
namespace  App\Models;


class SuccessModel 
{
    /**
     * @var string
     */
    private  $_create_network ='Network Created Successfully';
    /**
     * @var array
     */
    private  $_update_network =[NetworkInterface::NETWORK_ID];
    /**
     * @var array
     */
    private  $_get_network =[NetworkInterface::NETWORK_ID,NetworkInterface::AUTH,
        NetworkInterface::THROUGHPUT,NetworkInterface::DEVICES];

    /**
     * @return string
     */
    public function getCreateNetwork()
    {
        return $this->_create_network;
    }

    /**
     * @return array
     */
    public function getGetNetwork()
    {
        return $this->_get_network;
    }

    /**
     * @return array
     */
    public function getUpdateNetwork()
    {
        return $this->_update_network;
    }
   


  

}