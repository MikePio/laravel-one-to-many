**Laravel One To Many**
===
## **Descrizione esercizio precedente**
Creare un nuovo progetto con Laravel Breeze ed il pacchetto Laravel 9 Preset con autenticazione.

Separare gli ambienti Guest da quelli Admin per quanto riguarda: stili, js, controller, viste e layout.

Infine creare la CRUD(Create, Read, Update e Delete) di un Portfolio.

Include nella CRUD del portfolio l’aggiunta dell’immagine e la sua relativa eliminazione.

## **Descrizione esercizio da svolgere**
Continuare a lavorare su un progetto precedente (laravel-auth) ma in una nuova repo e aggiungere una nuova entità **Type**. 

Questa entità rappresenta la tipologia di progetto ed è in relazione **one to many** con i progetti.

I task da svolgere sono:
- creare la migration per la tabella `types`
- creare il model `Type`
- creare la migration di modifica per la tabella `projects` per aggiungere la chiave esterna
- aggiungere ai model Type e Project i metodi per definire la relazione one to many
- visualizzare nella pagina di dettaglio di un progetto la tipologia associata, se presente
- permettere all’utente di associare una tipologia nella pagina di creazione e la modifica di un progetto
- gestire il salvataggio dell’associazione progetto-tipologia con opportune regole di validazione

## **BONUS 1**
Creare il seeder per il model Type e il seeder della tabella ‘projects’ con l’id del type (random) in relazione

## **BONUS 2**
Aggiungere le operazioni CRUD per il model Type, in modo da gestire le tipologie di progetto direttamente dal pannello di amministrazione.

---------------------------------------

# **Passaggi**

## **Creare un progetto con Breeze integrato**


1. 

composer create-project --prefer-dist laravel/laravel:^9.2 nome_progetto

OPPURE (MENO PREFERIBILE)

composer create-project laravel/laravel:^9.2 nome-cartella


2. PER ENTRARE NELLA CARTELLA !!! IMPORTANTE

cd nome-cartella


3. !!! Dentro la cartella !!!

composer require laravel/breeze --dev

OPPURE (MENO PREFERIBILE)

composer require laravel/breeze

4. 
php artisan breeze:install

CLICCARE:
0
INVIO
INVIO

5. 
composer require pacificdev/laravel_9_preset

6. !!! IMPORTANTE AGGIUNGERE --auth

php artisan preset:ui bootstrap --auth


---------------------------------------

npm i

composer install

---------------------------------------

php artisan key:generate 

npm run dev

php artisan serve

--------------------------------------

## **PASSAGGI SUCCESSIVI**

- creare un DATABASE in myPhpAdmin e collegarlo nel file .env inserendo il nome

- php artisan migrate

-------------------

- creare i file nelle cartelle resources/js e resources/scss 
	- in resources/js ->     appGuest.js
	- in resources/scss ->   appGuest.scss 
	- importare bootstrap -> @import '~bootstrap/scss/bootstrap';

- Aggiungere i percorsi in " vite.config.js "
	- modificare l'input in =  input: ['resources/scss/app.scss', 'resources/js/app.js', 'resources/scss/appGuest.scss', 'resources/js/appGuest.js'],

- in " views/layout/guest.blade.php " cambiare la riga @vite da css a scss
	- @vite(['resources/scss/appGuest.scss', 'resoureces/js/appGuest.js'])

- in " App/Http/Providers/RouteServiceProvider.php " sostituire la parola /dashboard con /admin  
	- public const HOME = '/admin';

--------------------------------------

- creare una cartella " guest " nelle view
	- creare un file home.blade.php

- Creare il controller Guest/PageController 
	- php artisan make:controller Guest/PageController 

- richiamare nel controller Guest/PageController la function index per restituire la view di guest.home
	- class PageController extends Controller{
		public function index(){
			return view('guest.home');
		}
	  }

- richiamare la rotta in route/web.php (*cancellare le altre rotte di default)
	- use App\Http\Controllers\Guest\PageController;
	- Route::get('/', [PageController::class, 'index'])->name('home');

--------------------------------------

- Creare una cartella " admin " nelle view
	- creare un file home.blade.php
	- Copiare il CONTENUTO del file " dashboard.blade.pphp " ed incollare all'interno di " home.blade.php "

- Creare il controller Admin/DashboardController 
	- php artisan make:controller Admin/DashboardController 

- richiamare nel controller Admin/DashboardController la function index per restituire la view di admin.home
	- class PageController extends Controller{
		public function index(){
			return view('admin.home');
		}
	  }

- Aggiungere la rotta nella route/web.php USANDO MIDDLEWARE
	- use App\Http\Controllers\Admin\DashboardController;
	- Route::middleware(['auth', 'verfied'])
		->name('admin')
		->prefix('admin')
		->group(function(){
			Route::get('/', [DashboardController::class, index])->name('home');
		});

--------------------------------

- Eliminare i file di default
	- dashboard.blade.php
	- welcome.blade.php

-------------------------------
# **CRUD**

## **Breve riepilogo: Rotte resource**

**comics.index** -> GET -> funzione del controller: index -> view: comics.index

**comics.show/{comic}** -> GET -> funzione del controller: show -> view: comics.show

---------------------------------------------------

**comics.create** -> GET -> funzione del controller: create -> view: comics.create (contiene il form di creazione)

**comics.create** INVIA IL FORM IN ***POST*** a comics.store

**comics.store** -> ***POST*** -> controlla la validità del dato, lo salva  e reindirizza a comics.show

---------------------------------------------------

**comics.edit{comic}** -> GET -> funzione del controller: edit -> view: **comics.edit** (contiene il form di modifica)

**comics.edit** INVIA IL FORM IN PUT a comics.update

---------------------------------------------------

**comics.update** -> ***PUT*** -> controlla la validità del dato, lo aggiorna  e reindirizza a comics.show

---------------------------------------------------

**comics.destroy** -> ***DELETE*** -> elimina il dato e reindirizza a comics.index
