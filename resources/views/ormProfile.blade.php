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

    <section class="profile-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img class="image-profile rounded" src="images/{{Auth::user()->upload_img}}" alt="profile_image" width="200px">
                </div>
                <div class="col-md-9">
                    <div>
                        <span>Name: </span>
                        <span class="h3">{{Auth::user()->lname}}, {{Auth::user()->fname}} 
                            @if(Auth::user()->mname != "-")
                                {{Auth::user()->mname}}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection