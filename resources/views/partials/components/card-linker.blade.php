 <!-- Sponsor Card -->
 <div class="col-xxl-4 col-md-6">
     <div class="card info-card sales-card">



         <div class="card-body">
             <h5 class="card-title">Sponsor</h5>

             <div class="d-flex align-items-center">
                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                     <i class="fa-solid fa-piggy-bank"></i>
                 </div>
                 <div class="ps-3">
                     <h6 class="text-nowrap">ore totali</h6>


                 </div>
             </div>
         </div>

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
