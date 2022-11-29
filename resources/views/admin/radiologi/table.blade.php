<h4 class="box-title text-info mb-0"><i class="fal fa-file-medical"></i><i class="fal fa-x-ray"></i> Input Hasil Radiologi</h4>
<hr class="my-15">
@foreach ($data->radiologis as $item)
    <div class="mb-3">
        <label for="rad{{ $item->id }}" class="form-label">Upload Hasil (Gambar)</label>
        <input {{ $item->status == 'belum' ? 'disabled' : '' }} {{ $item->status == 'selesai' ? 'disabled' : '' }} class="form-control" type="file" id="rad{{ $item->id }}" name="rad{{ $item->id }}">
    </div>
    <div class="form-group">
        <label class="form-label">{{ $item->produk->nama }}</label>
        <textarea {{ $item->status == 'belum' ? 'disabled' : '' }} {{ $item->status == 'selesai' ? 'disabled' : '' }} rows="5" id="radhasil{{ $item->id }}" name="radhasil{{ $item->id }}" data-id="{{ $item->id }}" class="form-control" placeholder="Input Hasil {{ $item->produk->nama }}">{{ $item->hasil->hasil ?? '' }}</textarea>
    </div>
@endforeach
