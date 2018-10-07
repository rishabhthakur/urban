@extends('layouts.admin.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        @include('admin.settings.includes.nav')
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h6 class="heading mb-5">Privacy Settings</h6>
                <h6>Privacy Policy Page</h6>
                <hr>
                <p>
                    As a website owner, you may need to follow national or international privacy laws. For example, you may need to create and display a Privacy Policy. If you already have a Privacy Policy page, please select it below. If not, please create one.
                </p>
                <p>
                    The new page will include help and suggestions for your Privacy Policy. However, it is your responsibility to use those resources correctly, to provide the information that your Privacy Policy requires, and to keep that information current and accurate.
                </p>
                <p>
                    After your Privacy Policy page is set, we suggest that you edit it. We would also suggest reviewing your Privacy Policy from time to time, especially after installing or updating any themes or plugins. There may be changes or new suggested information for you to consider adding to your policy.
                </p>
                <p>
                    <small>
                        Need help putting together your new Privacy Policy page? <a href="#">Check out our guide</a> for recommendations on what content to include, along with policies suggested by your plugins and theme.
                    </small>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h6>Change Your Privacy Policy Page</h6>
                <p>
                    <small><a href="#">Edit</a> or <a href="#">preview</a> your Privacy Policy Page content.</small>
                </p>
                <div>
                    <form action="{!! route('admin.settings.privacy.status') !!}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
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
                                    <input type="checkbox" value="1" name="privacy"
                                        @if ($settings->privacy)
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
    </div>
</div>
@endsection
