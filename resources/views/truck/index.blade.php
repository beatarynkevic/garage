@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>trucks List</h2>

                    <div class="make-inline">
                        <form action="{{route('truck.index')}}" method="get" class="make-inline">
                            <div class="form-group make-inline">
                                <label>Filter by:</label>
                                <select class="form-control" name="mechanic_id">
                                    <option value="0" disabled @if($filterBy==0) selected @endif>Select mechanic</option>
                                    @foreach ($mechanics as $mechanic)
                                    <option value="{{$mechanic->id}}" @if($filterBy==$mechanic->id) selected @endif>
                                        {{$mechanic->name}} {{$mechanic->surname}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <label>Sort by type:</label>
                            <div class="form-group form-check make-inline">
                                <input type="radio" name="sort" value="asc" class="form-check-input" id="sortASC" @if($sortBy=='asc' ) checked @endif>
                                <label class="form-check-label" for="sortASC">ASC</label>
                                <div class="form-group form-check make-inline">
                                    <input type="radio" name="sort" value="desc" class="form-check-input" id="sortDESC" @if($sortBy=='desc' ) checked @endif>
                                </div>
                                <label class="form-check-label" for="sortDESC">DESC</label>
                            </div>

                            <button type="submit" class="btn btn-info ">Filter</button>
                        </form>
                        <a href="{{route('truck.index')}}" class="btn btn-info">Clear filter</a>
                    </div>

                    <div class="make-inline" style="padding-top:20px;">
                        <form action="{{route('truck.index')}}" method="get" class="make-inline">
                            <div class="form-group make-inline">
                                <label>Filter by: </label>
                                <select class="form-control" name="maker">
                                    <option value="0" disabled @if($filterByMaker==0) selected @endif>Select truck maker</option>

                                    @foreach ($pvz as $truck)
                                    <option value="{{$truck->maker}}" @if($filterByMaker==$truck->maker) selected @endif>
                                        {{$truck->maker}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <label>Sort by type:</label>
                            <button type="submit" class="btn btn-info ">Filter</button>
                        </form>
                    </div>
                </div>
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
