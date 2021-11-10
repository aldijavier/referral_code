@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="/referral/referralext/{{$suratkeluar->id}}/update" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Edit Referral Code</h3>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-6">
                    <label for="nomorsurat">Referral For</label>
                    <select readonly name="referral_for" value="" id="referral_for" data-live-search=true class="form-control selectpicker show-tick show-menu-arrow">
                        @if($suratkeluar->referral_for == 3)
                        <option value="{{$suratkeluar->referral_for}}" selected>Agent Code External</option>
                        <option value=1
                            {{ old('referral_for') == 1 ? 'selected' : '' }}>
                            Promo Code</option>
                        <option value=2
                            {{ old('referral_for') == 2 ? 'selected' : '' }}>Agent Code Internal</option>
                        @else
                        <option value="">Select Referral For</option>
                        <option value=1
                            {{ old('referral_for') == 1 ? 'selected' : '' }}>
                            Promo Code</option>
                        <option value=2
                            {{ old('referral_for') == 2 ? 'selected' : '' }}>Agent Code Internal</option>
                        <option value=3
                            {{ old('referral_for') == 3 ? 'selected' : '' }}>Agent Code External</option>
                            @endif
                    </select>
                    <div id="regenciesz">
                        <label for="regencies" style="margin-top:10px;">Regencies</label>
                        <select class="form-control" value="{{$suratkeluar->regencies}}" name="regencies" id="regencies"
                            data-dependent="lantai">
                            <option value="{{$suratkeluar->regencies}}" selected="true"> {{$suratkeluar->regencies}} </option>
                        </select>
                    </div>
                    <label for="tglcatat" style="margin-top:10px;">End Date</label>
                    <input value="{{$suratkeluar->end_date}}" name="end_date" type="date" class="form-control bg-light"
                        id="tglcatat" required>
                    <label for="isisurat" style="margin-top:10px;">Description</label>
                    <textarea name="description" class="form-control bg-light" id="description" rows="3"
                        placeholder="Fill description" required>{{$suratkeluar->description}}</textarea>
                </div>
                <div class="col-6">
                    <div id="provincez">
                        <label for="province1">Province</label>
                       <select value="{{$suratkeluar->province}}" name="province" id="province" class="custom-select  mr-sm-2 bg-light" id="inlineFormCustomSelectPref"
                            >
                            @foreach($data_klasifikasi as $klasifikasi)
                            {{-- <option value="{{$suratkeluar->province}}">{{$klasifikasi->nama}}</option> --}}
                            <option value="{{$klasifikasi->id}}">{{$klasifikasi->nama}} ( {{$klasifikasi->nama}} )
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <label for="tglcatat" style="margin-top:10px;">Start Date</label>
                    <input value="{{$suratkeluar->start_date}}" name="start_date" type="date" class="form-control bg-light"
                        id="tglcatat" required>
                        <label for="status" style="margin-top:10px;">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value=1>Active</option>
                        <option value=2>Non Active</option>
                    </select>
                    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script type="text/javascript">
                    console.log('asd');
                    jQuery(document).ready(function ($) {
                            console.log('das');
                            // $("#regenciesz").closest("div").hide();
                            $('#province').on('change', function (e) {
                                // $("#regenciesz").closest("div").show();
                                console.log('dss');
                                console.log(e);
                                console.log('2');
                                var id_lokasi = e.target.value;
                                $.get('{{ route('jsonLantai')}}?id=' + id_lokasi, function (data) {
                                    console.log(data);
                                    $('#regencies').empty();
                                    $('#regencies').append(
                                        '<option value="0" selected="true">Select Regencies</option>'
                                    );
        
                                    $.each(data, function (index, lantaiObj) {
                                        console.log(lantaiObj.name);
                                        $('#regencies').append(
                                            '<option value="' +
                                            lantaiObj.name + '">' +
                                            lantaiObj.initials + ' - ' +
                                            lantaiObj.name +
                                            '</option>');
                                    })
                                });
                            });
                        });
                </script>
                    {{-- <div class="form-group">
                        <label for="exampleFormControlFile1">File</label>
                        <input name="filekeluar" type="file" class="form-control-file" id="exampleFormControlFile1"
                            value="{{$suratkeluar->filekeluar}}">
                        <small id="exampleFormControlFile1" class="text-warning">
                            Pastikan file anda ( jpg,jpeg,png,doc,docx,pdf ) !!!
                        </small>
                    </div> --}}
                </div>

            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/referral/referralext/index" role="button"><i class="fas fa-undo"></i>
                BATAL</a>
        </form>
    </div>
</section>
@endsection
