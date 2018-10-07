@extends('auth.account.includes.layout', ['title' => 'Addresses'])

@section('section')
    <div class="mb-4">
        <h5>Billing Address</h5>
        <hr>
        <form class="billing-address-form mb-5" action="index.html" method="post">
            <div class="form-group row">
                <div class="col-md-6 mb-2">
                    <label for="address1">Address 1</label>
                    <input type="text" class="form-control" name="address1" id="address1" value="{{ $bill->address1 }}" placeholder="Address">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="address2">Address 2</label>
                    <input type="text" class="form-control" name="address2" id="address2" value="{{ $bill->address2 }}" placeholder="Address">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 mb-2">
                    <label for="town_city">City/Town</label>
                    <input type="text" class="form-control" name="town_city" id="town_city" value="{{ $bill->town_city }}" placeholder="City/Town">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="province_state">Province/State</label>
                    <input type="text" class="form-control" name="province_state" id="province_state" value="{{ $bill->province_state }}" placeholder="Province/State">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 mb-2">
                    <label for="postcode">Postcode</label>
                    <input type="text" class="form-control" name="postcode" id="postcode" value="{{ $bill->postcode }}" placeholder="Postcode">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="country">Country</label>
                    <select class="w-100" id="country" name="country">
                        <option value="usa" selected>United States</option>
                        <option value="uk">United Kingdom</option>
                        <option value="ger">Germany</option>
                        <option value="fra">France</option>
                        <option value="ind">India</option>
                        <option value="aus">Australia</option>
                        <option value="bra">Brazil</option>
                        <option value="cana">Canada</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label for="phone">Phone</label>
                    <input type="number" class="form-control" name="phone" id="phone" value="{{ $bill->phone }}" placeholder="Phone">
                </div>
            </div>

            <div class="form-group my-5">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="ship">
                    <label class="custom-control-label" for="ship"> Use a different shipping address</label>
                </div>
            </div>

            <div class="form-group mt-4 text-right">
                <button type="submit" class="btn btn-dark ml-auto">Save Changes</button>
            </div>
        </form>

        <div id="form_ship">
            <h5>Shipping Address</h5>
            <hr>
            <form class="billing-address-form mb-5" action="index.html" method="post">
                <div class="form-group row">
                    <div class="col-md-6 mb-2">
                        <label for="address1">Address 1</label>
                        <input type="text" class="form-control" name="address1" id="address1" value="{{ $ship->address1 }}" placeholder="Address">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="address2">Address 2</label>
                        <input type="text" class="form-control" name="address2" id="address2" value="{{ $ship->address2 }}" placeholder="Address">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 mb-2">
                        <label for="town_city">City/Town</label>
                        <input type="text" class="form-control" name="town_city" id="town_city" value="{{ $ship->town_city }}" placeholder="City/Town">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="province_state">Province/State</label>
                        <input type="text" class="form-control" name="province_state" id="province_state" value="{{ $ship->province_state }}" placeholder="Province/State">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 mb-2">
                        <label for="postcode">Postcode</label>
                        <input type="text" class="form-control" name="postcode" id="postcode" value="{{ $ship->postcode }}" placeholder="Postcode">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="country">Country</label>
                        <select class="w-100" id="country" name="country">
                            <option value="usa" selected>United States</option>
                            <option value="uk">United Kingdom</option>
                            <option value="ger">Germany</option>
                            <option value="fra">France</option>
                            <option value="ind">India</option>
                            <option value="aus">Australia</option>
                            <option value="bra">Brazil</option>
                            <option value="cana">Canada</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="phone">Phone</label>
                        <input type="number" class="form-control" name="phone" id="phone" value="{{ $ship->phone }}" placeholder="Phone">
                    </div>
                </div>

                <div class="form-group mt-4 text-right">
                    <button type="submit" class="btn btn-dark">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('address-js')
    <script type="text/javascript">
        $(function () {
            if ($("#ship").is(":checked")) {
                $("#form_ship").show();
            } else {
                $("#form_ship").hide();
            }
            $("#ship").click(function () {
                if ($(this).is(":checked")) {
                    $("#form_ship").slideDown();
                } else {
                    $("#form_ship").slideUp();
                }
            });
        });
    </script>
@endsection
