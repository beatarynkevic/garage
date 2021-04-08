@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List of trucks</div>

                <div class="card-body">
                    @foreach ($trucks as $truck)
                    {{$truck->maker}} {{$truck->truckMechanic->name}} {{$truck->truckMechanic->surname}} <a href="{{route('truck.edit',[$truck])}}">EDIT</a>
                    <form method="POST" action="{{route('truck.destroy', [$truck])}}">
                        @csrf
                        <button type="submit">DELETE</button>
                    </form>
                    <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
