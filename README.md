# 📘 Dokumentasi Service : EnrollmentService

**EnrollmentService** adalah layanan yang bertanggung jawab untuk mengelola data _enrollment_. Layanan ini akan menyediakan / provide data enrollment, sekaligus melakukan _consume_ data dari **StudentService** dan **CourseService** untuk menyajikan informasi yang lebih kaya seperti detail siswa yang mengambil kelas beserta detail kelas yang diambilnya.

---

## 🌐 Base URL : http://localhost:8080

## API Endpoints

### 1. Get All Enrollments

- **Method**: `GET`
- **Endpoint**: `/api/enrollments`
- **Deskripsi**: Endpoint ini menampilkan semua data enrollments, melakukan consume dari CourseService dan StudentService kemudian menampilkan tiap enrollment beserta detail student dan kelas yang diambil.

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

### 2. Get Enrollment By ID

- **Method**: `GET`
- **Endpoint**: `/api/enrollments/{id}`
- **Deskripsi**: Endpoint ini digunakan untuk mengambil data enrollment berdasarkan ID

#### 📥 Request

Tidak ada parameter tambahan.

#### 📤 Response (200 OK)

```json
{
	"id": 1,
	"student_id": 1,
	"course_id": 1,
	"enrolled_at": "2025-05-01",
	"status": "active",
	"created_at": "2025-05-01T06:37:44.000000Z",
	"updated_at": "2025-05-01T06:37:44.000000Z"
}
```

### 3. Add Enrollment

- **Method**: `POST`
- **Endpoint**: `/api/enrollments`
- **Deskripsi**: Endpoint untuk menambah data enrollment.

#### 📥 Request (body, JSON)

```json
{
	"student_id": "1",
	"course_id": "1",
	"enrolled_at": "2025-05-01",
	"status": "active"
}
```

#### 📤 Response (200 OK)

```json
{
	"student_id": "1",
	"course_id": "1",
	"enrolled_at": "2025-05-01",
	"status": "active",
	"updated_at": "2025-05-01T07:45:45.000000Z",
	"created_at": "2025-05-01T07:45:45.000000Z",
	"id": 3
}
```

### 4. Update Enrollment

- **Method**: `PUT`
- **Endpoint**: `/api/enrollments/{id}`
- **Deskripsi**: Endpoint untuk mengubah data enrollment.

#### 📥 Request (body, JSON)

```json
{
	"student_id": "1",
	"course_id": "1",
	"enrolled_at": "2025-05-01",
	"status": "active"
}
```

#### 📤 Response (200 OK)

```json
{
	"id": 1,
	"student_id": "1",
	"course_id": "1",
	"enrolled_at": "2025-05-01",
	"status": "active",
	"created_at": "2025-05-01T06:37:44.000000Z",
	"updated_at": "2025-05-01T06:37:44.000000Z"
}
```

### 5. Delete Enrollment

- **Method**: `DELETE`
- **Endpoint**: `/api/enrollments/{id}`
- **Deskripsi**: Endpoint untuk menghapus data enrollment berdasarkan ID.

#### 📥 Request (body, JSON)

Tidak ada parameter tambahan.

#### 📤 Response (200 OK)

```json
{
	"message": "Enrollment deleted successfully."
}
```

### 6. GET Student Count of Course

- **Method**: `GET`
- **Endpoint**: `/api/enrollments/course/{course_id}/count`
- **Deskripsi**: Endpoint untuk mendapatkan jumlah siswa dalam satu course tertentu.

#### 📥 Request (body, JSON)

Tidak ada parameter tambahan.

#### 📤 Response (200 OK)

```json
{
	"course_id": "1",
	"student_count": 1
}
```

### 7. GET Course Count of Student

- **Method**: `GET`
- **Endpoint**: `/api/enrollments/student/{student_id}/count`
- **Deskripsi**: Endpoint untuk mendapatkan jumlah course yang diikuti oleh salah satu siswa.

#### 📥 Request (body, JSON)

Tidak ada parameter tambahan.

#### 📤 Response (200 OK)

```json
{
	"student_id": "1",
	"enrolled_course_count": 1
}
```
