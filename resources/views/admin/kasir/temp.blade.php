<script>
    // let bayar = $('#bayar').val()
                // if (bayar == ''){
                //     swal({
                //         title: "Gagal!",
                //         text: "Uang Anda Kurang",
                //         timer: 1500,
                //         showConfirmButton: false,
                //         type: 'error',
                //     });
                //     $('#bayar').focus();
                // } else {
                //     let total = $('#totalHarga').val()
                //     bayar = bayar.replace(".", '')
                //     bayar = parseInt(bayar);
                //     total = parseInt(total);

                //     if (bayar < total){
                //         swal({
                //             title: "Gagal!",
                //             text: "Uang Anda Kurang",
                //             timer: 1500,
                //             showConfirmButton: false,
                //             type: 'error',
                //         });
                //     } else {
                //         $.ajax({
                //             data: $('#formInput').serialize(),
                //             url: "{{ route('admin.kasir.store') }}",
                //             type: "POST",
                //             dataType: 'json',
                //             success: function (data) {
                //                 alertBayar()
                //                 let bayar2 = $('#bayar').val()
                //                 let total2 = $('#totalHarga').val()
                //                 bayar2 = bayar2.replace(".", '')
                //                 bayar2 = parseInt(bayar2);
                //                 total2 = parseInt(total2);
                //                 let kembalian = bayar2 - total2;
                //                 kembalian = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(kembalian)
                //                 // swal("Kembalian : " + kembalian, 'Uang Kembalian', "success");
                //                 swal({
                //                     title: "Kembalian : " + kembalian,
                //                     text: "Uang Kembalian",
                //                     timer: 3000,
                //                     showConfirmButton: false,
                //                     type: 'success',
                //                 });
                //                 $('.dataServer').DataTable().ajax.reload();
                //                 $('.dataHistory').DataTable().ajax.reload();
                //                 $('#barang').empty();
                //                 $('#barang').val(null).trigger('change');
                //                 $('#toko').val(null).trigger('change');
                //                 $('#toko').select2('open');
                //                 $.ajax({
                //                     url: "{{ route('admin.kasir.create') }}",
                //                     type: "GET",
                //                     dataType: 'html',
                //                     success: function (data) {
                //                         $('#dataTotal').html(data)
                //                     },
                //                     error: function (data) {
                //                         console.log('error');
                //                     }
                //                 });
                //             },
                //             error: function (data) {
                //                 alertDanger()
                //             }
                //         });
                //     }
                // }
</script>
