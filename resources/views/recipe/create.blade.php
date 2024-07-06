@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add new recipe') }}</div>

                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <a href="{{ route('recipes.index') }}" role="button" class="btn btn-outline-primary">Back</a>
                        </div>
                        <form class="row" action="{{ route('recipes.store') }}" method="POST">
                            @csrf
                            <div class="mb-3 col-12">
                                <label for="recipe-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="recipe-name" placeholder="Nasi Lemak" name="name">
                            </div>

                            <div class="mb-3 col-12">
                                <label for="recipe-code" class="form-label">Code</label>
                                <input type="text" class="form-control" id="recipe-code" placeholder="UA011" name="code">
                            </div>

                            <div class="mb-3 col-12">
                                <label for="recipe-category" class="form-label">Categories</label>
                                <select class="form-select form-control" id="recipe-category" name="category">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="recipe-chef" class="form-label">Cooked by</label>
                                <select class="form-select form-control" id="recipe-chef" name="cooked_by">
                                    @foreach($chefs as $chef)
                                        <option value="{{ $chef->id }}">{{ $chef->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label">Ingredients</label>
                                <div class="ingredient-section">
                                    <div class="input-group ingredient-row mb-3">
                                        <input type="text" class="form-control col-9 mr-1" placeholder="" name="ingredients[]">
                                        <button class="btn btn-outline-success add-ingredient-btn col-1 mr-1" type="button">+</button>
                                        <button class="btn btn-outline-danger rmv-ingredient-btn col-1" type="button">-</button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
.ingredient-row:first-child > .rmv-ingredient-btn {
    display: none;
}
</style>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.ingredient-section').on('click', '.add-ingredient-btn', function() {
            var elem = $(this).closest('.ingredient-row').clone();
            $('.ingredient-section').append(elem);
        });

        $('.ingredient-section').on('click', '.rmv-ingredient-btn', function() {
            $(this).closest('.ingredient-row').remove();
        });
    });
</script>
@endsection