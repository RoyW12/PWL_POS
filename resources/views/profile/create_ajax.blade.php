<form id="formProfile" enctype="multipart/form-data">
    @csrf

    <div class="modal-header">
        <h5 class="modal-title">Edit Profil</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body">
        <div id="alert-area"></div>

        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" value="{{ $user->nama }}" required disabled>
        </div>

        <div class="form-group">
            <label for="photo_profile">Foto Profil</label><br>
            @if ($user->photo_profile)
                <img src="{{ asset('storage/photo/' . $user->photo_profile) }}" alt="Foto" width="100"
                    class="mb-2"><br>
            @endif
            <input type="file" name="photo_profile" class="form-control-file">
            <small class="form-text text-muted">Format jpg, jpeg, png. Maks 2MB.</small>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    $('#formProfile').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('profile.update.ajax') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#modalEditProfile').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                let message = xhr.responseJSON?.message ?? 'Gagal menyimpan perubahan.';
                $('#alert-area').html(`<div class="alert alert-danger">${message}</div>`);
            }
        });
    });
</script>
