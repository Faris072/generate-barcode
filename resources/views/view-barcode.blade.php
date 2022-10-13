@extends('components.app')

@section('content')
<div class="container my-5 d-flex" style="">
    <div class="card m-auto p-4" style="width:80%;">
        <div class="card-body">
            <div class="form">
                <div class="title">
                    <center><h4>View Tanda Tangan</h4></center>
                </div>
                <br><br>
                <div class="input">
                    <label for="no-surat">Nomor surat</label>
                    <input type="text" disabled class="form-control" id="no-surat" name="no-surat" placeholder="Nomor Surat. Cth: 123/456/abc/789">
                    <br>
                    <label for="nama-ttd">Nama penanda tangan</label>
                    <input type="text" disabled class="form-control" id="nama-ttd" name="nama-ttd" placeholder="Nama penanda tangan. Cth: Muhammad Faris S">
                    <br>
                    <label for="tanggal-ttd">Tanggal tanda tangan</label>
                    <input type="text" disabled class="form-control" id="tanggal-ttd" name="tanggal-ttd" placeholder="Tanggal tanda tangan">
                    <br>
                    <label for="email-no-hp">Email / No HP</label>
                    <input type="text" disabled class="form-control" id="email-no-hp" name="email-no-hp" placeholder="Email / No HP">
                    <br>
                    <label for="perihal">Perihal</label>
                    <input type="text" disabled class="form-control" id="perihal" name="perihal" placeholder="Perihal">
                    <br>
                    <center>
                        <div class="preview-file d-none py-4" style="width:40%;">
                            {{-- <img src="" alt="" style="width:100%;"> --}}
                            <br>
                                <p>
                                    <span>File Name: <span id="file-name"></span></span><br>
                                    <span>File Size: <span id="file-size"></span></span><br>
                                    {{-- <span>File Type: <span id="file-type"></span></span><br> --}}
                                </p>
                        </div>
                        {{-- <label for="upload-file" class="btn btn-warning" style="color:white">Select File</label> --}}
                        <a href="javascript:;" class="btn btn-primary" id="download-file" download>Download File</a>
                    </center>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/view.js')}}"></script>
@endsection
