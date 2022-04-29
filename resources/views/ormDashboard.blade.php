@extends('layouts.ormApp')

@push('styles')
    <!-- Styles and Script Here -->
@endpush

@section('content')
    <section class="stock-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-auto">
                    <!-- @if(Auth::User()->upload_img)
                    <img class="image" src="images/{{Auth::user()->upload_img}}" alt="profile_image" style="width: 80px;height: 80px; padding: 10px; margin: 0px;">
                    @endif -->
                </div>
            </div>
        </div>
    </section>
@endsection