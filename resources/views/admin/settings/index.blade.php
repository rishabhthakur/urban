@extends('layouts.admin.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        @include('admin.settings.includes.nav')
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h6 class="heading mb-5">General Settings</h6>
                <form class="settings-form" action="{!! route('admin.settings.store') !!}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="site_name">Site Name</label>
                        <input type="text" id="site_name" class="form-control form-control-alternative" name="site_name" value="{{ $settings->site_name }}">
                    </div>
                    <div class="form-group">
                        <label for="tagline">Tagline</label>
                        <input type="text" id="tagline" class="form-control form-control-alternative" name="tagline" value="{{ $settings->tagline }}">
                        <span class="text-muted">
                            <small>In a few words, explain what this site is about.</small>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="author">Site Author</label>
                        <input type="text" id="author" class="form-control form-control-alternative" name="author" value="{{ $settings->author }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Site Description</label>
                        <textarea name="description" class="form-control form-control-alternative" style="height: 150px">{{ $settings->description }}</textarea>
                        <span class="text-muted">
                            <small>Site description will be used for SEO purposes and to describe what your site is about in detail to the public.</small>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="email">Admin Email</label>
                        <input type="text" id="email" class="form-control form-control-alternative" name="email" value="{{ $settings->email }}">
                        <span class="text-muted">
                            <small>This address is used for admin purposes. If you change this we will send you an email at your new address to confirm it. The new address will not become active until confirmed.</small>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="role">New User Default Role</label>
                        <select class="custom-select form-control-alternative" name="role" id="role">
                            @foreach($roles as $role)
                                <option @if ($role->id == $settings->drole) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group clearfix">
                        <label>Membership</label>
                        <p class="text-muted">
                            <small>Anyone can register.</small>
                        </p>
                        <div>
                            <label for="membership" data-on-label="Yes" data-off-label="No"></label>
                            <label class="custom-toggle">
                                <input type="checkbox" value="1"
                                    @if ($settings->membership)
                                        checked
                                    @endif>
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- App status -->
    <div class="col-md-5">
        <div class="card">
            <div class="card-header border-0 bg-primary text-white">
                Site Information
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group clearfix">
                        <label>Site Status</label>
                        <p class="text-success">
                            <span class="badge badge-success">Website operational</span>
                        </p>
                        <div>
                            <label for="membership" data-on-label="Yes" data-off-label="No"></label>
                            <label class="custom-toggle">
                                <input type="checkbox" value="1"
                                    @if ($settings->status)
                                        checked
                                    @endif>
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                        <span class="text-muted form-text">
                            <small>Dissable to activate <strong>maintenance mode</strong>.</small>
                        </span>
                    </div>
                    <hr>
                    <div class="form-group clearfix">
                        <label>Privay Policy Page</label>
                        <p class="text-muted">
                            <small>Website privacy policy page
                                @if ($settings->privacy)
                                    <span class="badge badge-success">active</span>
                                @else
                                    <span class="badge badge-danger">inactive</span>
                                @endif.
                            </small>
                        </p>
                        <div>
                            <label for="membership" data-on-label="Yes" data-off-label="No"></label>
                            <label class="custom-toggle">
                                <input type="checkbox" value="1"
                                    @if ($settings->privacy)
                                        checked
                                    @endif>
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                        <span class="text-muted form-text">
                            <a href="#">View</a> or <a href="#">edit</a>
                        </span>
                    </div>
                    <hr>
                    <div class="form-group clearfix">
                        <label>Terms and Conditions Page</label>
                        <p class="text-muted">
                            <small>Website terms and conditions page
                                @if ($settings->legal)
                                    <span class="badge badge-success">active</span>
                                @else
                                    <span class="badge badge-danger">inactive</span>
                                @endif
                                .
                            </small>
                        </p>
                        <div>
                            <label for="membership" data-on-label="Yes" data-off-label="No"></label>
                            <label class="custom-toggle">
                                <input type="checkbox" value="1"
                                    @if ($settings->legal)
                                        checked
                                    @endif>
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                        <span class="text-muted form-text">
                            <a href="#">View</a> or <a href="#">edit</a>
                        </span>
                    </div>
                    <hr>
                    <div class="form-group clearfix">
                        <label>Copyright Information</label>
                        <p class="text-muted">
                            <small>Use custom website footer copyright Information.</small>
                        </p>
                        <div>
                            <label for="membership" data-on-label="Yes" data-off-label="No"></label>
                            <label class="custom-toggle">
                                <input id="copyright_check" type="checkbox" value="1"
                                    @if ($settings->copyright)
                                        checked
                                    @endif>
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                    </div>
                    <div id="copyright_custom" class="form-group">
                        <label for="">Copyright Text</label>
                        <input type="text" name="copyright_text" class="form-control form-control-alternative" value="copyright @ 2018 Fabraco. All rights reserved.">
                    </div>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-primary mt-4">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('settings-js')
<script type="text/javascript">
    var copyCheck = document.getElementById('copyright_check');
    var copyCustom = document.getElementById('copyright_custom');
    copyCheck.onclick = function() {
        if(copyCheck.checked) {
            copyCustom.style.display = 'block';
        } else {
            copyCustom.style.display = 'none';
        }
    };
    copyCustom.style.display = 'none';
</script>
@endsection