<form action="{{ url('/kategori/ajax') }}" method="POST" id="form-tambah-kategori">
    @csrf
    <div id="modal-kategori" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Kategori</label>
                    <input type="text" name="kategori_kode" id="kategori_kode" class="form-control" required>
                    <small id="error-kategori_kode" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="kategori_nama" id="kategori_nama" class="form-control" required>
                    <small id="error-kategori_nama" class="text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#form-tambah-kategori").validate({
            rules: {
                kategori_kode: {
                    required: true,
                    minlength: 3,
                    maxlength: 10
                },
                kategori_nama: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#modal-kategori').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataKategori.ajax.reload(); // Refresh DataTable
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
            }
        });
    });
</script>
