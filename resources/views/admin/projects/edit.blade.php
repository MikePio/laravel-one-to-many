@extends('layouts.app')

@section('content')


<div class="container overflow-auto p-5 d-flex flex-column align-items-center" style="max-height: calc(100vh - 70.24px);">

  <div class="d-flex align-items-center">
    <h1 class="me-3" >Edit Project: {{ $project->name }}
        <!-- {{--! QUESTO BLOCCO DI CODICE è STATO SOSTITUITO DA UN PARTIAL (form-delete.blade.php)   --}}
        {{--* button per DELETE (eliminare il singolo progetto) --}}
        <form action="{{ route('adminprojects.destroy', $project) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirm deletion of the project: {{ $project->name }} ?')">
          @csrf
          {{--* aggiungere DELETE perchè non è possibile inserire PUT/PATCH nel method del form al posto di POST --}}
          @method('DELETE')
          <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
        </form>
      -->
    </h1>
    @include('admin.partials.form-delete')
  </div>

  {{-- {{ $errors }} --}}
  {{-- se $errors->any() è true ci sono degli errori nella sessione  --}}
  @if ($errors->any())

    <div class="alert alert-danger mt-4" role="alert">
      <ul>
        {{-- $errors->all() inserisce gli errori in un array che viene ciclato solo se $errors->any() è true --}}
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>

  @endif

  <form action="{{ route('adminprojects.update', $project) }}" method="POST" enctype="multipart/form-data">    {{-- //* token IMPORTANTE di verifica validità del form (viene utilizzato per dare una maggiore sicurezza ai dati) --}}
    @csrf
    {{--* aggiungere PUT perchè non è possibile inserire PUT/PATCH nel method del form al posto di POST --}}
    @method('PUT')

    <div class="mb-3" style="width: 150vh; max-width: 73vw;">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name Project" value="{{ old('name', $project?->name)}}">
    </div>
    <div class="mb-3" style="width: 150vh; max-width: 73vw;">
      <label for="name" class="form-label">Types</label>
      <select class="form-select" name="type_id">
        <option value="" selected>Select a type</option>
        @foreach ($types as $type)
          {{-- senza old --}}
          {{-- <option value="{{ $type->id }}">{{ $type->name }}</option> --}}
          {{-- con old --}}
          <option value="{{ $type->id }}" @if($type->id == old('type_id', $project->type?->id)) selected @endif>{{ $type->name }}</option>
        @endforeach
      </select>
    </div>
    @error('name')
      <p class="text-danger">{{ $message }}</p>
    @enderror
    <div class="mb-3" style="width: 150vh; max-width: 73vw;">
      <label for="image" class="form-label">Image</label>
      {{-- <input onchange="showImagePreview(event)" type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image', $project?->image_original_name) }}"> --}}
      <input onchange="showImagePreview(event)" type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" >      {{-- <img height="300px" class="mt-3 bg-white {{ $project?->image_path ? "" : "px-5" }}" id="prev-img" src="{{ asset('storage/' . $project?->image_path) }}"  alt="{{ $project?->name }}"> --}}
      <img class="w-25 mt-3 bg-white {{ $project?->image_path ? '' : 'px-5' }}" id="prev-img" src="{{ $project?->image_path ? asset('storage/' . $project?->image_path) : Vite::asset('resources/img/placeholder-img.png') }}" alt="{{ $project?->image_path == false ? "No image" : $project?->name }}">    </div>
    @error('image')
      <p class="text-danger">{{ $message }}</p>
    @enderror
    <div class="mb-3" style="width: 150vh; max-width: 73vw;">
        <label for="category" class="form-label">Category</label>
        <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" placeholder="Category" value="{{ old('category', $project?->category)}}">
    </div>
    @error('category')
      <p class="text-danger">{{ $message }}</p>
    @enderror
    <div class="mb-3" style="width: 150vh; max-width: 73vw;">
        <label for="start_date" class="form-label">Start date</label>
        <input type="text" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" placeholder="YYYY-MM-DD" value="{{ old('start_date', $project?->start_date)}}">
    </div>
    @error('start_date')
    <p class="text-danger">{{ $message }}</p>
  @enderror
    <div class="mb-3" style="width: 150vh; max-width: 73vw;">
        <label for="end_date" class="form-label">End date</label>
        <input type="text" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" placeholder="YYYY-MM-DD" value="{{ old('end_date', $project?->end_date)}}">
    </div>
    @error('end_date')
    <p class="text-danger">{{ $message }}</p>
  @enderror
    <div class="mb-3" style="width: 150vh; max-width: 73vw;">
        <label for="url" class="form-label">url</label>
        <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="url" value="{{ old('url', $project?->url)}}">
    </div>
    @error('url')
    <p class="text-danger">{{ $message }}</p>
  @enderror
    <div class="mb-3" style="width: 150vh; max-width: 73vw;">
        <label for="produced_for" class="form-label">Produced for</label>
        <input type="text" class="form-control @error('produced_for') is-invalid @enderror" id="produced_for" name="produced_for" placeholder="personal use, name client" value="{{ old('produced_for', $project?->produced_for)}}">
    </div>
    @error('produced_for')
    <p class="text-danger">{{ $message }}</p>
  @enderror
    <div class="mb-3" style="width: 150vh; max-width: 73vw;">
        <label for="collaborators" class="form-label">Collaborators</label>
        <input type="text" class="form-control @error('collaborators') is-invalid @enderror" id="collaborators" name="collaborators" placeholder="Collaborators" value="{{ old('collaborators', $project?->collaborators)}}">
    </div>
    @error('collaborators')
    <p class="text-danger">{{ $message }}</p>
  @enderror
    <div class="mb-3" style="width: 150vh; max-width: 73vw;">
        <label for="description" class="form-label">Description</label>
        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description" style="height: 200px;">{{ old('description', $project?->description)}}</textarea>
    </div>
    @error('description')
    <p class="text-danger">{{ $message }}</p>
  @enderror

    <button type="submit" class="btn btn-primary mt-3">Submit</button>

  </form>

</div>

<script>

  // text-area di ck-editor
  ClassicEditor
      .create( document.querySelector( '#description' ) )
      .catch( error => {
          console.error( error );
      } );

  // {{-- * funzione per mostrare l'anteprima delle immagini
  function showImagePreview(event){
    // {{-- * 1. passare event come paramentro e fare un console.log di event in modo da visualizzare dei dati che descrivono l'evento, in questo caso, scaturito dall'inserimento di un immagine
    // console.log(event);
    // {{-- * 2. nel console.log di event per vedere da dove arriva l'event bisogna osservare il "taget"
    // console.log(event.target);
    // {{-- * 3. nel console.log di event.target è possibile vedere "files" in cui c'è un array con l'immagine (/o una lista di file)
    // console.log(event.target.files[0]);
    // {{-- * 4. l'immagine viene salvata (nella chache e quindi) in un "URL" locale del browser
    // quindi con URL.createObjectURL() richiamo l'url con percorso dell'immagine
    // console.log(URL.createObjectURL(event.target.files[0]));
    const tagImage = document.getElementById('prev-img');
    tagImage.src = URL.createObjectURL(event.target.files[0]);
    // condizione non necessaria solo per rimuovere il padding alle images inserite
    if(tagImage){
      tagImage.classList.remove("px-5");
    }

  }

</script>

@endsection
