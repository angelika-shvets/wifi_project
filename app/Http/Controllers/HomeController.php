<?php

namespace App\Http\Controllers;


use App\Devices;
use App\Networks;

class HomeController extends Controller
{

    public function network()
    {
        
        return view('network', [
            'devices' => $this->getDevices(),
            'networks' => $this->getNetworks(),
        ]);
    }

    /**
     * @return Devices
     */
    private function getNewPDODevicesModel(){

        return new Devices;
    }
    /**
     * @return Networks
     */
    private function getNewPDONetworksModel(){

        return new Networks;
    }
    
    private function getDevices()
    {
        $devices = $this->getNewPDODevicesModel();
        return $devices::all();
        
    }
    private function getNetworks()
    {
        $networks = $this->getNewPDONetworksModel();
        return $networks::all();

    }
}
