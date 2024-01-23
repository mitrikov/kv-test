<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppealFormRequest;
use App\Models\Appeal;
use App\Repositories\AppealRepositoryTypes;
use Illuminate\Http\JsonResponse;


class AppealController extends Controller
{
    public function recieve(AppealFormRequest $req) : JsonResponse {

        $req->validated();

//        if($req->has("name")) {
//            $result .= " " . $req->get("name");
//        }
//
//        if($req->has("phone")) {
//            $result .= " " . $req->get("phone");
//        }
//
//        if($req->has("content")) {
//            $result .= " " . $req->get("content");
//        }

        $appeal = new Appeal();
        $appeal->fill($req->all());

        $result = $appeal->toArray();

        $appeal->setRepository(AppealRepositoryTypes::Db)->save();
        $appeal->setRepository(AppealRepositoryTypes::File)->save();

        return response()->json($result, 201);
    }
}
