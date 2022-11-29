<h4 class="box-title text-info mb-0"><i class="fal fa-file-medical"></i><i class="fal fa-flask"></i> Input Hasil Lab</h4>
<hr class="my-15">
@foreach ($data->labs as $item)
    <div class="form-group">
        <label class="form-label">{{ $item->produk->nama }}</label>
        <textarea {{ $item->status == 'belum' ? 'disabled' : '' }} rows="5" id="lab{{ $item->id }}" name="lab{{ $item->id }}" data-id="{{ $item->id }}" class="form-control" placeholder="Input Hasil {{ $item->produk->nama }}">{{ $item->hasil->hasil ?? '' }}</textarea>
    </div>
@endforeach
