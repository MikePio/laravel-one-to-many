@extends('layouts.app')

@section('content')

<div class="container overflow-auto p-5 d-flex flex-column align-items-center" style="max-height: calc(100vh - 70.24px);">

<h1 class="py-4">Types</h1>

<p class="text-center fs-6">On this page, you can add a type, edit a type name and/or delete a type. <br>Remember to save the edited type name.</p>

<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Enter a type name" aria-label="Enter a type name">
  <button class="btn btn-primary" type="button">Add Type</button>
</div>

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
        <td><input class="border-0" type="text" value="{{ $type->name }}"></td>
        <td>{{ count($type->projects) }}</td>

        <td>
          {{--* button per salvare l'EDIT (la modifica del singolo type) --}}
          <a href="" class="btn btn-primary" onclick="return confirm('Confirm the edit of this type: {{ $type->name }} ?')"><i class="fa-solid fa-floppy-disk"></i></a>

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

@endsection
