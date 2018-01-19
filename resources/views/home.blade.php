@extends('layouts.app')

@section('title', config('app.name') . ' | Maps')

@section('scripts')
    {!! $map['js'] !!}
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fa fa-map"></i> Maps Demo</h4>
                </div>
                <div class="card-body">
                    {!! $map['html'] !!}
                    <div id="directionsDiv"></div>
                </div>
            </div>
        </div>
    </div><!--row-->
@endsection

