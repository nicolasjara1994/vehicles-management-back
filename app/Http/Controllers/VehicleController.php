<?php

namespace App\Http\Controllers;

use Nette\Utils\Json;
use App\Models\Vehicle;
use App\Models\UserVehicle;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\HistoryUserVehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        return new JsonResponse($vehicles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMultiple(Request $request)
    {
        $vehicles = $request->input("vehicles");
        $vehicles = json_decode($vehicles);

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }

        return new JsonResponse([
            "msje" => "Proceso realizado exitosamente"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehiculo = Vehicle::find($id);
        $historial = HistoryUserVehicle::where("vehicle_id", $id)->get();
        $owner = $vehiculo->userVehicle()
                    ->get()
                    ->toArray();

        $result = [];
        $result["user"] = $owner;
       
        foreach ($historial as $e) {
            $owner = UserVehicle::find($e->owner_id);
            $result["historial"][] = [
                "owner" => $owner,
                "created_at" => $e->created_at,
            ];
        }

        return new JsonResponse($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
