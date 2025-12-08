@extends('admin.layout')

@section('content')
    <div class="max-w-3xl mx-auto mt-8 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Tambah Pegawai</h2>

        <form action="{{ route('admin.pegawai.store') }}" method="POST">
            @csrf

            <label class="block mb-2">Nama</label>
            <input name="name" class="w-full border p-2 rounded mb-3" value="{{ old('name') }}">

            <label class="block mb-2">Email</label>
            <input name="email" class="w-full border p-2 rounded mb-3" value="{{ old('email') }}">

            <label class="block mb-2">Jabatan</label>
            <input name="jabatan" class="w-full border p-2 rounded mb-3" value="{{ old('jabatan') }}">

            <label class="block mb-2">No HP</label>
            <input name="no_hp" class="w-full border p-2 rounded mb-3" value="{{ old('no_hp') }}">

            <label class="block mb-2">Password (opsional)</label>
            <input type="password" name="password" class="w-full border p-2 rounded mb-3">
            <label class="block mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border p-2 rounded mb-3">

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
@endsection
