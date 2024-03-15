$(function () {
  // Menggunakan event handler untuk form submit
  $("#form-absen").on("submit", function (e) {
    e.preventDefault(); // Mencegah pengiriman form secara default

    // Mendapatkan route dari atribut data pada form
    var route = $("#form-absen").data("route");
    var form_data_metaheader = $(this);

    // Mengambil nilai input dari form
    var id_asisten = $("input[name=id_asisten]").val();
    var kelas = $("select[name=kelas]").val();
    var materi = $("select[name=materi]").val();
    var peran_jaga = $("select[name=peran_jaga]").val();
    var kode = $("input[name=kode]").val();

    // Membuat objek FormData untuk mengirim data dengan metode POST
    var formData = new FormData();
    formData.append("id_asisten", id_asisten);
    formData.append("kelas", kelas);
    formData.append("materi", materi);
    formData.append("peran_jaga", peran_jaga);
    formData.append("kode", kode);

    // Mengirim data ke server menggunakan Axios
    axios
      .post(route, formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      })
      .then((res) => {
        // Mendapatkan respon dari server
        var Response = res.data;
        console.log(Response["success"]); // Log pesan sukses ke konsol

        // Menampilkan pesan sukses jika operasi berhasil
        if (Response["success"]) {
          Swal.fire({
            title: "Berhasil",
            text: "Absen masuk berhasil. Jangan lupa absen keluar setelah mengajar.",
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Oke",
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          });
        } else if (Response["error"]) {
          // Menampilkan pesan error jika terjadi kesalahan
          Swal.fire({
            title: "Gagal",
            text: "Kode absen tidak valid. Mohon minta kode baru",
            icon: "error",
            confirmButtonColor: "#e74c3c",
            confirmButtonText: "Oke",
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          });
        } else {
          // Menampilkan pesan jika terjadi kesalahan yang tidak diketahui
          Swal.fire({
            title: "Gagal",
            text: "Terjadi kesalahan tidak diketahui. Absen tidak berhasil.",
            icon: "error",
            confirmButtonColor: "#e74c3c",
            confirmButtonText: "Oke",
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          });
        }
      })
      .catch((err) => {});
  });
});
