<div class="row">
    <div class="col-12">
        <div class="px-4">
            @if(count($errors) > 0)
              <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
                {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true" class="dripicons-cross font-13 text-white"></span>
                </button> --}}
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
            @endif

            @if(session('success') )
              <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
                {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">
                    <small><i class="dripicons-cross font-13 text-white"></i></small>
                  </span>
                </button> --}}
                <strong>Success!</strong> {{ session('success') }}
              </div>
            @endif

            @if(session('info') )
              <div class="alert alert-info alert-dismissible fade show m-0" role="alert">
                {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">
                    <small><i class="dripicons-cross font-13 text-white"></i></small>
                  </span>
                </button> --}}
                <strong>Did you know?</strong> {{ session('info') }}
              </div>
            @endif

            @if(session('warning') )
              <div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
                {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">
                    <small><i class="dripicons-cross font-13 text-white"></i></small>
                  </span>
                </button> --}}
                <strong>Oops!</strong> {{ session('warning') }}
              </div>
            @endif

            @if(session('error') )
              <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
                {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">
                    <small><i class="dripicons-cross font-13 text-white"></i></small>
                  </span>
                </button> --}}
                 <strong>Hold on cheif!</strong> {{ session('error') }}
              </div>
            @endif
        </div>
    </div>
</div>
