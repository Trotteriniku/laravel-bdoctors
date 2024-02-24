 <!-- Sponsor Card -->
 <div class="col-xxl-4 col-md-6">
     <div class="card info-card sales-card">


         <div class="card-body">
             <h5 class="card-title">Sponsor</h5>
             <div class="d-flex align-items-center">
                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                     <i class="fa-solid fa-rocket" style="color: #263656;"></i>
                 </div>
                 <div class="ps-3">
                     @if ($activeSponsor)
                         <h6 class="text-nowrap days-left d-inline-block">
                         </h6>
                         <a href="{{ route('admin.sponsors.index') }}" class="d-inline time-left"
                             data-end-time="{{ $activeSponsor->end_date }}" style="font-size: 1.2em">
                             <!-- Il contenuto di questo tag verrà aggiornato via JS -->
                         </a>
                         <div>
                             Scade il
                             {{ \Carbon\Carbon::parse($activeSponsor->end_date)->format('d/m/Y') }}
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
                             endTimeDays.innerHTML = `<strong>${days} giorni</strong>`
                             endTimeElement.innerHTML = `${hours}:${minutes}:${seconds} `;
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
 <div class="col-xxl-4 col-md-6">
     <div class="card info-card revenue-card">

         <div class="card-body">
             <h5 class="card-title">Recensioni </h5>

             <div class="d-flex align-items-center ">
                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                     <i class="fa-regular fa-thumbs-up"></i>
                 </div>
                 <div class="ps-3">
                     <a href="{{ route('admin.reviews.index') }}"
                         class="text-danger small pt-1 fw-bold display-6">{{ $totalReviews }}</a>

                 </div>
             </div>
         </div>

     </div>
 </div><!-- End Revenue Card -->


 <!-- Messages Card -->
 <div class="col-xxl-4 col-xl-12">

     <div class="card info-card customers-card">



         <div class="card-body">
             <h5 class="card-title">Messaggi</h5>
             <div class="d-flex align-items-center ">
                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                     <i class="fa-regular fa-comment"></i>
                 </div>
                 <div class="ps-3">

                     <a href="{{ route('admin.messages.index') }}"
                         class="text-danger small pt-1 fw-bold display-6">{{ $totalMessages }}</a>

                 </div>
             </div>

         </div>
     </div>
