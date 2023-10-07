@extends('layout')
@section('content')
<p>{{ $contacts['name'] }}</p>
<a href="{{ $contacts['github'] }}" style='color:red' target="_blank">Github link</a>
@endsection