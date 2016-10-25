@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">            
            
            @include('widgets.stockquote')

        </div>
        <div class="col-md-8">
        <h1>Other great content here</h1>
        </div>
    </div>
</div>
@endsection
