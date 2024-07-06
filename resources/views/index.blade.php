@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Main UI') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('chefs.index') }}" role="button" class="btn btn-outline-primary">Go to Chef Page</a>
                    <a href="{{ route('recipes.index') }}" role="button" class="btn btn-outline-primary 
                        @if (session('role') != 'chef') {{ 'disabled no-chef-role' }} @endif">
                    Go to Recipe Page</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    a.btn.disabled {
        cursor: not-allowed;
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('.no-chef-role').on('click', function() {
            alert('Kindly switch to chef role to access this page');
        });
    });
</script>
@endsection