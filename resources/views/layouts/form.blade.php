@extends('layouts.app')

@section('content')
    <main>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                @yield('form')
            </div>
        </div>
    </main>
@endsection