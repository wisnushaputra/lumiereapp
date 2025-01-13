const searchBar = document.querySelector(".chat-container .search-bar input"),
usersList = document.querySelector(".chat-container .chat-list");

let isSearching = false; // Status pencarian

let typingTimer; // Timer untuk debounce
const debounceTime = 300; // Waktu debounce (ms)

searchBar.onkeyup = () => {
  clearTimeout(typingTimer); // Hentikan timer sebelumnya
  typingTimer = setTimeout(() => {
    let searchTerm = searchBar.value.trim();
    if (searchTerm !== "") {
      isSearching = true;
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "../php/search_konsultan.php", true);
      xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          usersList.innerHTML = xhr.response;
        }
      };
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send("searchTerm=" + searchTerm);
    } else {
      isSearching = false;
    }
  }, debounceTime);
};


// Interval untuk memperbarui daftar pengguna
setInterval(() => {
  if (!isSearching) { // Hanya perbarui jika pencarian tidak aktif
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/users_konsultan.php", true);
    
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        let data = xhr.response;
        usersList.innerHTML = data; // Update daftar pengguna
      }
    };
    xhr.send();
  }
}, 500); // Interval tetap 500 ms
