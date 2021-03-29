@if (session()->has('message'))
    <div class="alert alert-custom alert-light-success shadow fade show mb-5" role="alert">
        <div class="alert-icon"><i class="fa fa-check-circle"></i></div>
        <div class="alert-text">{{ session('message') }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
@elseif (session()->has('warning-message'))
    <div class="alert alert-custom alert-light-warning shadow fade show mb-5" role="alert">
        <div class="alert-icon"><i class="fa fa-exclamation-circle"></i></div>
        <div class="alert-text">{{ session('warning-message') }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
@elseif (session()->has('error-message'))
    <div class="alert alert-custom alert-light-danger shadow fade show mb-5" role="alert">
        <div class="alert-icon"><i class="fa fa-times-circle"></i></div>
        <div class="alert-text">{{ session('error-message') }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
@endif