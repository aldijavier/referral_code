@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="/referral/tambah" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Generate Referral Code</h3>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-6">
                    <label for="nomorsurat">Referal For</label>
                    <select name="referral_for" id="referral_for" data-live-search=true class="form-control selectpicker show-tick show-menu-arrow">
                        <option value="">- Select Referral for -</option>
                        <option value=1
                            {{ old('referral_for') == 1 ? 'selected' : '' }}>
                            Promo Code</option>
                        <option value=2
                            {{ old('referral_for') == 2 ? 'selected' : '' }}>Agent Code Internal</option>
                        <option value=3
                            {{ old('referral_for') == 3 ? 'selected' : '' }}>Agent Code External</option>
                    </select>
                    <div id="regenciesz">
                        <label for="regencies" style="margin-top:10px;">Regencies</label>
                        <select class="form-control" name="regencies" id="regencies"
                            data-dependent="lantai">
                            <option value="0" selected="true"> Select Regencies </option>
                        </select>
                    </div>
                    <label for="asalsurat" style="margin-top:10px;">Start Date</label>
                    <input value="{{old('start_date')}}" name="start_date" type="date" class="form-control bg-light"
                    id="tglmulai" required>
                    <label for="status" style="margin-top:10px;">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value=1>Active</option>
                        <option value=2>Non Active</option>
                    </select>
                    
                    {{-- <select name="kode" class="custom-select my-1 mr-sm-2 bg-light" id="inlineFormCustomSelectPref"
                        required>
                        <option value="">-- Pilih Klasifikasi Surat --</option>
                        @foreach($data_klasifikasi as $klasifikasi)
                        <option value="{{$klasifikasi->kode}}">{{$klasifikasi->nama}} ( {{$klasifikasi->kode}} )
                        </option>
                        @endforeach
                    </select> --}}
                </div>
                <div class="col-6">
                    <div id="referralfree">
                    <label for="tglsurat">Referral Code</label>
                    <input value="{{old('referral_code')}}" name="referral_code" type="text" class="form-control bg-light"
                        id="referral_code" placeholder="Referral Code">
                    </div>
                    <div id="provincez">
                        <label for="province1">Province</label>
                       <select name="province" id="province" class="custom-select  mr-sm-2 bg-light" id="inlineFormCustomSelectPref"
                            >
                            <option value="">Select Province</option>
                            @foreach($data_klasifikasi as $klasifikasi)
                            <option value="{{$klasifikasi->id}}">{{$klasifikasi->nama}} ( {{$klasifikasi->nama}} )
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <label for="tglcatat" style="margin-top:10px;">End Date</label>
                    <input value="{{old('end_date')}}" name="end_date" type="date" class="form-control bg-light"
                        id="tglcatat" required>
                        <label for="isisurat" style="margin-top:10px;">Description</label>
                    <textarea name="description" class="form-control bg-light" id="description" rows="3"
                        placeholder="Fill description" required>{{old('isi')}}</textarea>
                    {{-- <label for="keterangan">Keterangan</label>
                    <input value="{{old('keterangan')}}" name="keterangan" type="text" class="form-control bg-light"
                        id="keterangan" placeholder="Keterangan" required> --}}
                    {{-- <div class="custom-file">
                        <label for="exampleFormControlFile1">File</label>
                        <input name="filekeluar" type="file" class="form-control-file" id="validatedCustomFile"
                            required>
                        <small id="validatedCustomFile" class="text-danger">
                            Pastikan file anda ( jpg,jpeg,png,doc,docx,pdf ) !!!
                        </small>
                    </div> --}}
                </div>
                <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#provincez").closest("div").hide();
                        $("#regenciesz").closest("div").hide();
                        $("#referralfree").closest("div").show();
                        // $("#agentext1").closest("div").hide();
                        $("#referral_for").on("change", function(){
                        var v = $(this).val();
                            if(v==1){
                                $("#referralfree").closest("div").show();
                                $("#regenciesz").closest("div").hide();
                                $("#provincez").closest("div").hide();
                            }else if(v==2){
                                $("#referralfree").closest("div").show();
                                $("#regenciesz").closest("div").hide();
                                $("#provincez").closest("div").hide();
                            }else if(v==3){
                                $("#referralfree").closest("div").hide();
                                $("#provincez").closest("div").show();
                                // $("#agentext1").closest("div").show();
                            }
                        });
                    });
                </script>
                <script type="text/javascript">
                    console.log('asd');
                    jQuery(document).ready(function ($) {
                            console.log('das');
                            $("#regenciesz").closest("div").hide();
                            $('#province').on('change', function (e) {
                                $("#regenciesz").closest("div").show();
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
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection
