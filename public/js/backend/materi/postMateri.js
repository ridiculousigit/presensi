$(function () {
  // Menggunakan event handler untuk form submit
  $("#form-data-materi").on("submit", function (e) {
    e.preventDefault(); // Mencegah pengiriman form secara default

    // Mendapatkan route dari atribut data pada form
    var route = $("#form-data-materi").data("route");
    var form_data_metaheader = $(this);

    // Mengambil nilai input materi dari form
    var materi = $("input[name=materi]").val();

    // Membuat objek FormData untuk mengirim data dengan metode POST
    var formData = new FormData();
    formData.append("materi", materi);

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
        // Menampilkan pesan error jika terjadi kesalahan
        } else if (Response["error"]) {
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
