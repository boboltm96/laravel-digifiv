@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Chefs Listing') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="container">
                        <div class="row">
                            <a href="{{ route('home') }}" role="button" class="btn btn-outline-secondary mr-2">Back to Main UI</a>
                            <a href="{{ route('chefs.create') }}" role="button" class="btn btn-outline-primary">Add new chefs</a>
                        </div>
                    </div>
                    <table id="chef-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chefs as $chef)
                            <tr>
                                <td>
                                    <a href="{{ route('chefs.show', ['chef' => $chef->id]) }}" role="button" class="btn btn-outline-secondary btn-sm">View</a>
                                    <a href="{{ route('chefs.edit', ['chef' => $chef->id]) }}" role="button" class="btn btn-outline-success btn-sm">Edit</a>
                                    @if($chef->status != $statuses[0])
                                    <a href="#" role="button" class="btn btn-outline-danger btn-sm delete-chef" data-id="{{ $chef->id }}">Delete</a>
                                    @endif
                                </td>
                                <td>{{ $chef->name }}</td>
                                <td>{{ $chef->age }}</td>
                                <td>{{ $chef->address }}</td>
                                <td>{{ $chef->phone }}</td>
                                <td>{{ ucfirst($statuses[$chef->status]) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="delete-chef-form" class="d-none" action="" method="POST">
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
        var table = new DataTable('#chef-table');

        $('.delete-chef').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            if(confirm('Are you sure want to delete this record?') === true) {
                var url = '/chefs/' + id;
                $('#delete-chef-form').attr('action', url);
                document.getElementById('delete-chef-form').submit();
            }
        });
    });
</script>
@endsection