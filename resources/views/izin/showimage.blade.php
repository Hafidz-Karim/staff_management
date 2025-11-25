@extends('layouts.app')

@section('content')
@if ($izin != null)
<img src="{{ asset('storage/'.$izin->bukti) }}" alt="gambar storage" style="width:80%;margin:auto;">
@else
<h2>Gambsr tidak ditemukan</h2>
@endif
@endsection
