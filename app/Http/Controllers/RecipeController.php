<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chef;
use App\Recipe;
use App\Categories;
use App\Ingredient;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all()->load('ingredients', 'category');
        $statuses = Recipe::$status;

        return view('recipe.index', [
            'recipes' => $recipes,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $chefs = Chef::all();
        $categories = Categories::all();

        return view('recipe.create', [
            'chefs' => $chefs,
            'categories' => $categories,
        ]);
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
        try{
            $chef = Chef::findOrFail($request->cooked_by);
            $category = Categories::findOrFail($request->category);

            $recipe = new Recipe;
 
            $recipe->name = $request->name;
            $recipe->code = $request->code;
            $recipe->chef_id = $chef->id;
            $recipe->category_id = $category->id;
            $recipe->save();

            $recipe_id = $recipe->id;

            $ingredients = $request->ingredients;
            
            $ingredient_ids = [];
            foreach($ingredients as $ingredient) {
                if(!empty($ingredient)) {
                    $in = Ingredient::firstOrCreate([
                        'name' => strtolower($ingredient),
                    ]);

                    $ingredient_ids[] = $in->id;
                }
            }
            $recipe->ingredients()->attach($ingredient_ids);

        } catch (\Exception $error) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
        return redirect()->route('recipes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $recipe = Recipe::with('ingredients', 'category')->findOrFail($id);
            $statuses = Recipe::$status;
            $categories = Categories::all();
            $chefs = Chef::all();
            return view('recipe.show', [
                'recipe' => $recipe,
                'statuses' => $statuses,
                'categories' => $categories,
                'chefs' => $chefs,
            ]);
        }catch (\Exception $error) {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try {
            $recipe = Recipe::with('ingredients', 'category')->findOrFail($id);
            $statuses = Recipe::$status;
            $categories = Categories::all();
            $chefs = Chef::all();

            return view('recipe.edit', [
                'recipe' => $recipe,
                'statuses' => $statuses,
                'categories' => $categories,
                'chefs' => $chefs,
            ]);
        }catch (\Exception $error) {
            abort(404);
        }
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
        try{
            $chef = Chef::findOrFail($request->cooked_by);
            $category = Categories::findOrFail($request->category);

            $recipe = Recipe::findOrFail($id);
 
            $recipe->name = $request->name;
            $recipe->code = $request->code;
            $recipe->chef_id = $chef->id;
            $recipe->category_id = $category->id;
            $recipe->status = $request->status;
            $recipe->save();

            $recipe_id = $recipe->id;

            $ingredients = $request->ingredients;
            
            $ingredient_ids = [];
            foreach($ingredients as $ingredient) {
                if(!empty($ingredient)) {
                    $in = Ingredient::firstOrCreate([
                        'name' => strtolower($ingredient),
                    ]);
                    $ingredient_ids[] = $in->id;
                }
            }
            $recipe->ingredients()->sync($ingredient_ids);

        } catch (\Exception $error) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
        return redirect()->route('recipes.index');
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
        try {
            $recipe = Recipe::findOrFail($id);

            $recipe->ingredients()->detach();
            $recipe->delete();

            return redirect()->back()->with('success', 'Recipe information successfully deleted.');
        }catch (\Exception $error) {
            abort(404);
        }
    }
}