@extends('layouts.app')

@section('navigation')
    <a href="{{ route('user.index') }}"
       class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('user.*') ? 'text-indigo-700 font-bold' : 'text-gray-700 hover:text-indigo-600' }}">
        User Dashboard
    </a>
    <form method="POST" action="{{ route('user.logout') }}" class="ml-3">
        @csrf
        <button type="submit" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">
            Logout
        </button>
    </form>
@endsection
