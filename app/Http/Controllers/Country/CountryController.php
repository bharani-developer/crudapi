<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountryModel;
use Validator;

class CountryController extends Controller
{
    public function country()
    {
        return response()->json(CountryModel::get()->all(), 200);
    }
    public function countryById($id)
    {
        $country = CountryModel::find($id);
        if (is_null($country)) {
            return response()->json(["message" => "Record not found!"], 404);
        }
        return response()->json($country, 200);
    }
    public function countrySave(Request $request)
    {
        $rules = [
            'iso' => 'required',
            'name' => 'required',
            'dname' => 'required',
            'iso3' => 'required',
            'position' => 'required',
            'numcode' => 'required',
            'phonecode' => 'required',
            'created' => 'required',
            'register_by' => 'required',
            'modified' => 'required',
            'modified_by' => 'required',
            'record_deleted' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $country = CountryModel::create($request->all());
        return response()->json($country, 201);
    }
    public function countryUpdate(Request $request, $id)
    {
        $country = CountryModel::find($id);
        if (is_null($country)) {
            return response()->json(["message" => "Record not found!"], 404);
        }
        $country->update($request->all());
        return response()->json($country, 200);
    }
    public function countryDelete(Request $request, $id)
    {
        $country = CountryModel::find($id);
        if (is_null($country)) {
            return response()->json(["message" => "Record not found!"], 404);
        }
        $country->delete();
        return response()->json(null, 204);
    }
}
