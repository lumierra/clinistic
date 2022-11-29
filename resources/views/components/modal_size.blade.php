{{-- <div id="modalForm" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true"> --}}
<div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modalForm" aria-hidden="true">
    <div class="modal-dialog {{ $size }}">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="headerModal">Medium model</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="formValidate0" id="formInput">
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="product_id">
                    {{ $slot }}
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="saveBtn" class="btn btn-primary btn-sm" data-dismiss="modal">Simpan</button>
            </div>
        </div>
    </div>
</div>
