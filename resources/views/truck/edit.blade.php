@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit pavadinimas</div>
                <div class="card-body">
                    <form method="POST" action="{{route('truck.update', [$truck])}}">

                        <div class="form-group">
                            <label>Maker</label>
                            <input type="text" class="form-control" name="truck_maker" value="{{old('truck_maker',$truck->maker)}}" >
                            <small class="form-text text-muted">Please enter truck maker</small>
                        </div>
                        <div class="form-group">
                            <label>Plate</label>
                            <input type="text" class="form-control" name="truck_plate" value="{{old('truck_plate',$truck->plate)}}">
                            <small class="form-text text-muted">Please enter plate</small>
                        </div>
                        <div class="form-group">
                            <label>Year</label>
                            <input type="text" class="form-control" name="truck_make_year" value="{{old('truck_make_year',$truck->make_year)}}">
                            <small class="form-text text-muted">Please enter year</small>
                        </div>

                        <div class="form-group">
                            <label>Notices</label>
                            <textarea id="summernote" name="truck_mechanic_notices">{{$truck->mechanic_notices}}</textarea>
                            <small class="form-text text-muted">Parasykite ka nors</small>
                        </div>

                        <div class="form-group">
                            <label>Mechanic: </label>
                            <select name="mechanic_id">
                                @foreach ($mechanics as $mechanic)
                                <option value="{{$mechanic->id}}" @if($mechanic->id == $truck->mechanic_id) selected @endif>
                                    {{$mechanic->name}} {{$mechanic->surname}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Please select mechanics name</small>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        $('#summernote').summernote();
    });

</script>
@endsection
