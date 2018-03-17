<?php

/**
 * Created by PhpStorm.
 * User: angelika
 * Date: 3/17/18
 * Time: 9:17 AM
 */
namespace  App\Models;

use App\Networks;

class NetworkModel 
{
    /**
     * @var float
     */
    private  $_throughput;
    /**
     * @var string
     */
    private $_network_id;

    /**
     * @var integer
     */
    private $_device_id;

    /**
     * @var integer
     */
    private $_id;
    
    /**
     * @var string
     */
    private $_auth;
    /**
     * @var array
     */
    private $_devices;
    /**
     * @return float
     */
    public function getThroughput()
    {
        return $this->_throughput;
    }

    /**
     * @param float $throughput
     */
    public function setThroughput($throughput)
    {
        $this->_throughput = $throughput;
    }

    /**
     * @return string
     */
    public function getNetworkId()
    {
        return $this->_network_id;
    }

    /**
     * @param string $network_id
     */
    public function setNetworkId($network_id)
    {
        $this->_network_id = $network_id;
    }

    /**
     * @return int
     */
    public function getDeviceId()
    {
        return $this->_device_id;
    }

    /**
     * @param int $device_id
     */
    public function setDeviceId($device_id)
    {
        $this->_device_id = $device_id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return string
     */
    public function getAuth()
    {
        return $this->_auth;
    }

    /**
     * @param string $auth
     */
    public function setAuth($auth)
    {
        $this->_auth = $auth;
    }

    /**
     * @return array
     */
    public function getDevices()
    {
        return $this->_devices;
    }

    /**
     * @param array $devices
     */
    public function setDevices($devices)
    {
        $this->_devices = $devices;
    }

    

    /**
     * @param array $network_parameters
     * @return NetworkModel $this
     */
    public  function loadFromArray($network_parameters){
        
        if($network_parameters && is_array($network_parameters) && count($network_parameters)>0){
            foreach ($network_parameters as $parameter_name => $parameter_value){
                switch ($parameter_name){
                    case NetworkInterface::NETWORK_ID:
                        $this->setNetworkId($parameter_value);
                        break;
                    case NetworkInterface::ID:
                        $this->setId($parameter_value);
                        break;
                    case NetworkInterface::AUTH:
                        $this->setAuth($parameter_value);
                        break;
                    case NetworkInterface::THROUGHPUT:
                        $this->setThroughput($parameter_value);
                        break;
                    case NetworkInterface::DEVICE_ID:
                        $this->setDeviceId($parameter_value);
                        break;
                }
            }
        }
        return $this;
    }

    /**
     * @param Networks $network_model
     * @return Networks $network_model
     */
    public  function loadPDOModelFromModel($network_model){

        $network_model->network_id = $this->getNetworkId();
        $network_model->auth = $this->getAuth();
        $network_model->throughput = $this->getThroughput();
        
        return $network_model;
    }
    /**
     * @param Networks $network_model
     * @return NetworkModel $this
     */
    public  function loadModelFromPDOModel($network_model){

        $this->setId($network_model->id );
        $this->setNetworkId($network_model->network_id );
        $this->setAuth($network_model->auth);
        $this->setThroughput($network_model->throughput);
        return $this;
    }
    /**
     * @param array $network_parameters
     * @return array $network_result
     */
    public  function loadArrayFromModel($network_parameters){
        $network_result = [];
        if($network_parameters && is_array($network_parameters) && count($network_parameters)>0){
            foreach ($network_parameters as $parameter_name ){
                switch ($parameter_name){
                    case NetworkInterface::NETWORK_ID:
                        $network_result[NetworkInterface::NETWORK_ID] = $this->getNetworkId();
                        break;
                    case NetworkInterface::AUTH:
                        $network_result[NetworkInterface::AUTH] = $this->getAuth();
                        break;
                    case NetworkInterface::THROUGHPUT:
                        $network_result[NetworkInterface::THROUGHPUT] = $this->getThroughput();
                        break;
                    case NetworkInterface::DEVICES:
                        $network_result[NetworkInterface::DEVICES] =  $this->getDevices();
                        break;
                }
            }
        }
        return $network_result;
    }

}