@extends('layouts.app')

@section('content')

<div class="container overflow-auto p-5 d-flex flex-column align-items-center" style="max-height: calc(100vh - 70.24px);">

<h1 class="py-4">Types</h1>


@if (session('message'))
  <div class="alert alert-success" role="alert">
    {{ session('message') }}
  </div>
@endif

<p class="text-center fs-6">On this page, you can add a type, edit a type name and/or delete a type. <br>Remember to save the edited type name.</p>

<form action="{{ route('admintypes.store') }}" method="POST">
  <div class="input-group mb-3">
    @csrf
    <input name="name" type="text" class="form-control" placeholder="Enter a type name" aria-label="Enter a type name">
    <button class="btn btn-primary" type="submit">Add Type</button>
  </div>
</form>

<table class="table table-hover">
  <thead class="thead-dark">
    <tr class="">
      <th scope="col">#ID</th>
      <th scope="col">Name</th>
      <th scope="col">Number of projects</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($types as $type)

      <tr>
        <td>{{ $type->id }}</td>
        <td>
          <form action="{{ route('admintypes.update', $type) }}" method="POST" id="edit_form">
            @csrf
            @method('PUT')
            <input name="name" class="border-0" type="text" value="{{ $type->name }}">
          </form>
        </td>
        <td>{{ count($type->projects) }}</td>

        <td>
          {{--* button per salvare l'EDIT (la modifica del singolo type) --}}
          <button onclick="submitEditForm()" class="btn btn-primary" onclick="return confirm('Confirm the edit of this type: {{ $type->name }} ?')"><i class="fa-solid fa-floppy-disk"></i></button>

          {{--* button per DELETE (eliminare il singolo type) --}}
          <form action="" method="POST" class="d-inline" onsubmit="return confirm('Confirm deletion of this type: {{ $type->name }} ?')">
            @csrf
            {{--* aggiungere DELETE perchè non è possibile inserire PUT/PATCH nel method del form al posto di POST --}}
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
          </form>
        </td>
      </tr>

    @endforeach


  </tbody>
</table>

<div>
  {{ $types->links() }}
</div>

</div>

<script>
  function submitEditForm(){
    const form = document.getElementById('edit_form');
    form.submit();
  }
</script>

@endsection
