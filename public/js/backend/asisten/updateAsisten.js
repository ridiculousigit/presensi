$(function () {
  // Menggunakan event handler untuk form submit
  $("#form-data-asisten-edit").on("submit", function (e) {
    e.preventDefault(); // Mencegah pengiriman form secara default

    // Mendapatkan route dari atribut data pada form
    var route = $("#form-data-asisten-edit").data("route");
    var form_data_metaheader = $(this);

    // Mengambil nilai input dari form
    var id = $("input[name=id]").val();
    var id_asisten = $("input[name=id_asistenU]").val();
    var name = $("input[name=nameU]").val();
    var join_date = $("input[name=join_dateU]").val();
    var role = $("select[name=roleU]").val();
    var role2 = $("input[name=roleU2").val();
    var photo = $("input[name=photoU]")[0].files[0];
    var email = $("input[name=emailU]").val();
    var password1 = $("input[name=password1U]").val();
    var password2 = $("input[name=password2U]").val();

    // Membuat objek FormData untuk mengirim data dengan metode POST
    var formData = new FormData();
    formData.append("id", id);
    formData.append("id_asisten", id_asisten);
    formData.append("name", name);
    formData.append("join_date", join_date);
    formData.append("role", role);
    formData.append("role2", role2);
    formData.append("photo", photo);
    formData.append("email", email);
    formData.append("password1", password1);
    formData.append("password2", password2);

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
        console.log(res.data);
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
            title: "Gagal",
            text: "Data tidak dapat diperbarui",
            icon: "error",
            confirmButtonColor: "#e74c3c",
            confirmButtonText: "Oke",
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          });
        } else {
          // Menampilkan pesan jika kata sandi tidak sama
          Swal.fire({
            title: "Gagal",
            text: "Kata sandi tidak sama!",
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
