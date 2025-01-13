// Show/hide the note form
function showNoteForm() {
    const form = document.getElementById('note-form');
    form.style.display = form.style.display === 'flex' ? 'none' : 'flex';
}

// Save mood and note to localStorage
function saveMoodAndNote() {
    const selectedMood = document.querySelector('.mood.selected')?.dataset.mood;
    const noteTitle = document.getElementById('title').value;
    const noteContent = document.getElementById('content').value;

    if (!selectedMood) {
        alert('Silakan pilih mood terlebih dahulu!');
        return;
    }

    const today = new Date().toISOString().split('T')[0];
    const moodData = {
        date: today,
        //mood: selectedMood,
        title: noteTitle,
        content: noteContent,
    };

    // Kirim data ke backend
    fetch('../php/save_mood.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(moodData),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.href = 'diary.php';
            } else {
                alert('Gagal menyimpan: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan data.');
        });

    // Reset form
    document.getElementById('title').value = '';
    document.getElementById('content').value = '';
}


// Highlight selected mood
document.querySelectorAll('.mood').forEach(mood => {
    mood.addEventListener('click', () => {
        document.querySelectorAll('.mood').forEach(m => m.classList.remove('selected'));
        mood.classList.add('selected');
    });
});

// Load calendar for monthly overview
function loadMonthlyOverview() {
    const storedData = JSON.parse(localStorage.getItem('moods')) || [];
    const calendar = document.getElementById('calendar');
    const daysInMonth = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();

    calendar.innerHTML = '';
    for (let i = 1; i <= daysInMonth; i++) {
        const date = new Date();
        date.setDate(i);
        const dateString = date.toISOString().split('T')[0];

        const moodData = storedData.find(data => data.date === dateString);
        const dayElement = document.createElement('div');
        dayElement.classList.add('day');
        dayElement.textContent = i;

        if (moodData) {
            dayElement.classList.add('mood');
            dayElement.textContent = moodData.mood;
            dayElement.dataset.date = dateString;
        }

        dayElement.addEventListener('click', () => showNoteModal(dateString, moodData));
        calendar.appendChild(dayElement);
    }
}

// Show modal with mood and notes
function showNoteModal(date, moodData) {
    const modal = document.getElementById('note-modal');
    const modalDate = document.getElementById('modal-date');
    const modalMood = document.getElementById('modal-mood');
    const modalNote = document.getElementById('modal-note');

    modalDate.textContent = `Tanggal: ${date}`;
    if (moodData) {
        modalMood.textContent = `Mood: ${moodData.mood}`;
        modalNote.textContent = moodData.title ? `${moodData.title} - ${moodData.content}` : "Tidak ada catatan.";
    } else {
        modalMood.textContent = "Mood: Tidak tersedia";
        modalNote.textContent = "Tidak ada catatan.";
    }

    modal.style.display = 'flex';
}

// Close modal
document.getElementById('close-modal').addEventListener('click', () => {
    document.getElementById('note-modal').style.display = 'none';
});

// Initialize the calendar on monthly overview page
if (document.getElementById('calendar')) {
    document.addEventListener('DOMContentLoaded', loadMonthlyOverview);
}
function saveMoods() {
    localStorage.setItem('dailyMoods', JSON.stringify(dailyMoods));
}

function loadMoods() {
    const savedMoods = localStorage.getItem('dailyMoods');
    if (savedMoods) {
        Object.assign(dailyMoods, JSON.parse(savedMoods));
    }
}

if (dailyMoods[date]) {
    day.innerHTML = `<img src="${moodIcons[dailyMoods[date]]}" alt="${dailyMoods[date]}" class="mood-icon">`;
}

const moodIcons = {
    "😔": "sad.png",
    "😕": "stress.png",
    "😐": "meh.png",
    "🙂": "happy.png",
    "😄": "peaceful.png",
    "😡": "angry.png",
    "😟":"confused.png",
};
