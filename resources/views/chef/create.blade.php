@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add new chef') }}</div>

                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <a href="{{ route('chefs.index') }}" role="button" class="btn btn-outline-primary">Back</a>
                        </div>
                        <form class="row" action="{{ route('chefs.store') }}" method="POST">
                            @csrf
                            <div class="mb-3 col-12">
                                <label for="chef-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="chef-name" placeholder="Abu bin Bakar" name="name">
                            </div>

                            <div class="mb-3 col-12">
                                <label for="chef-age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="chef-age" placeholder="" min="18" name="age">
                            </div>

                            <div class="mb-3 col-12">
                                <label for="chef-phone" class="form-label">Mobile Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="chef-phone">+60</span>
                                    <input type="text" class="form-control" placeholder="124852679" aria-label="Mobile Phone" aria-describedby="chef-phone" name="phone">
                                </div>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="chef-address" class="form-label">Address</label>
                                <textarea class="form-control" row="5" placeholder="Jln Cerdas 10, Taman Cerdik, 54321 Kuala Lumpur" name="address"></textarea>
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

</style>
@endsection

@section('js')
<script>
    $(document).ready(function() {

    });
</script>
@endsection