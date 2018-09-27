@extends('layouts.admin.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        @include('admin.settings.includes.nav')
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h6 class="heading mb-5">Discussion Settings</h6>
                <form class="" action="index.html" method="post">
                    {{ csrf_field() }}
                    <div class="form-group mb-5 clearfix">
                        <h6>Default article settings</h6>
                        <hr>
                        <div class="row">
                            <div class="col-md-9">
                                <label>Attempt to notify any blogs linked to from the article</label>
                            </div>
                            <div class="col-md-3">
                                <div class="text-right">
                                    <label for="membership" data-on-label="Yes" data-off-label="No"></label>
                                    <label class="custom-toggle">
                                        <input type="checkbox" value="1">
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <label>Allow link notifications from other blogs (pingbacks and trackbacks) on new articles</label>
                            </div>
                            <div class="col-md-3">
                                <div class="text-right">
                                    <label for="membership" data-on-label="Yes" data-off-label="No"></label>
                                    <label class="custom-toggle">
                                        <input type="checkbox" value="1">
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <label>Allow people to post comments on new articles</label>
                            </div>
                            <div class="col-md-3">
                                <div class="text-right">
                                    <label for="membership" data-on-label="Yes" data-off-label="No"></label>
                                    <label class="custom-toggle">
                                        <input type="checkbox" value="1">
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <span class="text-muted form-text">
                            <small>(These settings may be overridden for individual articles.)</small>
                        </span>
                    </div>
                    <div class="form-group mb-5 clearfix">
                        <h6>Other comment settings</h6>
                        <hr>
                        <div class="row">
                            <div class="col-md-9">
                                <label>Comment author must fill out name and email</label>
                            </div>
                            <div class="col-md-3">
                                <div class="text-right">
                                    <label for="membership" data-on-label="Yes" data-off-label="No"></label>
                                    <label class="custom-toggle">
                                        <input type="checkbox" value="1">
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <label>Users must be registered and logged in to comment</label>
                            </div>
                            <div class="col-md-3">
                                <div class="text-right">
                                    <label for="membership" data-on-label="Yes" data-off-label="No"></label>
                                    <label class="custom-toggle">
                                        <input type="checkbox" value="1">
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <label>Automatically close comments on articles older than</label>
                            </div>
                            <div class="col-md-3">
                                <div class="text-right">
                                    <label for="membership" data-on-label="Yes" data-off-label="No"></label>
                                    <label class="custom-toggle">
                                        <input type="checkbox" value="1">
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <label>Show comments cookies opt-in checkbox.</label>
                            </div>
                            <div class="col-md-3">
                                <div class="text-right">
                                    <label for="membership" data-on-label="Yes" data-off-label="No"></label>
                                    <label class="custom-toggle">
                                        <input type="checkbox" value="1">
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-5 clearfix">
                        <h6>Email me whenever</h6>
                        <hr>
                        <div class="row">
                            <div class="col-md-9">
                                <label>Anyone posts a comment </label>
                            </div>
                            <div class="col-md-3">
                                <div class="text-right">
                                    <label for="membership" data-on-label="Yes" data-off-label="No"></label>
                                    <label class="custom-toggle">
                                        <input type="checkbox" value="1">
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <label>A comment is held for moderation </label>
                            </div>
                            <div class="col-md-3">
                                <div class="text-right">
                                    <label for="membership" data-on-label="Yes" data-off-label="No"></label>
                                    <label class="custom-toggle">
                                        <input type="checkbox" value="1">
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-5 clearfix">
                        <h6>Before a comment appears</h6>
                        <hr>
                        <div class="row">
                            <div class="col-md-9">
                                <label>Comment must be manually approved </label>
                            </div>
                            <div class="col-md-3">
                                <div class="text-right">
                                    <label for="membership" data-on-label="Yes" data-off-label="No"></label>
                                    <label class="custom-toggle">
                                        <input type="checkbox" value="1">
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <label>Comment author must have a previously approved comment</label>
                            </div>
                            <div class="col-md-3">
                                <div class="text-right">
                                    <label for="membership" data-on-label="Yes" data-off-label="No"></label>
                                    <label class="custom-toggle">
                                        <input type="checkbox" value="1">
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div>Total comments count</div>
                <span class="text-muted">
                    <small>
                        Blog post commenting enabled
                    </small>
                </span>
                <h1>21</h1>
            </div>
        </div>
    </div>
</div>
@endsection
