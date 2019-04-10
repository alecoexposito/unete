<?php namespace App\Http\Controllers;


use App\Models\Business;
use App\Models\BusinessClient;
use App\Models\Client;
use App\Models\ClientType;
use App\Models\ClientTypeDependence;
use App\Models\Dependence;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller {

    const MODEL = "App\Models\Client";

    use RESTActions;

    public function registerVisit($id, Request $request) {

        $this->validate($request, [
            'dependence_id' => 'required',
            'visited_at' => 'required',
        ]);
        $client = Client::query()->findOrFail($id);
        $visitedAt = $request->input("visited_at");
        $dependenceId = $request->input("dependence_id");

        $dependence = Dependence::query()->findOrFail($dependenceId);

        $businessId = $dependence->business()->pluck("id")->first();

        $businessClient = $this->getBusinessClient($id, $businessId);
        $businessClientId = $businessClient->id;
        $visit = Visit::query()->create([
            'business_client_id' => $businessClientId,
            'visited_at' => $visitedAt,
            'dependence_id' => $dependenceId
        ]);
        $clientTypeId = $businessClient->clientType()->pluck("id")->first();
        $clientTypeDependence = ClientTypeDependence::query()->where(['client_type_id' => $clientTypeId, $dependenceId])->first();
        $globalPercent = $clientTypeDependence->global_percent;
        $localPercent = $clientTypeDependence->local_percent;
        if($globalPercent > 0) {
            $amount = $request->input("amount");
            $value = ($amount + $globalPercent) / 100;

        }

        return response()->json($businessClient);
    }

    private function getBusinessClient($clientId, $businessId) {
        $businessClient = BusinessClient::query()->firstOrNew(["client_id" => $clientId, "business_id" => $businessId]);
        if(!$businessClient->exists) {
            $clientTypeId = ClientType::query()->where(['business_id' => $businessId, 'order' => 1])->pluck("id")->first();
            $businessClient->client_type_id = $clientTypeId;
            $businessClient->save();
        }
        return $businessClient;
    }

}
