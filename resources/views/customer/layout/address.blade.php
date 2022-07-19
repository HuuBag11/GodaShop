@if ($qr->ward_id != null)
    @php
        $ward_selected = DB::table('ward')->where('id', $qr->ward_id)->first();
        $district_selected = DB::table('district')->where('id', $ward_selected->district_id)->first();
        $province_selected = DB::table('province')->where('id', $district_selected->province_id)->first();
    @endphp
    <div class="row">
        <div class="form-group col-sm-6">
            <input type="text" value="{{ $qr->name }}" class="form-control" name="fullname"
            placeholder="Họ và tên" required=""
            oninvalid="this.setCustomValidity('Vui lòng nhập tên của bạn')"
            oninput="this.setCustomValidity('')">
        </div>
        <div class="form-group col-sm-6">
            <input type="tel" value="{{ $qr->mobile }}" class="form-control" name="mobile"
            placeholder="Số điện thoại" required="" pattern="[0][0-9]{9,}"
            oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại bắt đầu bằng số 0 và ít nhất 9 con số theo sau')"
            oninput="this.setCustomValidity('')">
        </div>
        {{--<div class="form-group col-sm-4">
            <select name="province" class="form-control province" required=""
            oninvalid="this.setCustomValidity('Vui lòng chọn Tỉnh / thành phố')"
            oninput="this.setCustomValidity('')">
            <option value="">Tỉnh / thành phố</option>
            @php
                $ward_selected = DB::table('ward')->where('id', $qr->ward_id)->first();
                $district_selected = DB::table('district')->where('id', $ward_selected->district_id)->first();
                $province_selected = DB::table('province')->where('id', $district_selected->province_id)->first();
            @endphp
            @foreach ($provinces as $province)
                <option {{ $province_selected->id == $province->id ? 'selected': '' }} value="{{ $province->id }}">{{ $province->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-sm-4">
        <select name="district" class="form-control district" required=""
        oninvalid="this.setCustomValidity('Vui lòng chọn Quận / huyện')"
        oninput="this.setCustomValidity('')">
        <option value="">Quận / huyện</option>
        @foreach ($districts as $district)
            <option {{ $district_selected->id == $district->id ? 'selected': '' }} value="{{ $district->id }}">{{ $district->name }}</option>
        @endforeach
    </select>
    </div>
    <div class="form-group col-sm-4">
        <select name="ward" class="form-control ward" required=""
        oninvalid="this.setCustomValidity('Vui lòng chọn Phường / xã')"
        oninput="this.setCustomValidity('')">
        <option value="">Phường / xã</option>
        @foreach ($wards as $ward)
            <option {{ $ward_selected->id == $ward->id ? 'selected': '' }} value="{{ $ward->id }}">{{ $ward->name }}</option>
        @endforeach
    </select>
    </div> --}}
    <div class="form-group col-sm-12">
        <input type="text" value="{{ $qr->housenumber_street }}" class="form-control" placeholder="Địa chỉ"
        name="address" required=""
        oninvalid="this.setCustomValidity('Vui lòng nhập địa chỉ bao gồm số nhà, tên đường')"
        oninput="this.setCustomValidity('')">
    </div>
    </div>
    @php
        // $shipping_address = $qr->housenumber_street.', '.$ward->name.', '.$district->name.', '.$province->name;
        $shipping_address = $qr->housenumber_street;
    @endphp
    <input hidden type="text" name="shipping-address" checked="" value="{{ $shipping_address }}">
    <input hidden type="text" name="shipping-fee" checked="" value="{{ $province_selected->id }}">
@else
    <div class="row">
        <div class="form-group col-sm-6">
            <input type="text" value="{{ $qr->name }}" class="form-control" name="fullname"
            placeholder="Họ và tên" required=""
            oninvalid="this.setCustomValidity('Vui lòng nhập tên của bạn')"
            oninput="this.setCustomValidity('')">
        </div>
        <div class="form-group col-sm-6">
            <input type="tel" value="{{ $qr->mobile }}" class="form-control" name="mobile"
            placeholder="Số điện thoại" required="" pattern="[0][0-9]{9,}"
            oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại bắt đầu bằng số 0 và ít nhất 9 con số theo sau')"
            oninput="this.setCustomValidity('')">
        </div>
        {{-- <div class="form-group col-sm-4">
            <select name="province" class="form-control province" required=""
            oninvalid="this.setCustomValidity('Vui lòng chọn Tỉnh / thành phố')"
            oninput="this.setCustomValidity('')">
            <option value="">Tỉnh / thành phố</option>
            @foreach ($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->name }}</option>
            @endforeach
            </select>
        </div>
    @if (Request::has('province') != null)
    <div class="form-group col-sm-4">
        <select name="district" class="form-control district" required=""
        oninvalid="this.setCustomValidity('Vui lòng chọn Quận / huyện')"
        oninput="this.setCustomValidity('')">
        <option value="">Quận / huyện</option>
        @foreach ($districts as $district)
            <option value="{{ $district->id }}">{{ $district->name }}</option>
        @endforeach
    </select>
    </div>
    @endif
    
    <div class="form-group col-sm-4">
        <select name="ward" class="form-control ward" required=""
        oninvalid="this.setCustomValidity('Vui lòng chọn Phường / xã')"
        oninput="this.setCustomValidity('')">
        <option value="">Phường / xã</option>
        @foreach ($wards as $ward)
            <option value="{{ $ward->id }}">{{ $ward->name }}</option>
        @endforeach
    </select>
    </div> --}}
    <div class="form-group col-sm-12">
        <input type="text" value="{{ $qr->housenumber_street }}" class="form-control" placeholder="Địa chỉ"
        name="address" required=""
        oninvalid="this.setCustomValidity('Vui lòng nhập địa chỉ bao gồm số nhà, tên đường')"
        oninput="this.setCustomValidity('')">
    </div>
    </div>
    <input hidden type="text" name="shipping-address" checked="" value="{{ $qr->housenumber_street }}">
    <input hidden type="text" name="shipping-fee" checked="" value="02">
@endif
