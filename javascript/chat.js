// Interval untuk memperbarui daftar pengguna
setInterval(() => {
    if (!isSearching) { // Hanya perbarui jika pencarian tidak aktif
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "../php/get-chat.php", true);
      xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          let data = xhr.response;
          usersList.innerHTML = data; // Update daftar pengguna
        }
      };
      xhr.send();
    }
  }, 500); // Interval tetap 500 ms
  
