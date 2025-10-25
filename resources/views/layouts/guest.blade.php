@extends('layouts.app')

@section('navigation')
    <a href="{{ route('user.login') }}"
       class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-indigo-600">
        User Login
    </a>
    <a href="{{ route('admin.login') }}"
       class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-indigo-600">
        Admin Login
    </a>
@endsection
