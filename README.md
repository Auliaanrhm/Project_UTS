# 📘 Dokumentasi Service : StudentService

**StudentService** adalah layanan yang bertanggung jawab untuk mengelola data _siswa_. Layanan ini akan menyediakan / provide data student, sekaligus melakukan _consume_ data dari **EnrollmentService** untuk menyajikan informasi yang lebih kaya seperti jumlah kelas yang diambil oleh siswa tertentu.

---

## 🌐 Base URL : http://localhost:8082

## API Endpoints

### 1. Get All Students

- **Method**: `GET`
- **Endpoint**: `/api/students`
- **Deskripsi**: Endpoint ini digunakan untuk menampilkan seluruh data student, menjadi provider data student. 

#### 📥 Request

Tidak ada parameter tambahan.

#### 📤 Response (200 OK)

```json
[
	{
		"id": 1,
		"name": "User1",
		"email": "student@gmail.com",
		"phone": "08123456789",
		"created_at": "2025-05-01T06:20:08.000000Z",
		"updated_at": "2025-05-01T06:21:22.000000Z"
	},
	{
		"id": 2,
		"name": "student 2",
		"email": "student2@gmail.com",
		"phone": "08123456789",
		"created_at": "2025-05-01T06:21:35.000000Z",
		"updated_at": "2025-05-01T06:21:35.000000Z"
	}
]
```

### 2. Get Student By ID

- **Method**: `GET`
- **Endpoint**: `/api/students/{id}`
- **Deskripsi**: Endpoint ini akan menampilkan detail data siswa beserta jumlah kelas yang diambil, dengan cara consume dari EnrollmentService untuk mendapatkan data enrollment_count yang menampilkan jumlah kelas yang diambil oleh siswa tersebut. 

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

### 3. Add Student

- **Method**: `POST`
- **Endpoint**: `/api/students`
- **Deskripsi**: Endpoint untuk menambah data student. 

#### 📥 Request (body, JSON)

```json
{
    "name": "student 2",
    "email": "student2@gmail.com",
    "phone": "08123456789"
}
```

#### 📤 Response (200 OK)

```json
{
    "name": "student 2",
    "email": "student2@gmail.com",
    "phone": "08123456789",
    "updated_at": "2025-05-01T06:21:35.000000Z",
    "created_at": "2025-05-01T06:21:35.000000Z",
    "id": 2
}
```

### 4. Update Student

- **Method**: `PUT`
- **Endpoint**: `/api/students/{id}`
- **Deskripsi**: Endpoint untuk mengubah data student. 

#### 📥 Request (body, JSON)

```json
{
    "name": "User1",
    "email": "student@gmail.com",
    "phone": "08123456789"
}
```

#### 📤 Response (200 OK)

```json
{
    "id": 1,
    "name": "User1",
    "email": "student@gmail.com",
    "phone": "08123456789",
    "created_at": "2025-05-01T06:20:08.000000Z",
    "updated_at": "2025-05-01T06:21:22.000000Z"
}
```

### 5. Delete Student

- **Method**: `DELETE`
- **Endpoint**: `/api/students/{id}`
- **Deskripsi**: Endpoint untuk menghapus data student berdasarkan ID. 

#### 📥 Request (body, JSON)

Tidak ada parameter tambahan.

#### 📤 Response (200 OK)

```json
{
    "message": "Student deleted successfully."
}
```