<!-- Modal -->
<div class="modal fade" id="siswa-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="siswa_id">

                <div class="form-group">
                    <label for="name" class="control-label">NIS</label>
                    <input type="text" class="form-control" id="edit_nis" placeholder="NIS">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nis-edit"></div>
                </div>
                
                <div class="form-group">
                    <label for="name" class="control-label">Tahun Masuk TK</label>
                    <input type="text" class="form-control" id="edit_tahun_masuk_tk" placeholder="Tahun Masuk TK">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tahun-masuk-tk-edit"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">Tahun Masuk SD</label>
                    <input type="text" class="form-control" id="edit_tahun_masuk_sd" placeholder="Tahun Masuk SD">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tahun-masuk-sd-edit"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">Tahun Masuk SMP</label>
                    <input type="text" class="form-control" id="edit_tahun_masuk_smp" placeholder="Tahun Masuk SMP">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tahun-masuk-smp-edit"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
                <button type="button" class="btn btn-primary" id="update-siswa">UPDATE</button>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // Button untuk membuka modal update siswa
    $('body').on('click', '#btn-edit-siswa', function () {
        let siswaId = $(this).data('id');

        // Mengambil data siswa dari server
        $.ajax({
            url: `http://127.0.0.1:8000/students/${siswaId}`,
            type: "GET",
            success:function(response){
                // Mengisi form modal dengan data siswa yang diambil
                $('#edit_nis').val(response.data.nis);
                $('#edit_tahun_masuk_tk').val(response.data.tahun_masuk_tk);
                $('#edit_tahun_masuk_sd').val(response.data.tahun_masuk_sd);
                $('#edit_tahun_masuk_smp').val(response.data.tahun_masuk_smp);

                // Membuka modal update siswa
                $('#siswa-edit').modal('show');
            },
            error:function(error){
                console.error(error);
            }
        });
    });

    // Action update siswa
    $('#update-siswa').click(function(e) {
        e.preventDefault();

        // Mengambil nilai dari form modal
        let nis   = $('#edit_nis').val();
        let tahunMasukTK = $('#edit_tahun_masuk_tk').val();
        let tahunMasukSD = $('#edit_tahun_masuk_sd').val();
        let tahunMasukSMP = $('#edit_tahun_masuk_smp').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        let siswaId = $(this).data('id');

        // Ajax request untuk meng-update siswa
        $.ajax({
            url: `/siswas/${siswaId}`,
            type: "PUT",
            cache: false,
            data: {
                "nis": nis,
                "tahun_masuk_tk": tahunMasukTK,
                "tahun_masuk_sd": tahunMasukSD,
                "tahun_masuk_smp": tahunMasukSMP,
                "_token": token
            },
            success:function(response){
                // Menampilkan pesan sukses
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                // Meng-update data siswa pada tabel
                $(`#index_${siswaId} td:nth-child(1)`).html(response.data.nis);
                $(`#index_${siswaId} td:nth-child(2)`).html(response.data.tahun_masuk_tk);
                $(`#index_${siswaId} td:nth-child(3)`).html(response.data.tahun_masuk_sd);
                $(`#index_${siswaId} td:nth-child(4)`).html(response.data.tahun_masuk_smp);

                // Menutup modal update siswa
                $('#modal-edit-siswa').modal('hide');
            },
            error:function(error){
                console.error(error);
                // Menampilkan pesan error jika ada
                Swal.fire({
                    type: 'error',
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            }
        });

    });

</script>
