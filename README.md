# 📘 Dokumentasi Service : CourseService

**CourseService** adalah layanan yang bertanggung jawab untuk mengelola data _kelas_. Layanan ini akan menyediakan / provide data course, sekaligus melakukan _consume_ data dari **EnrollmentService** untuk menyajikan informasi yang lebih kaya seperti jumlah siswa yang mengambil kelas tertentu.

---

## 🌐 Base URL : http://localhost:8081

## API Endpoints

### 1. Get All Courses

- **Method**: `GET`
- **Endpoint**: `/api/courses`
- **Deskripsi**: Endpoint ini digunakan untuk menampilkan seluruh data course, menjadi provider data course.

#### 📥 Request

Tidak ada parameter tambahan.

#### 📤 Response (200 OK)

```json
[
	{
		"id": 1,
		"title": "Python Fundamental",
		"description": "coding courses with python",
		"instructor": "Jack",
		"duration": 10,
		"price": "200000.00",
		"created_at": "2025-05-01T06:31:24.000000Z",
		"updated_at": "2025-05-01T06:33:21.000000Z"
	}
]
```

### 2. Get Course By ID

- **Method**: `GET`
- **Endpoint**: `/api/courses/{id}`
- **Deskripsi**: Endpoint ini akan menampilkan detail data course beserta jumlah siswa yang mengambilnya, dengan cara consume dari EnrollmentService untuk mendapatkan data student_count yang menampilkan jumlah siswa yang mengam bil kelas tersebut.

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

### 3. Add Course

- **Method**: `POST`
- **Endpoint**: `/api/courses`
- **Deskripsi**: Endpoint untuk menambah data course.

#### 📥 Request (body, JSON)

```json
{
	"title": "Python Fundamental",
	"description": "coding courses with python",
	"instructor": "Jack",
	"duration": "10",
	"price": "200000"
}
```

#### 📤 Response (200 OK)

```json
{
	"title": "Python Fundamental",
	"description": "coding courses with python",
	"instructor": "Jack",
	"duration": "10",
	"price": "200000",
	"updated_at": "2025-05-01T06:33:31.000000Z",
	"created_at": "2025-05-01T06:33:31.000000Z",
	"id": 2
}
```

### 4. Update Course

- **Method**: `PUT`
- **Endpoint**: `/api/courses/{id}`
- **Deskripsi**: Endpoint untuk mengubah data course.

#### 📥 Request (body, JSON)

```json
{
	"title": "Python Fundamental",
	"description": "coding courses with python",
	"instructor": "Jack",
	"duration": "10",
	"price": "200000"
}
```

#### 📤 Response (200 OK)

```json
{
	"id": 1,
	"title": "Python Fundamental",
	"description": "coding courses with python",
	"instructor": "Jack",
	"duration": "10",
	"price": "200000",
	"created_at": "2025-05-01T06:31:24.000000Z",
	"updated_at": "2025-05-01T06:33:21.000000Z"
}
```

### 5. Delete Course

- **Method**: `DELETE`
- **Endpoint**: `/api/courses/{id}`
- **Deskripsi**: Endpoint untuk menghapus data course berdasarkan ID.

#### 📥 Request (body, JSON)

Tidak ada parameter tambahan.

#### 📤 Response (200 OK)

```json
{
	"message": "Course deleted successfully."
}
```
