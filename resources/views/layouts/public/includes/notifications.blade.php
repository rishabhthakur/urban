{{-- <div class="alert alert-white alert-dismissible fade show m-0" role="alert">
    <div class="text-primary">
        <small>
            <strong><i class="fas fa-check-circle"></i> Success</strong>
        </small>
    </div>
    <p class="mb-0">
        Whatever it is that you did worked!
    </p>
</div> --}}

{{-- @if(count($errors) > 0)
  <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    <div class="mb-1">
      <strong>Hold on cheif!</strong>
    </div>
    <ul class="list-unstyled mb-0">
      @foreach($errors->all() as $error)
        <li>
          <p class="m-0">
            {{ $error }}
          </p>
        </li>
      @endforeach
    </ul>
  </div>
@endif --}}

@if(session('success') )
    <div class="alert alert-white alert-dismissible fade show m-0" role="alert">
        <div class="text-primary">
            <small>
                <strong><i class="fas fa-check-circle"></i> Success</strong>
            </small>
        </div>
        <p class="mb-0">
            {{ session('success') }}
        </p>
    </div>
@endif

@if(session('info') )
    <div class="alert alert-info alert-dismissible fade show m-0" role="alert">
        <div class="text-primary">
            <small>
                <strong><i class="fas fa-info-circle"></i> Info</strong>
            </small>
        </div>
        <p class="mb-0">
            {{ session('info') }}
        </p>
    </div>
@endif

@if(session('warning') )
    <div class="alert alert-white alert-dismissible fade show m-0" role="alert">
        <div class="text-warning">
            <small>
                <strong><i class="fas fa-exclamation-circle"></i> Warning</strong>
            </small>
        </div>
        <p class="mb-0">
            {{ session('warning') }}
        </p>
    </div>
@endif

@if(session('error') )
    <div class="alert alert-white alert-dismissible fade show m-0" role="alert">
        <div class="text-danger">
            <small>
                <strong><i class="fas fa-times-circle"></i> Error</strong>
            </small>
        </div>
        <p class="mb-0">
            {{ session('error') }}
        </p>
    </div>
@endif
