# 🔗 Dokumentasi Integrasi Antar Services – Online Course System

## 🧩 Overview

Sistem **Online Course** ini terdiri dari beberapa layanan (_services_) yang berkomunikasi satu sama lain menggunakan protokol **HTTP REST API** dan format data **JSON**. Tujuan komunikasi antar layanan adalah untuk menyatukan informasi dari berbagai sumber layanan sehingga aplikasi dapat memberikan data yang lengkap kepada pengguna.

---

## 🧱 Architecture

Berikut adalah daftar layanan utama beserta tanggung jawabnya:

| Service Name        | Port   | Fungsi Utama                                     |
| ------------------- | ------ | ------------------------------------------------ |
| `CourseService`     | `8081` | Menyediakan data kursus (judul, instruktur, dll) |
| `StudentService`    | `8082` | Mengelola data mahasiswa (nama, email, dll)      |
| `EnrollmentService` | `8080` | Mencatat dan menyediakan data pendaftaran kursus |

---

## 🔄 Alur Komunikasi Antar Layanan

### 1. EnrollmentService 🔁 StudentService & CourseService

- **Deskripsi**: Endpoint ini menampilkan detail kursus beserta data detail kurus dan detail siswa yang mendaftar pada kursus tersebut.
- **Consumer**: `EnrollmentService`
- **Provider**: `CourseService` & `StudentService`
- **Endpoint yang di provide**:  
  `GET http://localhost:8080/api/enrollments`
- **Endpoint yang di consume**:  
  `GET http://localhost:8081/api/courses`
  `GET http://localhost:8082/api/students`

#### 📥 Request

Tidak ada parameter tambahan.

#### 📤 Response (200 OK)

```json
[
	{
		"id": 1,
		"enrolled_at": "2025-05-01",
		"course": {
			"id": 1,
			"title": "Python Fundamental",
			"description": "coding courses with python",
			"instructor": "Jack",
			"duration": 10,
			"price": "200000.00",
			"created_at": "2025-05-01T06:31:24.000000Z",
			"updated_at": "2025-05-01T06:33:21.000000Z"
		},
		"student": {
			"id": 1,
			"name": "User1",
			"email": "student@gmail.com",
			"phone": "08123456789",
			"created_at": "2025-05-01T06:20:08.000000Z",
			"updated_at": "2025-05-01T06:21:22.000000Z"
		}
	}
]
```

### 2. StudentService 🔁 EnrollmentService

- **Deskripsi**: Endpoint ini akan menampilkan detail data siswa beserta jumlah kelas yang diambil, dengan cara consume dari EnrollmentService untuk mendapatkan data enrollment_count yang menampilkan jumlah kelas yang diambil oleh siswa tersebut.
- **Consumer**: `StudentService`
- **Provider**: `EnrollmentService`
- **Endpoint yang di provide**:  
  `GET http://localhost:8082/api/students/{id}`
- **Endpoint yang di consume**:  
  `GET http://localhost:8080/api/enrollments/student/{$id}/count`

#### 📥 Request

Tidak ada parameter tambahan.

#### 📤 Response (200 OK)

```json
{
	"id": 1,
	"name": "User1",
	"email": "student@gmail.com",
	"phone": "08123456789",
	"enrollment_count": 1
}
```

### 3. CourseService 🔁 EnrollmentService

- **Deskripsi**: Endpoint ini akan menampilkan detail data course beserta jumlah siswa yang mengambilnya, dengan cara consume dari EnrollmentService untuk mendapatkan data student_count yang menampilkan jumlah siswa yang mengam bil kelas tersebut.
- **Consumer**: `StudentService`
- **Provider**: `EnrollmentService`
- **Endpoint yang di provide**:  
  `GET http://localhost:8081/api/courses/{id}`
- **Endpoint yang di consume**:  
  `GET http://localhost:8080/api/enrollments/course/{$id}/count`

#### 📥 Request

Tidak ada parameter tambahan.

#### 📤 Response (200 OK)

```json
{
	"id": 1,
	"title": "Python Fundamental",
	"description": "coding courses with python",
	"instructor": "Jack",
	"duration": 10,
	"price": "200000.00",
	"student_count": 1
}
```
