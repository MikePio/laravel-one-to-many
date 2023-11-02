<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//* per generare lo slug in questo caso
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    //* array utilizzato per centralizzare i campi della tabella in modo da rendere più leggibile store() in PageController.php (per creare un nuovo progetto)
  protected $fillable = [
    'name',
    'type_id',
    'slug',
    'description',
    'category',
    'start_date',
    'end_date',
    'url',
    'produced_for',
    'collaborators',
    'image_path',
    'image_original_name'
  ];

  //* collegamento/relazione con la tabella type
  public function type(){ // il nome della tabella in camelCase al singolare (type) perché ogni project ha un solo tipo
    // belongsTo = Appartiene a
    return $this->belongsTo(Type::class);
  }

    //* funzione per generare uno slug univoco
  public static function generateSlug($str){

    $slug = Str::slug($str, '-');
    $original_slug = $slug;

    $slug_exists = Project::where('slug', $slug)->first();
    // contatore
    $c = 1;

    //controllo di univocità
    // 1. controllo se lo slug è già presente
    // 2. se non è presente ritorno sullo slug generato
    // 3. se è presente aggiungo un contatore
    // 4. se anche il numero del contatore è presente aggiungo +1 al contatore fino a trovare uno slug univoco

    while($slug_exists){
      $slug = $original_slug . '-' . $c;
      $slug_exists = Project::where('slug', $slug)->first();
      $c++;
    }

    return $slug;
  }

}
