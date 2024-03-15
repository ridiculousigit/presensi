$(function () {
  // Menangani pengiriman data kelas melalui form
  $("#form-data-kelas-edit").on("submit", function (e) {
    e.preventDefault(); // Mencegah pengiriman form secara default

    // Mendapatkan route dari atribut data pada form
    var route = $("#form-data-kelas-edit").data("route");
    var form_data_metaheader = $(this);

    // Mengambil nilai input dari form
    var id = $("input[name=id]").val();
    var jurusan = $("input[name=jurusanU]").val();
    var fakultas = $("input[name=fakultasU]").val();
    var tingkat = $("input[name=tingkatU]").val();
    var nama_kelas = $("input[name=nama_kelasU]").val();

    // Membuat objek FormData untuk mengirim data dengan metode POST
    var formData = new FormData();
    formData.append("id", id);
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
            text: "Data berhasil diperbarui",
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
            title: "Error",
            text: "Data tidak dapat diperbarui",
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
