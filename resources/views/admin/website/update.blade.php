<form class="contact-form" action="{{ route('admin.website.update',$data->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="text-start mb-30">
        <h2>Profil Website</h2>
    </div>
    <div class="row">
        <input type="text" class="d-none" id="data_id" name="data_id" value="{{ $data->id ?? '' }}">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Nama Website</label>
                <input value="{{ $data == '' ? '' : $data->nama_website }}" type="text" class="form-control" placeholder="Nama Website" id="nama_website" name="nama_website" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Email</label>
                <input value="{{ $data == '' ? '' : $data->email }}" type="email" class="form-control" placeholder="Email" id="email" name="email" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Telephone</label>
                <input value="{{ $data == '' ? '' : $data->phone }}" type="text" class="form-control" placeholder="Telephone" id="phone" name="phone" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Footer</label>
                <input value="{{ $data == '' ? '' : $data->footer }}" type="text" class="form-control" placeholder="Footer" id="footer" name="footer" autocomplete="off">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $data == '' ? '' : $data->alamat }}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Facebook</label>
                <input type="text" class="form-control" placeholder="Facebook" id="facebook" name="facebook" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Instagram</label>
                <input type="text" class="form-control" placeholder="Instagram" id="instagram" name="instagram" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Youtube</label>
                <input type="text" class="form-control" placeholder="Youtube" id="youtube" name="youtube" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label">Logo</label>
                <input type="file" class="form-control" id="logo" name="logo" accept="image/png, image/jpg, image/jpeg">
            </div>
        </div>
        <div class="col-lg-12 mt-15">
            <button name="submit" type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>
