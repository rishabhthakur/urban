@extends('layouts.admin.app')

@section('content')
    <div class="row mb-5">
        <div class="col-lg-6">
            <h1 class="display-1">
                Welcome to your<br />
                Dashboard, {{ Auth::user()->name }}!
            </h1>
            <p class="lead">
                The public website appears to be running normally and is now <span class="badge badge-success"><strong>LIVE</strong></span> at this moment.
            </p>
            <p>
                We recomend that you keep the website status live unless drastic changes, database upgrades and major upgrades have been scheduled. In that case you should head over to the <a href="{!! route('admin.settings') !!}">settings page</a> and switch the <strong>site status</strong> option to off. This will activate <code>Code 503 - Site under maintenance</code> or <strong>maintenance mode</strong>.
            </p>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <h1 class="display-1">123</h1>
                        <h6 class="badge badge-primary">Customers</h6>
                        <p>
                            <span class="text-success">98</span> verified out of <span class="text-dark">123</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <h1 class="display-1">257</h1>
                        <h6 class="badge badge-primary">Orders</h6>
                        <p>
                            Cum sociis natoque penatibus et magnis dis parturient.
                        </p>
                        <p>
                            <span class="badge badge-warning"><strong>57</strong> Pending</span>
                            <span class="badge badge-success"><strong>190</strong> Processed</span>
                            <span class="badge badge-danger"><strong>10</strong> Cancelled</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <h1 class="display-1">403</h1>
                        <h6 class="badge badge-primary">Products</h6>
                        <p>
                            Cum sociis natoque penatibus et magnis dis parturient.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <h1 class="display-1 text-success">$2000.00</h1>
                        <h6 class="badge badge-primary">Revenue</h6>
                        <p>
                            Cum sociis natoque penatibus et magnis dis parturient.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h4>Recent Activity</h4>
			<ul class="timeline">
				<li>
					<a target="_blank" href="https://www.totoprayogo.com/#">New Web Design</a>
					<a href="#" class="float-right">21 March, 2014</a>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>
				</li>
				<li>
					<a href="#">21 000 Job Seekers</a>
					<a href="#" class="float-right">4 March, 2014</a>
					<p>Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...</p>
				</li>
				<li>
					<a href="#">Awesome Employers</a>
					<a href="#" class="float-right">1 April, 2014</a>
					<p>Fusce ullamcorper ligula sit amet quam accumsan aliquet. Sed nulla odio, tincidunt vitae nunc vitae, mollis pharetra velit. Sed nec tempor nibh...</p>
				</li>
			</ul>
        </div>
    </div>
@endsection
