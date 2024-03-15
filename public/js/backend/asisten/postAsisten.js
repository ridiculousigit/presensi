$(function () {
  // Menggunakan event handler untuk form submit
  $("#form-data-asisten").on("submit", function (e) {
    e.preventDefault(); // Mencegah pengiriman form secara default

    // Mendapatkan route dari atribut data pada form
    var route = $("#form-data-asisten").data("route");
    var form_data_metaheader = $(this);

    // Mengambil nilai input dari form
    var id_asisten = $("input[name=id_asisten]").val();
    var name = $("input[name=name]").val();
    var join_date = $("input[name=join_date]").val();
    var role = $("select[name=role]").val();
    var photo = $("input[name=photo]")[0].files[0];
    var email = $("input[name=email]").val();
    var password1 = $("input[name=password1]").val();
    var password2 = $("input[name=password2]").val();

    // Membuat objek FormData untuk mengirim data dengan metode POST
    var formData = new FormData();
    formData.append("id_asisten", id_asisten);
    formData.append("name", name);
    formData.append("join_date", join_date);
    formData.append("role", role);
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
            text: "Data tidak dapat disimnpan",
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
