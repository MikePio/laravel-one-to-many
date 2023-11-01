@extends('layouts.app')

@section('content')

<div class="container overflow-auto p-5 d-flex flex-column align-items-center" style="max-height: calc(100vh - 70.24px);">

<h1 class="py-4">Types</h1>

<table class="table table-hover">
  <thead class="thead-dark">
    <tr class="">
      <th scope="col">#ID</th>
      <th scope="col">Name</th>
      <th scope="col">Number of projects</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($types as $type)

      <tr>
        <td>{{ $type->id }}</td>
        <td>{{ $type->name }}</td>
        <td>{{ count($type->projects) }}</td>

        </td>
      </tr>

    @endforeach


  </tbody>
</table>

</div>

@endsection
