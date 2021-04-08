@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update mechanic</div>

                <div class="card-body">
                    <form method="POST" action="{{route('mechanic.update',[$mechanic->id])}}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="mechanic_name" value="{{$mechanic->name}}">
                            <small class=" form-text text-muted">Please enter your name</small>
                        </div>
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" class="form-control" name="mechanic_surname" value="{{$mechanic->surname}}">
                            <small class="form-text text-muted">Please enter your surname</small>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-info">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
