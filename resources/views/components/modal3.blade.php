<div id="modalForm3" class="modal fade" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="headerModal3">Medium model</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="formValidate0" id="formInput3">
                <div class="modal-body" id="modalBody">
                    <input type="hidden" name="product_id" id="product_id3">
                    {{ $slot }}
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
