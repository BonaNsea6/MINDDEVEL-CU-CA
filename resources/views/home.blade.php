@extends('layouts.app1')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">          

            Dashboard
            <h1>L'année en cours est {{ $currentYear }}</h1>
            </div>
        </div>
    </div>
</div>
@endsection
