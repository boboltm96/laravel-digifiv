<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Chef;

class ChefController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $response = [
            'status' => 200,
            'message' => '',
            'data' => [],
        ];

        try{
            $chefs = Chef::all();
            
            $response['data'] = $chefs;
            $response['message'] = 'success';
        } catch(\Exception $error) {
            $response['status'] = 500;
            $response['message'] = 'Something went wrong';
        }

        return response()->json($response);
    }
}
