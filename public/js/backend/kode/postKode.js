$(function () {
  // Menggunakan event handler untuk form submit
  $("#form-data-kode").on("submit", function (e) {
    e.preventDefault(); // Mencegah pengiriman form secara default

    // Mendapatkan route dari atribut data pada form
    var route = $("#form-data-kode").data("route");

    // Mengirim permintaan ke server menggunakan Axios
    axios
      .post(route, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      })
      .then((res) => {
        // Mendapatkan respon dari server
        var Response = res.data;
        console.log(Response["kode"]);
        console.log(Response["success"]);

        // Menampilkan pesan sukses jika operasi berhasil
        if (Response["success"]) {
          Swal.fire({
            title: "Berhasil",
            text: "Kode berhasil dibuat: " + Response["kode"],
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
            text: "Gagal membuat kode",
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
