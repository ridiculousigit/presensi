$(function () {
  // Menangani pengiriman data kelas melalui form
  $("#form-data-kelas").on("submit", function (e) {
    e.preventDefault(); // Mencegah pengiriman form secara default

    // Mendapatkan route dari atribut data pada form
    var route = $("#form-data-kelas").data("route");
    var form_data_metaheader = $(this);

    // Mengambil nilai input dari form
    var jurusan = $("input[name=jurusan]").val();
    var fakultas = $("input[name=fakultas]").val();
    var tingkat = $("input[name=tingkat]").val();
    var nama_kelas = $("input[name=nama_kelas]").val();

    // Membuat objek FormData untuk mengirim data dengan metode POST
    var formData = new FormData();
    formData.append("jurusan", jurusan);
    formData.append("fakultas", fakultas);
    formData.append("tingkat", tingkat);
    formData.append("nama_kelas", nama_kelas);

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
            text: "Data berhasil disimpan",
            icon: "success",
            confirmButtonColor: "#27ae60",
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
            text: "Data tidak dapat disimpan",
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
