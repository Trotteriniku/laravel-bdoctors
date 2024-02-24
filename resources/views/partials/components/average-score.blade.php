<div class="card">
    <div class="info-card revenue-card w-100">



        <div class="card-body">
            <h5 class="card-title">Media stelle</h5>

            <div class="d-flex align-items-center">
                <div class=" card-icon rounded-circle d-flex align-items-center justify-content-center"
                    style="background-color: #fffaa3;">
                    <i class="fa-regular fa-star text-warning"></i>
                </div>

                <div class="ps-3">
                    @if ($averageRating)
                        <span class="text-success small pt-1 fw-bold display-6">{{ substr($averageRating, 0, 3) }}</span>
                    @endif
                    @if (!$averageRating)
                        <span class="text-success  pt-1 fw-bold">Ancora nessuna stella <i
                                class="fa-solid fa-face-sad-cry"></i> <br> <a
                                href="{{ route('admin.sponsors.index') }}">Sponsorizzati <i class="fa-solid fa-rocket"
                                    style="color: #263656;"></i></a></span>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
