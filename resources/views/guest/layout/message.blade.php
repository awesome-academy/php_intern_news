@if (Session::has('success') || Session::has('error'))
    <div class="alert {{ Session::has('error') ? 'alert-danger' : 'alert-success' }} alert-dismissible fade show"
        role="alert">
        <strong>{{ Session::get('success', Session::get('error')) }}!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
