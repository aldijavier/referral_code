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
        <form action="/referralagent/{{$suratkeluar->id}}/update" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Edit Referral Code</h3>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-6">
                    <label for="nomorsurat">Referral For</label>
                    <select readonly name="referral_for" value="" id="referral_for" data-live-search=true class="form-control selectpicker show-tick show-menu-arrow">
                        @if($suratkeluar->referral_for == 2)
                        <option value="{{$suratkeluar->referral_for}}" selected>Agent Code Internal</option>
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
                    <label for="tglcatat" style="margin-top:10px;">Start Date</label>
                    <input value="{{$suratkeluar->start_date}}" name="start_date" type="date" class="form-control bg-light"
                        id="tglcatat" required>
                    <label for="isisurat" style="margin-top:10px;">Description</label>
                    <textarea name="description" class="form-control bg-light" id="description" rows="3"
                        placeholder="Fill description" required>{{$suratkeluar->description}}</textarea>
                </div>
                <div class="col-6">
                    <div id="referralfree">
                        <label for="tglsurat">Referral Code</label>
                        <input value="{{$suratkeluar->referral_code}}" name="referral_code" type="text" class="form-control bg-light"
                            id="referral_code" placeholder="Referral Code">
                        </div>
                        <label for="tglcatat" style="margin-top:10px;">End Date</label>
                    <input value="{{$suratkeluar->end_date}}" name="end_date" type="date" class="form-control bg-light"
                        id="tglcatat" required>
                        <label for="status" style="margin-top:10px;">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value=1>Active</option>
                        <option value=2>Non Active</option>
                    </select>
                    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
            <a class="btn btn-danger btn-sm" href="/suratkeluar/index" role="button"><i class="fas fa-undo"></i>
                BATAL</a>
        </form>
    </div>
</section>
@endsection
