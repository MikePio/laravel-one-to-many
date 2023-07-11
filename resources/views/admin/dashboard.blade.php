@extends('layouts.app')

@section('content')

<div class="container overflow-auto px-5 pt-5 pb-4 text-center" style="max-height: calc(100vh - 70.24px);">
  <h1>Dashboard</h1>
  <h3>Number of posts present: <strong>{{ $n_projects }}</strong></h3>
  {{-- <h1 class="pb-3">Last post</h1> --}}



  <a href="{{ route('adminprojects.create') }}" class="btn btn-primary mt-2">Add a new project</i></i></a>

</div>

@endsection
