<?php namespace App\Http\Controllers;

use App\Models\Advertisement;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdvertisementController extends Controller {

    /**
     * @var Business MODEL
     */
    const MODEL = "App\Models\Advertisement";

    use RESTActions;

    public function hasChanged(Request $request) {
        $this->validate($request, [
            'updated_at' => 'required'
        ]);

        $updatedAt = $request->input('updated_at');

        $model = self::MODEL;

        $count = $model::where('updated_at', ">", $updatedAt)->count();
        $resp = $count > 0 ? true : false;

        return $this->respond(Response::HTTP_OK, ['has_changed' => $resp]);
    }

}
