@php
    $color = ['success','danger','warning','info','dark', 'success', 'danger', 'warning', 'info', 'dark'];
@endphp
@foreach ($poli as $key => $item)
    <div class="col-3">
        <div class="box box-solid bg-{{ $color[$key] }} bb-3 border-{{ $color[$key] }}" style="border-radius:10px">
            <div class="box-header bg-{{ $color[$key] }} text-center">
                <span class="text-muted me-1 fw-bold text-white fs-20">{{ $item->nama }}</span>
            </div>
            <div class="box-body">
                <div class="text-center">
                <div class="fs-60 text-{{ $color[$key] }}">{{ $item->getNomorAntrian() }}</div>
                </div>
            </div>
        </div>
    </div>
@endforeach
