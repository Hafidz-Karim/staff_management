@extends('pegawai.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">👤 Profil Saya</h1>

<div class="bg-white p-6 shadow rounded-lg">
    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
</div>
@endsection
