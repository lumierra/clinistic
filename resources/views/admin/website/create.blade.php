<form class="contact-form" id="formInput">

    <div class="text-start mb-30">
        <h2>Profil Website <i class="fad fa-id-card"></i></h2>
    </div>
    <div class="row">
        <input type="text" class="d-none" id="data_id" name="data_id" value="{{ $data->id ?? '' }}">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Nama Website</label>
                <input value="{{ $data->nama_website ?? '' }}" type="text" class="form-control" placeholder="Nama Website" id="nama_website" name="nama_website" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Nama Singkat</label>
                <input value="{{ $data->nama_singkat ?? '' }}" type="text" class="form-control" placeholder="ex : Diskominfo" id="nama_singkat" name="nama_singkat" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Email</label>
                <input value="{{ $data->email ?? '' }}" type="email" class="form-control" placeholder="Email" id="email" name="email" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Telephone</label>
                <input value="{{ $data->phone ?? '' }}" type="text" class="form-control" placeholder="Telephone" id="phone" name="phone" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $data->alamat ?? '' }}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Footer</label>
                <input value="{{ $data->footer ?? '' }}" type="text" class="form-control" placeholder="Footer" id="footer" name="footer" autocomplete="off">
            </div>
        </div>
        {{-- <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Facebook</label>
                <input value="{{ $data->facebook ?? '' }}" type="text" class="form-control" placeholder="Facebook" id="facebook" name="facebook" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Instagram</label>
                <input value="{{ $data->instagram ?? '' }}" type="text" class="form-control" placeholder="Instagram" id="instagram" name="instagram" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Youtube</label>
                <input value="{{ $data->youtube ?? '' }}" type="text" class="form-control" placeholder="Youtube" id="youtube" name="youtube" autocomplete="off">
            </div>
        </div> --}}

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label">Lokasi G.Maps</label>
                <input value="{{ $data->lokasi ?? '' }}" type="text" class="form-control" placeholder="Lokasi" id="lokasi" name="lokasi" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Logo 1</label>
                <input type="file" class="form-control" id="photo" name="photo" accept="image/png, image/jpg, image/jpeg">
            </div>
        </div>
        <div class="col-md-6" id="logoWebsite">
            @if ($data->logo != '')
                <img src="{{ asset($data->logo) }}" style="width: 50%" alt="{{ $data->nama_website }}" class="img-fluid1 img-thumbnail1 round">
            @endif
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Logo 2</label>
                <input type="file" class="form-control" id="photo2" name="photo2" accept="image/png, image/jpg, image/jpeg">
            </div>
        </div>
        <div class="col-md-6" id="logoWebsite">
            @if ($data->logo2 != '')
                <img src="{{ asset($data->logo2) }}" style="width: 50%" alt="{{ $data->nama_website }}" class="img-fluid1 img-thumbnail1 round">
            @endif
        </div>
        <div class="col-lg-12 mt-15">
            <button id="btnSave" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>
