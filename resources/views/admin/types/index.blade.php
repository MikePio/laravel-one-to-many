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
      <th scope="col">Number of types</th>
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
          <button title="Save and Update the Type" onclick="submitEditForm()" class="btn btn-primary" onclick="return confirm('Confirm the edit of this type: {{ $type->name }}?')"><i class="fa-solid fa-floppy-disk"></i></button>

          {{--* button per DELETE (eliminare il singolo type) --}}
<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#type{{ $type->id }}" title="Delete type">
  {{-- OPPURE --}}
  {{-- <button type="button" class="btn btn-danger d-inline" data-bs-toggle="modal" data-bs-target="#exampleModal" title="Delete type" style="padding: 6px 12px; width: 42px; height: 38px; display: inline-block;"> --}}
    <i class = "fa-solid fa-trash d-inline"></i>
  </button>

  <!-- Modal -->
  <div class="modal fade text-black" id="type{{ $type->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  {{-- OPPURE --}}
  {{-- <div class="modal fade text-black" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> --}}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete type "<strong>{{ $type->name }}</strong>"</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this type?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          {{--* button per DELETE (eliminare il singolo progetto) --}}
          <form action = "{{ route('admintypes.destroy', $type) }}" method = "POST" class="d-inline">
            @csrf
            {{--* aggiungere DELETE perchè non è possibile inserire PUT/PATCH nel method del form al posto di POST --}}
            @method('DELETE')
            <button type = "submit" class = "btn btn-danger" title="Delete type">Delete</a>
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
