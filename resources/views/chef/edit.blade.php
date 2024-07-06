@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit chef') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="container">
                        <div class="row">
                            <a href="{{ route('chefs.index') }}" role="button" class="btn btn-outline-primary">Back</a>
                        </div>
                        <form class="row" action="{{ route('chefs.update', ['chef' => $chef->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3 col-12">
                                <label for="chef-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="chef-name" placeholder="Abu bin Bakar" name="name" value="{{ $chef->name }}">
                            </div>

                            <div class="mb-3 col-12">
                                <label for="chef-age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="chef-age" placeholder="" min="18" name="age" value="{{ $chef->age }}">
                            </div>

                            <div class="mb-3 col-12">
                                <label for="chef-phone" class="form-label">Mobile Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="chef-phone">+60</span>
                                    <input type="text" class="form-control" placeholder="124852679" aria-label="Mobile Phone" aria-describedby="chef-phone" name="phone" value="{{ $chef->phone }}">
                                </div>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="chef-address" class="form-label">Address</label>
                                <textarea class="form-control" row="5" placeholder="Jln Cerdas 10, Taman Cerdik, 54321 Kuala Lumpur" name="address">{{ $chef->address }}</textarea>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="chef-status" class="form-label">Status</label>
                                <select class="form-select form-control" data-v="{{ $chef->status }}" id="chef-status" name="status">
                                    @foreach($statuses as $value => $label)
                                        <option value="{{ $value }}">{{ ucfirst($label) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
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

</style>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#chef-status').val($('#chef-status').data('v')).change();
    });
</script>
@endsection