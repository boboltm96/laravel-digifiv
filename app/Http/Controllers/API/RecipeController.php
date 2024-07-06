<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Recipe;

class RecipeController extends Controller
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
            $recipes = Recipe::all()->load('ingredients', 'category');
            
            $response['data'] = $recipes;
            $response['message'] = 'success';
        } catch(\Exception $error) {
            $response['status'] = 500;
            $response['message'] = 'Something went wrong';
        }

        return response()->json($response);
    }

    public function search(Request $request) {
        $response = [
            'status' => 200,
            'message' => '',
            'data' => [],
        ];

        try{
            $ingredients = explode(',', $request->ingredients);

            // search recipes by ingredient name;
            $recipes = Recipe::whereHas('ingredients', function ($query) use ($ingredients) {
                if(is_array($ingredients)) {
                    $query->whereIn('ingredients.name', $ingredients);
                } else {
                    $query->where('ingredients.name', '=', $ingredients);
                }
            })->get();

            // increase the recipe popularity by 1 after user searched on this recipe
            foreach($recipes as $recipe) {
                $r = Recipe::findOrFail($recipe->id);
                $r->popularity = $r->popularity+1;
                $r->save();
            }
        
            $response['data'] = $recipes;
            $response['message'] = 'success';
        } catch(\Exception $error) {
            $response['status'] = 500;
            $response['message'] = 'Something went wrong';
        }

        return response()->json($response);
    }
}
