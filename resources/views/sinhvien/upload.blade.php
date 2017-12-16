
@extends('layouts.layoutSV')

@section('content')

@if (session('alert_ok'))
    <div class="alert alert-success">
        {{ session('alert_ok') }}
    </div>
    @endif
    @if (session('alert_not'))
    <div class="alert alert-danger">
        {{ session('alert_not') }}
    </div>
    @endif




<form action="{{ url('file') }}" enctype="multipart/form-data" method="POST">
        {{ csrf_field() }}
        <input type="file" name="filesTest" required="true">
        <br/>
        <input type="submit" value="upload">
    </form>
    
@endsection