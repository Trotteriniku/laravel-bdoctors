<div class="card">


    <div class="card-body">

        <h5 class="card-title">Recensioni</h5>
        @if (count($reviews))

            <div class="activity">
                @foreach ($reviews as $review)
                    <div class="activity-item d-flex">
                        <div class="activite-label">{{ $review->created_at->format('H:i') }}</div>
                        <i class='fa-solid fa-circle-fill activity-badge text-success align-self-start'></i>
                        <div class="activity-content">

                            <a href="{{ route('admin.reviews.show', $review->id) }}"
                                class="fw-bold text-dark">{{ $review->title }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <span>non ci sono recensioni</span>
        @endif
    </div>
</div>
