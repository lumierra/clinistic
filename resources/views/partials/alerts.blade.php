@if (session('success'))
    <div class="container">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            {{ session('success') }}
          </div>
    </div>
@endif

@if (session('info'))
    <div class="container">
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            <h4><i class="icon fa fa-info"></i> Info!</h4>
            {{ session('info') }}
          </div>
    </div>
@endif

@if (session('warning'))
    <div class="container">
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <h4><i class="icon fa fa-warning"></i> Warning!</h4>
            {{ session('warning') }}
          </div>
    </div>
@endif

@if (session('danger'))
    <div class="container">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
            {{ session('danger') }}
        </div>
    </div>
@endif
