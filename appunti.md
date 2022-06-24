## CRUD LATO ADMIN

# procedimento organizzazione lavoro

*****organizzazione primaria*****

1)---> sotto controller creare una cartella chiamata Admin e ci trasciniamo dentro HomeController. Ovviamente non funzionera più nulla perchè abbiamo cambiato il percorso, quindi eseguire i seguenti passi: 
 - nel controller aggiungere:
 ** use App\Http\Controllers\Controller 
 *il namespace lo troviamo cosi:
 namespace App|Http\Controllers
 noi dopo controllers dobbiamo aggiungere \Admin per far pescare il giusto controller.

 - Infine andiamo andare su web.php e sulla rotta il controller attualmente non controlla la rotta perchè è fuori dal namespace quindi al posto di HomeController@index dobbiamo aggiungere Admin/ davanti e funzionerà tutto nuovamente.

 2)-->  Per raggruppare tutte le rotte che appartengono allo stesso contesto utilizziamo un gruppo di rotte:

 Route::group(function(){
    ---> qua dentro ci vanno tutte le rotte
 })

 nella rotta dobbiamo mettere vari metodi come middleware per la protezione, -->quindi andiamo sul controller cancelliamo la sezione middleware e la inseriamo all'interno del ruote group così tutte le rotte sono protette. Abbiamo anche un namespace da mettere al gruppo, perchè se non lo facciamo dobbiamo aggiungerlo ad ogni signola rotta. Inoltre la rotta deve punta ad \admin quindi mettiamo il prefix('admin') così tutte le rotte iniziano col questo prefisso.

 In realtà così facendo non funzionerà nulla perchè ci sta reindirizzando ad home ma  questa rotta non esiste più perchè abbiamo cambiato con admin.home.
 - Per ovviare a questo problema andare su Providers->routeserviceprovicer.php e cambiare la public const Home = da '/home' a '/admin';

 Poichè la pagina si chiama dashboard dobbiamo portare alcune modifiche:
 - andare   su welcome.blade.php e cambiare da /home a /admin. facendo così funzionerà il tutto.

 3)--> HomeController punta alla virw che si chiama home.blade.php. In realtà questa view si trova nel posto sbagliato, perchè abbiamo bisogno di due cartelle : Admin e Guest sotto views. * aggiungere queste due cartelle, e poichè è cambiato il percorso che punta alla view dobbiamo modificare anche il percorso che punta alla view, quindi andiamo sul controller e da modifichiamo la view con admin.home e funzionerà tutto nuovamente.

 ## cosa deve accadere lato frontend??
 per la parte del frontend utilizziano vue e i suoi componenti.
 -- procedura:

 Andare su web.php e inserire come ULTIMA ROTTA:

 Route::get('{any?}', function(){
   return view('guest.home')
 })->where('any', '.*');


andare su guest e creare home.blade.php

Andiamo su leyout e creiamo un file admin.blade.php che in sostanza è una copia di app.blade.php e andiamo ad estenderlo su admin.
Adesso home.blade può estendere il layout principale
 --> andare su app.blade sotto layout e cancellare tutto quello che c'è scritto all'interno del div id:app e mettiamo uno @yield

 Andare sul file admin.blade.php e cambiare fil file js/app.js e css/app.css con admin.js e css
 
 Andiamo nel webpack.mix e aggiungiamo:
 .js('resources/js/admin.js', 'public/js')
  .sass('resources/sass/admin.scss', 'public/css');

  questo perchè abbiamo aggiunto due nuovi file---> vedi a riga 49

  aggiungiamo anche il copyDirectory('resources')


   andare su js, copiare app.js e incollare nella stessa cartella js e rinominare in js, stessa cosa per il file sass e avviare npm run watch


##vue

giunti a questo punto possiamo fare il primo componente vue:

## procedimento::

1) andare nella cartella js e creare una cartella view,
aggiungere un file App.vue
---> finito questo passaggio, andare su app.js e dobbiamo specificare il componente che deve importare con import app... ecc... 
inoltre sotto el = 'app', mettiamo il render: h => h(app) quindi l'app legge il componente e lo serve qualora la rotta non sarà identificabile. Eliminare la welcome.blade


## modello, migrazione e seeder

1) creare model con php artisan make:model nome -a così crea tutto quello che ci serve

- prendiamo il post controller e lo trasciniamo all'interno di admin, perchè appunto fa parte della sezione amministratore, aggiorniamo i namespace come abbiamo fatto all'inizio.

- Diamo le proprietà fillable al modello e andiamo a fare la classica migrazione nella sezione migrazioni...

nel seeder utilizziamo faker importandolo con 
use Faker\Generator ad Faker;

generiamo le info fake tramite un ciclo for, salviamo e subito dopo popoliamo il db!

controlliamo il db tramite il comando php artisan ti e digitiamo nomemodello::all(); e dovrebbe ritornare la lista delle info all'interno del database.
 

 ##CRUDD
 Arrivati a questo punto possiamo creare la prima view index: --> andiamo nel motedo index nel cui dovbbiamo restituire una view che chiameremo admin.posts.index che dovrà cercare con compact una lista di posts.

 A questo punto dobbiamo andare su web.php e dobbiamo creare la rotta, ovviamente all'interno del group. 
 Route::resource('posts', 'PostController');

 Assicuriamo con un dd di ricevere le informazioni e andiamo nel terminale e digitiamo php route:list per controllare se tutte le rotte sono giuste.

 -> per fare la struttura andiamo su bootstrap.

 andiamo su home.blade.php e al post dell'avviso dell'avvenuto login mettiamo un pulsante che ci permetterà di inserire un nuovo post
 --> dopo andiamo nel controller, su create andiamo a ritornare la view return view('admin.posts.create');

 creiamo la view create a aggiungiamo tutti i form necessari con un bottone all'interno submit per l'invio

 andiamo sul postcontroller e digitiamo dd($request->all()) per verificare se carica il post


 2) --> Dopo che ci assicuriamo che il dd funziona e restituisce il from dobbiamo validare i dati:
 inviamo il comando :
 --> php artisan make:request PostRequest

 Dopo andiamo di nuovo sul post controller e sul store, prima di request mettiamo PostRequest e automaticamente lo imposta soopra  e facciamo le modifiche nei @param delle funzioni.

