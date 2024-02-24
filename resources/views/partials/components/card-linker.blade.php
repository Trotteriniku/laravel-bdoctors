 <!-- Sponsor Card -->
 <div class="col-12 col-md-6">
     <div class="card info-card sales-card position-relative ">
         <div class="card-body">
             <h5 class="card-title">Sponsor</h5>
             <div class="d-flex align-items-center">
                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                     <i class="fa-solid fa-rocket" style="color: #263656;"></i>
                 </div>
                 <div class="ps-3 ">
                     @if ($activeSponsor)
                         <h6 class="text-nowrap days-left d-inline-block">
                         </h6>
                         <a href="{{ route('admin.sponsors.index') }}" class="d-inline time-left "
                             data-end-time="{{ $activeSponsor->end_date }}" style="font-size: 1.2em">
                             <!-- Il contenuto di questo tag verrà aggiornato via JS -->
                         </a>
                         <div class=" position-absolute top-0 end-0 px-3 py-2 ">
                             Scade il
                             <span
                                 class="fw-semibold">{{ \Carbon\Carbon::parse($activeSponsor->end_date)->format('d/m/Y') }}</span>
                         </div>
                     @else
                         <a class="text-nowrap" href="{{ route('admin.sponsors.index') }}">acquista uno sponsor</a>
                     @endif
                 </div>
             </div>
         </div>
         <!-- script -->
         @if ($activeSponsor)
             <script>
                 document.addEventListener('DOMContentLoaded', function() {
                     const endTimeElement = document.querySelector('.time-left');
                     const endTimeDays = document.querySelector('.days-left')
                     const endTime = new Date(endTimeElement.dataset.endTime).getTime();

                     function updateCountdown() {
                         const now = new Date().getTime();
                         const distance = endTime - now;
                         //alert(distance);
                         // Calcola ore, minuti e secondi
                         //  const days = Math.floor((distance % (1000 * 60 * 60 * 24 )) / (1000 * 60 * 60 * 24));
                         const days = Math.floor((distance / (1000 * 60 * 60 * 24)));
                         const hours = Math.floor((distance % (1000 * 60 * 60 * 24) / (1000 * 60 * 60)));
                         const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                         const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                         // Aggiorna il contenuto di endTimeElement con ore, minuti e secondi
                         if (distance < 0) {
                             endTimeDays.innerHTML = "";
                             endTimeElement.innerHTML = "Acquista uno sponsor gia ";
                             clearInterval(countdownInterval); // Interrompe l'aggiornamento se la sponsorizzazione è scaduta
                         } else {
                             if (days === 1) {
                                 endTimeDays.innerHTML =
                                     `<strong>${days} giorno </strong> <span class="text-dark fw-light">e</span>`
                             } else {
                                 endTimeDays.innerHTML =
                                     `<strong class"">${days} giorni  </strong> <span class="text-dark fw-light">e</span>`
                             }

                             endTimeElement.innerHTML =
                                 `<div><strong style="color: #0476D9;">${hours}:${minutes}:${seconds}  </strong> <span class="text-dark fw-light">ore rimanenti </span></div>`;
                         }
                     }

                     updateCountdown(); // Aggiorna subito il countdown
                     const countdownInterval = setInterval(updateCountdown, 1000); // Aggiorna ogni secondo
                 });
             </script>
         @endif


         <!-- fine script -->


     </div>
 </div><!-- End Sales Card -->

 <!-- Revenue Card -->
 <div class="col-12 col-md-3">
     <div class="card info-card revenue-card">

         <div class="card-body">
             <h5 class="card-title">Recensioni Totali </h5>

             <div class="d-flex align-items-center ">
                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                     <i class="fa-solid fa-book-open"></i>
                 </div>
                 <div class="ps-3 d-flex justify-content-between">
                     <a href="{{ route('admin.reviews.index') }}" class="text-danger small pt-1 fw-bold display-6">
                         {{ $totalReviews }}</a>
                     {{--     <span>Recensioni Totali</span> --}}
                 </div>
             </div>
         </div>

     </div>
 </div><!-- End Revenue Card -->


 <!-- Messages Card -->
 <div class="col-12 col-md-3">

     <div class="card info-card customers-card">



         <div class="card-body">
             <h5 class="card-title">Messaggi Ricevuti</h5>
             <div class="d-flex align-items-center ">
                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                     <i class="fa-regular fa-comment"></i>
                 </div>
                 <div class="ps-3">

                     <a href="{{ route('admin.messages.index') }}" class="text-danger small pt-1 fw-bold display-6">
                         {{ $totalMessages }}</a>

                 </div>
             </div>

         </div>
     </div>
