@extends('auth.account.includes.layout', ['title' => 'Account'])

@section('section')
    <div class="mb-4">
        <form action="{{ route('account.update', ['id' => Auth::Id()]) }}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first_name">First Name <span>*</span></label>
                    <input type="text" class="form-control" name="first_name" placeholder="First Name" id="first_name" value="{{ Auth::User()->profile->first_name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name">Last Name <span>*</span></label>
                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" id="last_name" value="{{ Auth::User()->profile->last_name }}" required>
                </div>
                <div class="col-12 mb-4">
                    <label for="email_address">Email Address <span>*</span></label>
                    <input type="email" class="form-control" name="email" placeholder="Email Address" id="email_address" value="{{ Auth::User()->email }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="company">Company Name</label>
                    <input type="text" class="form-control" placeholder="Company Name" id="company" name="company" value="{{ Auth::User()->profile->company }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="job">Job Title</label>
                    <input type="text" class="form-control" placeholder="Job Title" id="job" name="job" value="{{ Auth::User()->profile->job }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone">Phone No <span>*</span></label>
                    <input type="text" class="form-control" name="phone" placeholder="Phone No" id="phone" min="0" value="{{ Auth::User()->profile->phone }}">
                </div>
                <div class="col-12 mb-3 mt-5">
                    <h6>Social Links</h6>
                    <hr>
                </div>
                <div class="col-md-4 mb-2">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" name="facebook" placeholder="Phone No" id="facebook" min="0" value="{{ Auth::User()->profile->facebook }}">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" name="twitter" placeholder="Phone No" id="twitter" min="0" value="{{ Auth::User()->profile->twitter }}">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" name="instagram" placeholder="Phone No" id="instagram" min="0" value="{{ Auth::User()->profile->instagram }}">
                </div>
                <div class="col-12 mb-4 mt-5">
                    <button type="submit" class="btn essence-btn">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
@endsection
