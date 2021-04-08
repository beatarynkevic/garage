@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List of trucks</div>

                <div class="card-body">
                    <ul class="list group">
                        @foreach ($trucks as $truck)
                        <li class="list-group-item list-line">
                            <div class="list-line__trucks">
                                <div class="list-line__trucks__maker">
                                    {{$truck->maker}}
                                </div>
                                <div class="list-line__trucks__mechanic">
                                    {{$truck->truckMechanic->name}} {{$truck->truckMechanic->surname}}
                                </div>
                            </div>
                            <div class="list-line__buttons">
                                <a href="{{route('truck.pdf', [$truck])}}" class="btn btn-warning">PDF</a>
                                <a href="{{route('truck.edit',[$truck])}}" class="btn btn-info">EDIT</a>
                                <form method="POST" action="{{route('truck.destroy', [$truck])}}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
