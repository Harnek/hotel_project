@extends('layouts.admin')

@section('content')
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h1 class="app-page-title">Review Details</h1>
            <div class="row gy-4">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Review</h3>
                    <div class="section-intro">Details for the review.</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-sliders"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z" />
                                        </svg>
                                    </div>

                                </div>
                                <div class="col-auto">
                                    <h4 class="app-card-title">Review Details</h4>
                                </div>
                            </div>
                        </div>
                        <div class="app-card-body px-4 w-100">
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Review</strong></div>
                                        <div class="item-data">{{ $review->review }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Rating</strong></div>
                                        <div class="item-data">{{ $review->rating }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Reviewer Name</strong></div>
                                        <div class="item-data">
                                            {{ $review->name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Review Date</strong></div>
                                        <div class="item-data">{{ date('j M, Y', strtotime($review->review_date)) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Status</strong></div>
                                        @if ($review->enabled)
                                            <div class="item-data"><span class="badge bg-success">Visible</span></div>
                                        @else
                                            <div class="item-data"><span class="badge bg-danger">Hidden</span></div>
                                        @endif                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="app-card-footer p-4 mt-auto">
                            @if ($review->enabled)
                                <a class="btn app-btn-secondary" href="{{ url('/admin/reviews/' . $review->id . '/toggle') }}">Hide Review</a>
                            @else
                                <a class="btn app-btn-secondary" href="{{ url('/admin/reviews/' . $review->id . '/toggle') }}">Show Review</a>
                            @endif
                            <a class="btn app-btn-primary" id="btn_delete">Delete Review</a>
                            
                            <form id="form_delete" action="{{ route('admin.reviews') . '/' . $review->id }}" method="POST">
                                @method('DELETE')
                                @csrf
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('footer_extras')
    <script>
        function deleteReview(varid) {
            if (confirm('Are you sure, you want to delete this review?')) {
                document.getElementById('form_delete').submit();
            }
        }

        document.getElementById('btn_delete').onclick = deleteReview;
    </script>
@endsection