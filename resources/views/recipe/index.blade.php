@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Recipes Listing') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="container">
                        <div class="row">
                            <a href="{{ route('home') }}" role="button" class="btn btn-outline-secondary mr-2">Back to Main UI</a>
                            <a href="{{ route('recipes.create') }}" role="button" class="btn btn-outline-primary">Add new recipe</a>
                        </div>
                    </div>
                    <table id="recipe-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Popularity</th>
                                <th>Ingredient</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recipes as $recipe)
                            <tr>
                                <td>
                                    <a href="{{ route('recipes.show', ['recipe' => $recipe->id]) }}" role="button" class="btn btn-outline-secondary btn-sm">View</a>
                                    <a href="{{ route('recipes.edit', ['recipe' => $recipe->id]) }}" role="button" class="btn btn-outline-success btn-sm">Edit</a>
                                    @if($recipe->status != $statuses[0])
                                    <a href="#" role="button" class="btn btn-outline-danger btn-sm delete-recipe" data-id="{{ $recipe->id }}">Delete</a>
                                    @endif
                                </td>
                                <td>{{ $recipe->category->name }}</td>
                                <td>{{ $recipe->name }}</td>
                                <td>{{ $recipe->popularity }}</td>
                                <td>
                                    @foreach($recipe->ingredients as $ingredient)
                                        <span>{{ $ingredient->name }}</span> <br />
                                    @endforeach
                                </td>
                                <td>{{ ucfirst($statuses[$recipe->status]) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="delete-recipe-form" class="d-none" action="" method="POST">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('css')
<style>

</style>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        var table = new DataTable('#recipe-table');

        $('.delete-recipe').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            if(confirm('Are you sure want to delete this record?') === true) {
                var url = '/recipes/' + id;
                $('#delete-recipe-form').attr('action', url);
                document.getElementById('delete-recipe-form').submit();
            }
        });
    });
</script>
@endsection