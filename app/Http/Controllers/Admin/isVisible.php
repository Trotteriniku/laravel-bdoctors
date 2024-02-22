

//1
public function isVisible() {
    // Controlla se esiste una sponsorizzazione attiva
    $now = Carbon::now();
    return $this->sponsorships()->where('start_date', '<=', $now)->where('end_date', '>=', $now)->exists();
}

//2
// Nel controller della dashboard
public function dashboard() {
    $doctor = Auth::user(); // Assumendo che il dottore sia l'utente autenticato
    $isVisible = $doctor->isVisible();
    return view('doctor.dashboard', compact('isVisible'));
}

//3
@if($isVisible)
    <div>Sei visibile sul sito.</div>
@else
    <div>Non sei attualmente visibile sul sito. Acquista una sponsorizzazione per aumentare la tua visibilità.</div>
@endif


//VUE

//1
Endpoint API per la Visibilità: Crea un endpoint API nel tuo Laravel backend che restituisce lo stato di visibilità del dottore. Questo endpoint può semplicemente restituire il risultato del metodo isVisible() per il dottore autenticato.

// In un controller API
public function checkVisibility() {
    $doctor = Auth::user(); // Ottieni il dottore autenticato
    $isVisible = $doctor->isVisible();
    return response()->json(['isVisible' => $isVisible]);
}


//2 Chiamata API in Vue: Nel tuo componente Vue che mostra lo stato di visibilità

data() {
    return {
        isVisible: false
    }
},
created() {
    axios.get('/api/check-visibility')
        .then(response => {
            this.isVisible = response.data.isVisible;
        })
        .catch(error => {
            console.error("Si è verificato un errore:", error);
        });
}

//3 Visualizzazione Condizionale in Vue: Usa la variabile isVisible per mostrare condizionalmente il messaggio di visibilità nel template del componente Vue.

<div v-if="isVisible">Sei visibile sul sito.</div>
<div v-else>Non sei attualmente visibile sul sito. Acquista una sponsorizzazione per aumentare la tua visibilità.</div>
