@extends('layouts.app')

@section('content')
  <div class="px-4 py-5 my-5 text-center">
    <h1 class="display-5 fw-bold">{{ __('Hi ') }}{{ Auth::user()->first_name }}</h1>
      <div class="col-lg-6 mx-auto">

      </div>
  </div>


@endsection