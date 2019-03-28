<?php namespace App\Http\Controllers;


use App\Models\Business;
use App\Models\BusinessClient;
use App\Models\Client;
use App\Models\ClientType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller {

    const MODEL = "App\Models\Client";

    use RESTActions;

    public function registerVisit($id, Request $request) {

        $this->validate($request, [
            'business_id' => 'required',
        ]);

        $client = Client::query()->find($id);
        if(is_null($client)){
            return $this->respond(Response::HTTP_NOT_FOUND);
        }

        $businessId = $request->input("business_id");
        $business = Business::find($businessId);
        if(is_null($business)){
            return $this->respond(Response::HTTP_NOT_FOUND, ['message' => 'El negocio no existe']);
        }

        $businessClient = $this->getBusinessClient($id, $businessId);

        return response()->json($client);
    }

    private function getBusinessClient($clientId, $businessId) {
        $businessClient = BusinessClient::query()->firstOrNew(["client_id" => $clientId, "business_id" => $businessId]);
        if(!$businessClient->exists) {
            $clientTypeId = ClientType::query()->where(['business_id' => $businessId, 'order' => 1])->firstOrFail();
            $businessClient->client_type_id = $clientTypeId;
        }
        return $businessClient;
    }

}
