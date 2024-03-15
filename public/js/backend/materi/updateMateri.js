// Event handler untuk form submit pada halaman edit materi
$(function () {
  $("#form-data-materi-edit").on("submit", function (e) {
    e.preventDefault(); // Mencegah pengiriman form secara default
    var route = $("#form-data-materi-edit").data("route"); // Mendapatkan route dari atribut data pada form
    var form_data_metaheader = $(this); // Mendapatkan form data
    var id = $("input[name=id]").val(); // Mengambil nilai input id dari form
    var materi = $("input[name=materiU]").val(); // Mengambil nilai input materi dari form
    var formData = new FormData(); // Membuat objek FormData untuk mengirim data dengan metode POST
    formData.append("materi", materi); // Menambahkan nilai materi ke objek FormData
    formData.append("id", id); // Menambahkan nilai id ke objek FormData
    axios
      .post(route, formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      })
      .then((res) => {
        // Mengirim data ke server menggunakan Axios
        var Response = res.data; // Mendapatkan respon dari server
        console.log(Response["success"]); // Log pesan sukses ke konsol
        // Menampilkan pesan sukses jika operasi berhasil
        if (Response["success"]) {
          Swal.fire({
            title: "Berhasil",
            text: "Data telah berhasil diperbarui",
            icon: "success",
            confirmButtonColor: "#27ae60",
            confirmButtonText: "Oke",
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload(); // Muat ulang halaman setelah menutup pesan
            }
          });
          // Menampilkan pesan error jika terjadi kesalahan
        } else if (Response["error"]) {
          Swal.fire({
            title: "Gagal",
            text: "Data tidak dapat diperbarui",
            icon: "error",
            confirmButtonColor: "#e74c3c",
            confirmButtonText: "Oke",
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload(); // Muat ulang halaman setelah menutup pesan
            }
          });
          // Menampilkan pesan jika berhasil dihapus
        } else if (Response["delete"]) {
          Swal.fire({
            title: "Berhasil",
            text: "Data berhasil dihapus",
            icon: "success",
            confirmButtonColor: "#27ae60",
            confirmButtonText: "Oke",
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload(); // Muat ulang halaman setelah menutup pesan
            }
          });
        }
      })
      .catch((err) => {}); // Tangkap dan tangani kesalahan jika terjadi
  });
});
