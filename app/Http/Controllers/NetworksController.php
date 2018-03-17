<?php

namespace App\Http\Controllers;

use App\Models\ErrorsModel;
use App\Models\NetworkModel;
use App\Models\SuccessModel;
use App\Networks;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NetworksController extends Controller
{
    /**
     * @param string $id
     * @return Response
     */
    public function getNetworkByNetworkId($id)
    {
        $model = $this->getNetworkModel();

        $model->setNetworkId($id);
        /**
         * Validation Part( need add new class for validation data)
         */
        try{

            $model = $this->getNetwork($model);

            if($model->getId() > 0){

                return response()->json($this->generateSuccess($model->loadArrayFromModel($this->getSuccessModel()->getGetNetwork())),200);

            }
            return response()->json($this->generateError($this->getErrorsModel()->getNetworkNotExist()));

        } catch(\Exception $e){

            return response()->json($this->generateError($this->getErrorsModel()->getSystemProblem()));
        }
        
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createNetwork(Request $request)
    {
        $model = $this->getNetworkModel()->loadFromArray($request->all());

        /**
         * @todo Validation Part( need add new class for validation data)
         */
        try{

            if ($this->verificationNetworkExist($model)) {

                return response()->json($this->generateError($this->getErrorsModel()->getNetworkExist()),200);
            }

            $model = $this->saveNetwork($model);

            if ($model->getId() > 0) {
                return response()->json($this->generateSuccess($this->getSuccessModel()->getCreateNetwork()), 201);
            }
            return response()->json($this->generateError($this->getErrorsModel()->getNetworkNotCreated()),200);
        }
        catch(\Exception $e){
            return response()->json($this->generateError($this->getErrorsModel()->getSystemProblem()),400);
        }
    }

    public function addNetworkDevice(Request $request){

        $model = $this->getNetworkModel()->loadFromArray($request->all());

        try{

            if($this->verificationNetworkDevice($model)){

                return response()->json($this->generateError($this->getErrorsModel()->getDeviceConnected()),200);

            }

            $this->saveNetworkDevice($model);

            return response()->json($this->generateSuccess($this->getSuccessModel()->getAddDevice()), 201);

        }
        catch(\Exception $e){
            return response()->json($this->generateError($this->getErrorsModel()->getSystemProblem()),400);
        }

    }
    /**
     * @return NetworkModel
     */
    private function getNetworkModel(){

        return new NetworkModel();
    }
    /**
     * @todo need to add Factory and Registry classes and for example how I use it you can see below
     */
    /**
     * @return Networks
     */
    private function getNewPDONetworksModel(){

        return new Networks;
    }
    /**
     * @param NetworkModel $model
     * @return integer| null
     */
    private function verificationNetworkExist($model){

        $networks = $this->getNewPDONetworksModel();
        return $networks::where('network_id', '=', ($model->getNetworkId()))->count();
    }
    /**
     * @param NetworkModel $model
     * @return NetworkModel $model
     */
    private function saveNetwork($model){

        $networks = $this->getNewPDONetworksModel();

        $networks = $model->loadPDOModelFromModel($networks);

        $networks->save();

        $networks->devices()->sync([$model->getDeviceId()]);

        if ($networks->id > 0) {

            $model->setId($networks->id);
        }
        return $model;

    }
    /**
     * @param NetworkModel $model
     * @return NetworkModel $model
     */
    private function saveNetworkDevice($model){

        $networks = $this->getNewPDONetworksModel();
        $networks = $networks::find($model->getId());

        $networks->devices()->sync([$model->getDeviceId()]);

        if ($networks->id > 0) {

            $model->setId($networks->id);
        }
        return $model;

    }
    private function verificationNetworkDevice($model){

        $networks = $this->getNewPDONetworksModel();

        $networks = $networks::find($model->getId());

        $devices = $networks->devices()->get();

        foreach ($devices as $device){
            if($device->id == $model->getDeviceId()){
                return true;
            }
        }
        return false;
    }
    /**
     * @return ErrorsModel
     */
    private function getErrorsModel(){
        return new ErrorsModel();
    }

    /**
     * @return SuccessModel
     */
    private function getSuccessModel(){
        return new SuccessModel();
    }
    /**
     * @param $data
     * @return mixed
     */
    private  function generateSuccess($data){
        return [
            'success' => true,
            'data' => $data
        ];
    }
    /**
     * @param string $error
     * @return array
     */
    private  function generateError($error){

        return [
            'success' => false,
            'error' => $error
        ];
    }
    /**
     * @param NetworkModel $model
     * @return NetworkModel $model
     */
    private function getNetwork($model){

        $networks = $this->getNewPDONetworksModel();

        $networks = $networks::where('network_id',$model->getNetworkId())->first();

        if($networks->id > 0){

            $model = $model->loadModelFromPDOModel($networks);

            $model->setDevices($this->getNetworkDevices($networks));
        }

        return $model;

    }

    private function getNetworkDevices($networks)
    {
        $data = array();
        $devices = $networks->devices()->get();
        foreach ($devices as $device){
            $device_obj = new \stdClass;
            $device_obj->id = $device->id;
            $data[] = $device_obj;
        }
        return $data;
    }
}
