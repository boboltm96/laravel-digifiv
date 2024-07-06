@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit recipe') }}</div>

                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <a href="{{ route('recipes.index') }}" role="button" class="btn btn-outline-primary">Back</a>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form class="row" action="{{ route('recipes.update', ['recipe' => $recipe->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 col-12">
                                <label for="recipe-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="recipe-name" placeholder="Nasi Lemak" name="name" value="{{ $recipe->name }}">
                            </div>

                            <div class="mb-3 col-12">
                                <label for="recipe-code" class="form-label">Code</label>
                                <input type="text" class="form-control" id="recipe-code" placeholder="UA011" name="code" value="{{ $recipe->code }}">
                            </div>

                            <div class="mb-3 col-12">
                                <label for="recipe-category" class="form-label">Categories</label>
                                <select class="form-select form-control" id="recipe-category" name="category" data-category="{{ $recipe->category_id }}">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="recipe-chef" class="form-label">Cooked by</label>
                                <select class="form-select form-control" id="recipe-chef" name="cooked_by" data-chef="{{ $recipe->chef_id }}">
                                    @foreach($chefs as $chef)
                                        <option value="{{ $chef->id }}">{{ $chef->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="recipe-status" class="form-label">Status</label>
                                <select class="form-select form-control" data-v="{{ $recipe->status }}" id="recipe-status" name="status">
                                    @foreach($statuses as $value => $label)
                                        <option value="{{ $value }}">{{ ucfirst($label) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label">Ingredients</label>
                                <div class="ingredient-section">
                                    @foreach($recipe->ingredients as $ingredient)
                                    <div class="input-group ingredient-row mb-3">
                                        <input type="text" class="form-control col-9 mr-1" placeholder="" name="ingredients[]" value="{{ $ingredient->name }}">
                                        <button class="btn btn-outline-success add-ingredient-btn col-1 mr-1" type="button">+</button>
                                        <button class="btn btn-outline-danger rmv-ingredient-btn col-1" type="button">-</button>
                                    </div>
                                    @endforeach
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
<style>
.ingredient-row:first-child > .rmv-ingredient-btn {
    display: none;
}
</style>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#recipe-status').val($('#recipe-status').data('v')).change();
        $('#recipe-chef').val($('#recipe-chef').data('chef')).change();
        $('#recipe-category').val($('#recipe-category').data('category')).change();

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