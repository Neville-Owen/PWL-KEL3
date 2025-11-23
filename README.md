# PWL-KEL3

Questify adalah aplikasi Membantu siswa mengatur tugas dengan lebih efektif, Meningkatkan motivasi belajar melalui elemen gamifikasi, Memberikan pengalaman belajar yang interaktif dan menyenangkan.

---
## Main Features
1. Manajemen Soal Berdasarkan Level
Pengguna dapat memilih soal pada berbagai tingkat (level) yang disediakan.
Setiap level berisi materi dan latihan dengan tingkat kesulitan berbeda.

2. Gamifikasi Pembelajaran
a.Sistem level
b.Penyelesaian soal
c.Progres belajar :
Fitur ini membuat belajar terasa seperti bermain sehingga lebih menarik dan tidak membosankan.

3. Navigasi Simpel & User-Friendly
Karena berbasis HTML dan CSS, aplikasi sangat ringan dan mudah dijalankan hanya dengan membuka file .html.

4. Pusat Bantuan & Feedback
Pengguna dapat mengirim pertanyaan, keluhan, maupun saran melalui halaman Help.

## Entity used
1. category_ranks :
   a.id
   b.user_id
   c.category
   d.rank_level
   e.created_at
   f.updated_at

2. subject_progress
   a.id
   b.user_id
   c.subject
   d.current_progress
   e.total_completed
   f.last_updated

3. tasks
   a.id
   b.user_id
   c.subject
   d.task_name
   e.difficulty
   f.weight
   g.status
   h.created_at
   i.completed_at

4. users
   a.id
   b.name
   c.email
   d.password
   e.created_at

5. user_stats
   a.user_id
   b.rank_name
   c.exp
   d.points
   e.level_num
   f.total_completed
   g.updated_at

## Setup Database
   **Tabel User**
CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
);
 _________________________________________________________________________________

CREATE TABLE `user_stats` (
  `user_id` int NOT NULL,
  `rank_name` varchar(50) DEFAULT 'Novice',
  `exp` int DEFAULT '0',
  `points` int DEFAULT '0',
  `level_num` int DEFAULT '1',
  `total_completed` int DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

___________________________________________________________________________________
   **Table Rank**
CREATE TABLE `category_ranks` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `category` varchar(50) NOT NULL,
  `rank_level` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

___________________________________________________________________________________

  **Table Proggres**
  CREATE TABLE `subject_progress` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `subject` varchar(50) NOT NULL,
  `current_progress` decimal(5,2) DEFAULT '0.00',
  `total_completed` int DEFAULT '0',
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

____________________________________________________________________________________

  **Table Misi**
CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `subject` varchar(50) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `difficulty` varchar(20) NOT NULL,
  `weight` int NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `completed_at` timestamp NULL DEFAULT NULL
);

## Installation
1. Clone this repository:
 ```bash
   git clone https://github.com/Neville-Owen/PWL-KEL3.git
   ```

2. Enter the project directory:
    ```bash
   cd PWL-KEL3
   ```

    3. No additional dependencies are required as this project only uses HTML, CSS, and Laragon.
Simply open the `homepage.html` file in your favorite browser.

##  Usage

1.Jalankan website dengan membuka `homepage.html`.
2.Navigasikan menu yang tersedia:
Pilih soal berdasarkan level yang telah dibuat dalam aplikasi Questify.
3.Ikuti materi dan latihan pada setiap level untuk meningkatkan kemampuan belajar.

   ---

   ##  Architecture

Project structure:

```
PWL-XITKJ3-Kelompok3/
│── index.html      # Main page
│── style.css       # Website styling
│── img/            # Supporting icons/images
│── README.md       # Project documentation
```

Technologies used:
- **HTML4** → Struktur konten 
- **CSS4** → Tampilan visual

  ## Contributing

Kami sangat terbuka terhadap kontribusi untuk mengembangkan aplikasi Questify menjadi lebih baik!
Kamu dapat membantu dengan:

Memperbaiki bug
Menambah fitur baru
Meningkatkan dokumentasi
Mengirim materi atau soal baru

Cara Berkontribusi

Masuk ke menu Help di aplikasi Questify.
Isi pertanyaan, umpan balik, atau kendala yang kamu alami.
Klik tombol **"Submit"**.
Tim kami akan memproses permintaanmu secepatnya.

Bersama-sama, kita bisa menjadikan Questify platform belajar yang lebih baik! 🚀

---

## License

Proyek ini menggunakan **Questify License**.
Anda bebas menggunakan, mengubah, dan mendistribusikan proyek ini selama tetap memberikan kredit yang sesuai. 

---

## Team Members

1. Neville Owen Clay
2. Felix Yonathan 
3. Leonardo Agustin  
