@foreach ($data as $item)
    <div class="col-md-12 col-lg-3">
        <div class="box">
            <div class="fx-card-item">
                <div class="fx-card-avatar fx-overlay-1">
                    <img src="{{ asset($item->photo) }}" alt="{{ $item->nama }}">
                    <div class="fx-overlay scrl-dwn">
                        <ul class="fx-info">
                            <li><a class="btn default btn-outline image-popup-vertical-fit" href="{{ asset($item->photo) }}"><i class="ion-search"></i></a></li>
                            <li><a class="btn default btn-outline" href="javascript:void(0);" id="deleteEstetika" data-id="{{ $item->id }}"><i class="fas fa-trash"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="fx-card-content">
                    <small>Hasil {{ $loop->iteration }}</small>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script src="{{ asset('template/assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('template/assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }}"></script>
