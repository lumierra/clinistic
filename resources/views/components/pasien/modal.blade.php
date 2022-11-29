<div class="modal fade" id="modalPasien" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modalForm" aria-hidden="true">
    <div class="modal-dialog {{ $size }}">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="headerModalPasien">Medium model</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="formValidate0" id="formInputPasien">
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="product_idPasien" value="0">
                    {{ $slot }}
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="saveBtnPasien" class="btn btn-primary btn-sm" data-dismiss="modal">Simpan</button>
            </div>
        </div>
    </div>
</div>
