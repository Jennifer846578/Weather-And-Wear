<button class="schedule-button" onclick="openPopup()">
    <img src="Asset\Homepage\calendar-icon.png" alt="Calendar Icon" class="calendar-icon">
    <img src="Asset\Homepage\line.png" alt="Calendar Icon" class="line">
    <p>View Schedule</p>
</button>

<div class="popup-background">
    <div class="popup">
        <button class="close-button">✖</button>
        <h2>7th June</h2>
        <div class="schedule-list">
            <div class="schedule-item">07:00 - 10:00 Morning Jogging</div>
            <div class="schedule-item">11:00 - 15:00 Luckman's Bday</div>
            <div class="schedule-item">17:00 - 19:00 Manicure</div>
            <div class="schedule-item">21:00 - 23:00 BBQ w/ friends</div>
        </div>
        <div class="calendar-table">
            {{-- <div class="month-navigation">
                <button onclick="alert('Previous month!')">&#8249;</button>
                <span>March 2024</span>
                <button onclick="alert('Next month!')">&#8250;</button>
            </div> --}}
            <div class="month-navigation">
                <button onclick="prevMonth()">&#8249;</button>
                <span>March 2024</span>
                <button onclick="nextMonth()">&#8250;</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td><td></td><td></td><td>1</td><td>2</td><td>3</td><td>4</td>
                    </tr>
                    <tr>
                        <td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td>
                    </tr>
                    <tr>
                        <td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td>
                    </tr>
                    <tr>
                        <td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td>
                    </tr>
                    <tr>
                        <td>26</td><td>27</td><td>28</td><td>29</td><td>30</td><td>31</td><td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script> //untuk pop up blur effect
    // Menampilkan pop-up dan latar belakang blur
    function showPopup() {
        const popupBackground = document.querySelector('.popup-background');
        popupBackground.style.display = 'flex';
    }

    // Menyembunyikan pop-up dan latar belakang blur
    function closePopup() {
        const popupBackground = document.querySelector('.popup-background');
        popupBackground.style.display = 'none';
    }

    // Menambahkan event listener untuk tombol
    document.querySelector('.schedule-button').addEventListener('click', showPopup);
    document.querySelector('.close-button').addEventListener('click', closePopup);

</script>

<script> // Fungsi Kalender
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    // Fungsi untuk mengisi kalender
    function generateCalendar(month, year) {
        const calendarBody = document.querySelector('.calendar-table table');
        const calendarTitle = document.querySelector('.month-navigation span');

        // Array nama bulan
        const months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        // Set judul bulan dan tahun
        calendarTitle.textContent = `${months[month]} ${year}`;

        // Hapus isi kalender sebelumnya
        calendarBody.innerHTML = `
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
        `;

        // Tanggal awal bulan
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Variabel untuk mengisi tanggal
        let date = 1;
        for (let i = 0; i < 6; i++) {
            const row = document.createElement('tr');

            for (let j = 0; j < 7; j++) {
                const cell = document.createElement('td');

                if (i === 0 && j < firstDay) {
                    // Tambahkan sel kosong sebelum tanggal pertama
                    cell.textContent = '';
                } else if (date > daysInMonth) {
                    // Hentikan jika tanggal sudah habis
                    cell.textContent = '';
                } else {
                    // Isi tanggal
                    cell.textContent = date;

                    // Tandai hari ini
                    if (
                        date === currentDate.getDate() &&
                        month === currentDate.getMonth() &&
                        year === currentDate.getFullYear()
                    ) {
                        cell.style.backgroundColor = '#839de2';
                        cell.style.color = '#ffffff';
                        cell.style.borderRadius = '50%';
                    }
                    date++;
                }

                row.appendChild(cell);
            }
            calendarBody.appendChild(row);
        }
    }

    // Fungsi untuk tombol bulan sebelumnya
    function prevMonth() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar(currentMonth, currentYear);
    }

    // Fungsi untuk tombol bulan berikutnya
    function nextMonth() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentMonth, currentYear);
    }

    // Inisialisasi kalender pertama kali
    generateCalendar(currentMonth, currentYear);


</script>
