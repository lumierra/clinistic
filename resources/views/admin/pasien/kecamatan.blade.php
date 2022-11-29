@foreach ($kecamatan as $item)
    <option value="{{ $item->id }}" {{ $item->id == $kec ? 'selected' : '' }}>{{ $item->nama_kecamatan }}</option>
@endforeach

<script>
    // $('#kecamatan').val('{{ $kec }}').trigger('change');
</script>
