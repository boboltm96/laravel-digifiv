@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('View recipe') }}</div>

                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <a href="{{ route('recipes.index') }}" role="button" class="btn btn-outline-primary">Back</a>
                        </div>

                        <div class="mb-3 col-12">
                            <label for="recipe-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="recipe-name" placeholder="Nasi Lemak" name="name" value="{{ $recipe->name }}" readonly>
                        </div>

                        <div class="mb-3 col-12">
                            <label for="recipe-code" class="form-label">Code</label>
                            <input type="text" class="form-control" id="recipe-code" placeholder="UA011" name="code" value="{{ $recipe->code }}" readonly>
                        </div>

                        <div class="mb-3 col-12">
                            <label for="recipe-category" class="form-label">Categories</label>
                            <select class="form-select form-control" id="recipe-category" name="category" data-category="{{ $recipe->category_id }}" readonly>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-12">
                            <label for="recipe-chef" class="form-label">Cooked by</label>
                            <select class="form-select form-control" id="recipe-chef" name="cooked_by" data-chef="{{ $recipe->chef_id }}" readonly>
                                @foreach($chefs as $chef)
                                    <option value="{{ $chef->id }}">{{ $chef->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Ingredients</label>
                            <div class="ingredient-section">
                                @foreach($recipe->ingredients as $ingredient)
                                <div class="input-group ingredient-row mb-3">
                                    <input type="text" class="form-control" placeholder="" name="ingredients[]" value="{{ $ingredient->name }}" readonly>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
.ingredient-row:first-child > .rmv-ingredient-btn {
    display: none;
}
</style>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#recipe-chef').val($('#recipe-chef').data('chef')).change();
        $('#recipe-category').val($('#recipe-category').data('category')).change();
    });
</script>
@endsection