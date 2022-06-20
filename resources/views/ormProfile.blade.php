@extends('layouts.ormApp')


@push('styles')
    <!-- Style External File -->
    <link href="{{ asset('css/orm-manageuser-style.css') }}" rel="stylesheet">
@endpush

@section('content')
    <section class="head-title sticky-top">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="title">
                        <h1>My Profile</h1>
                    </div>
                </div>
            </div>  
        </div>
    </section>
@endsection