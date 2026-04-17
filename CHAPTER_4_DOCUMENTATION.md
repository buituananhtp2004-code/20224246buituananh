# CHƯƠNG 4: TRIỂN KHAI MÔ HÌNH QUẢN LÝ SINH VIÊN
## Tài liệu Hoàn thành Bài Tập

### 📋 Mô tả hệ thống

Hệ thống Quản lý Sinh viên bao gồm các thành phần chính:

1. **Classroom (Lớp học)**
   - id (PK)
   - class_name (Tên lớp)
   - timestamps

2. **Student (Sinh viên)**
   - id (PK)
   - student_name (Tên sinh viên)
   - class_id (FK → Classroom.id)
   - is_active (Trạng thái hoạt động)
   - timestamps

3. **Subject (Môn học)**
   - id (PK)
   - subject_name (Tên môn học)
   - timestamps

4. **student_subject (Pivot - Đăng ký môn học)**
   - student_id (FK → Student.id)
   - subject_id (FK → Subject.id)
   - score (Điểm - Nullable)
   - registered_at (Thời gian đăng ký)

---

## ✅ BÀI 1: Vẽ ERD Mô Hình Quản Lý Sinh Viên

### Yêu cầu:
- ✅ Vẽ đúng 3 loại quan hệ:
  - 1-n: Classroom ↔ Student
  - n-n: Student ↔ Subject (qua bảng pivot)
- ✅ Ghi đúng PK - FK
- ✅ Thể hiện đầy đủ attribute

### 📊 ERD Diagram:
```
CLASSROOM (1) ──→ (n) STUDENT
    ├─ id (PK)
    └─ class_name

STUDENT (n) ──→ (n) SUBJECT
    ├─ id (PK)
    ├─ student_name
    ├─ class_id (FK)
    └─ is_active

SUBJECT
    ├─ id (PK)
    └─ subject_name

STUDENT_SUBJECT (Pivot)
    ├─ student_id (FK)
    ├─ subject_id (FK)
    ├─ score (Nullable)
    └─ registered_at
```

**Vị trí:** Diagram được render bằng Mermaid diagram.

---

## ✅ BÀI 2: Tạo Migration & Model

### Migrations đã tạo:

#### 1. Classroom Migration
📁 `database/migrations/2025_04_17_000001_create_classrooms_table.php`
- Bảng đơn giản với id, class_name, timestamps

#### 2. Subject Migration
📁 `database/migrations/2025_04_17_000002_create_subjects_table.php`
- Bảng đơn giản với id, subject_name, timestamps

#### 3. Student Migration
📁 `database/migrations/2025_04_17_000003_create_students_table.php`
- Chứa foreign key với cascade delete
```php
$table->foreignId('class_id')
      ->constrained('classrooms')
      ->cascadeOnDelete();
```

#### 4. Pivot Migration
📁 `database/migrations/2025_04_17_000004_create_student_subject_table.php`
- Composite primary key (student_id, subject_id)
- Foreign keys với cascade delete
- Columns: score (nullable), registered_at

### Chạy Migration:
```bash
php artisan migrate
```

---

## ✅ BÀI 3: Khai Báo Quan Hệ Eloquent

### Models đã cập nhật:

#### 1. Classroom Model
📁 `app/Models/Classroom.php`
```php
public function students(): HasMany {
    return $this->hasMany(Student::class, 'class_id');
}
```

#### 2. Student Model
📁 `app/Models/Student.php`
```php
// Quan hệ belongsTo
public function classroom(): BelongsTo {
    return $this->belongsTo(Classroom::class, 'class_id');
}

// Quan hệ belongsToMany
public function subjects(): BelongsToMany {
    return $this->belongsToMany(Subject::class, 'student_subject')
                ->withPivot(['score', 'registered_at']);
}
```

#### 3. Subject Model
📁 `app/Models/Subject.php`
```php
public function students(): BelongsToMany {
    return $this->belongsToMany(Student::class, 'student_subject')
                ->withPivot(['score', 'registered_at']);
}
```

---

## ✅ BÀI 4: Query Builder & Eloquent Nâng Cao

### 📁 Vị trí: `app/Services/QueryExamples.php`

Tất cả các truy vấn yêu cầu đều được cài đặt:

### 1. Lấy danh sách sinh viên thuộc lớp "CNTT1"
```php
QueryExamples::getStudentsByClassName('CNTT1');
```
- Sử dụng whereHas() hoặc JOIN
- Trả về Collection các sinh viên

### 2. Lấy tất cả môn học mà sinh viên id=5 đã đăng ký
```php
QueryExamples::getSubjectsByStudentId(5);
```
- Sử dụng relationship với Student::find()
- Trả về Collection các môn học

### 3. Đếm số sinh viên theo từng lớp
```php
QueryExamples::countStudentsByClass();
```
- Sử dụng withCount()
- Trả về Collection với student_count

### 4. Lấy danh sách sinh viên kèm số lượng môn đăng ký (LEFT JOIN)
```php
QueryExamples::getStudentsWithSubjectCount();
```
- Sử dụng leftJoin + groupBy
- Trả về Collection với subject_count

### Các query bonus:
- `getActiveStudentsWithDetails()` - Sinh viên hoạt động với chi tiết
- `getStudentsWithSubjectsByClassName()` - Sinh viên và các môn học theo lớp
- `getSubjectsWithStudentCount()` - Môn học và số sinh viên
- `getPassedStudentsBySubject()` - Sinh viên qua môn (score >= 5)

---

## ✅ BÀI 5: Local Scope & Global Scope

### 1. Local Scope: scopeActive()
📁 `app/Models/Student.php`
```php
public function scopeActive($query) {
    return $query->where('is_active', true);
}
```

**Sử dụng:**
```php
Student::active()->get(); // Lấy sinh viên hoạt động
```

### 2. Global Scope: SortByNameScope
📁 `app/Models/Scopes/SortByNameScope.php`

Tự động sắp xếp sinh viên theo tên tăng dần:
```php
public function apply(Builder $builder, Model $model) {
    $builder->orderBy('student_name', 'asc');
}
```

**Áp dụng tự động:**
```php
Student::all(); // Luôn sắp xếp theo tên
```

**Bỏ qua global scope:**
```php
Student::withoutGlobalScopes()->get(); // Không sắp xếp
```

---

## ✅ BÀI 6: Repository Pattern

### 📁 Files:
1. **Interface:** `app/Repositories/Contracts/StudentRepositoryInterface.php`
2. **Implementation:** `app/Repositories/StudentRepository.php`
3. **Binding:** `app/Providers/AppServiceProvider.php`

### Các Method:

#### 1. all()
```php
$students = $repository->all();
// Trả về Collection với relationships
```

#### 2. find($id)
```php
$student = $repository->find(5);
// Trả về Student object hoặc null
```

#### 3. studentsByClass($classId)
```php
$students = $repository->studentsByClass(1);
// Trả về Collection sinh viên của một lớp
```

#### 4. activeStudents()
```php
$students = $repository->activeStudents();
// Trả về Collection sinh viên hoạt động
```

#### 5. registerSubject($studentId, $subjectId, $data)
```php
$success = $repository->registerSubject(5, 3, ['score' => 8.5]);
// Đăng ký sinh viên cho môn học
```

#### 6. unregisterSubject($studentId, $subjectId)
```php
$success = $repository->unregisterSubject(5, 3);
// Huỷ đăng ký sinh viên khỏi môn học
```

#### 7. create($data)
```php
$student = $repository->create([
    'student_name' => 'Nguyễn Văn A',
    'class_id' => 1,
    'is_active' => true
]);
```

#### 8. update($id, $data)
```php
$success = $repository->update(5, ['is_active' => false]);
```

#### 9. delete($id)
```php
$success = $repository->delete(5);
```

### Sử dụng trong Controller:
```php
class StudentController extends Controller {
    public function __construct(StudentRepositoryInterface $repository) {
        $this->repository = $repository;
    }
    
    public function index() {
        $students = $this->repository->all();
        return view('students.index', compact('students'));
    }
}
```

### Binding trong AppServiceProvider:
```php
public function register(): void {
    $this->app->bind(
        StudentRepositoryInterface::class,
        StudentRepository::class
    );
}
```

---

## ✅ BÀI 7: REST API - Full Module Student Management

### 📁 Vị trí:
- **Controller:** `app/Http/Controllers/StudentApiController.php`
- **Routes:** `routes/api.php`

### API Endpoints:

#### 1. GET /api/students
**Lấy danh sách tất cả sinh viên**
```bash
GET /api/students
```
Response:
```json
{
    "success": true,
    "message": "Students retrieved successfully",
    "data": [...]
}
```

#### 2. POST /api/students
**Tạo sinh viên mới**
```bash
POST /api/students
Content-Type: application/json

{
    "student_name": "Nguyễn Văn A",
    "class_id": 1,
    "is_active": true
}
```

#### 3. GET /api/students/{id}
**Lấy chi tiết một sinh viên**
```bash
GET /api/students/5
```

#### 4. PUT /api/students/{id}
**Cập nhật thông tin sinh viên**
```bash
PUT /api/students/5
Content-Type: application/json

{
    "student_name": "Nguyễn Văn B",
    "is_active": false
}
```

#### 5. DELETE /api/students/{id}
**Xóa sinh viên**
```bash
DELETE /api/students/5
```

#### 6. GET /api/students/{id}/subjects
**Lấy danh sách môn học sinh viên đã đăng ký**
```bash
GET /api/students/5/subjects
```
Response:
```json
{
    "success": true,
    "message": "Subjects retrieved successfully",
    "data": [
        {
            "id": 1,
            "subject_name": "Lập trình Web",
            "pivot": {
                "score": 8.5,
                "registered_at": "2025-04-17..."
            }
        }
    ]
}
```

#### 7. POST /api/students/{id}/register-subject/{subject_id}
**Đăng ký sinh viên cho một môn học**
```bash
POST /api/students/5/register-subject/3
Content-Type: application/json

{
    "score": 8.5
}
```

#### 8. DELETE /api/students/{id}/unregister-subject/{subject_id}
**Huỷ đăng ký sinh viên khỏi một môn học**
```bash
DELETE /api/students/5/unregister-subject/3
```

### Response Format:
Tất cả responses tuân theo REST standard:

**Success (200, 201):**
```json
{
    "success": true,
    "message": "...",
    "data": {}
}
```

**Error (400, 404, 422, 500):**
```json
{
    "success": false,
    "message": "...",
    "error": "..." hoặc "errors": {}
}
```

---

## 🚀 Hướng Dẫn Chạy

### 1. Cài đặt & Migrate
```bash
# Cài dependencies
composer install

# Migrate database
php artisan migrate

# (Tùy chọn) Seed dữ liệu
php artisan db:seed
```

### 2. Chạy Server
```bash
php artisan serve
```

### 3. Kiểm tra Routes
```bash
php artisan route:list
```

### 4. Sử dụng API
```bash
# Với curl
curl -X GET http://localhost:8000/api/students

# Hoặc sử dụng Postman, Insomnia, Thunder Client, v.v.
```

---

## 📂 Cấu trúc Thư Mục

```
app/
├── Http/
│   └── Controllers/
│       ├── StudentApiController.php (✅ NEW)
│       └── ...
├── Models/
│   ├── Classroom.php (✅ UPDATED)
│   ├── Student.php (✅ UPDATED)
│   ├── Subject.php (✅ UPDATED)
│   └── Scopes/
│       └── SortByNameScope.php (✅ NEW)
├── Repositories/
│   ├── Contracts/
│   │   └── StudentRepositoryInterface.php (✅ NEW)
│   └── StudentRepository.php (✅ NEW)
├── Services/
│   └── QueryExamples.php (✅ NEW)
└── Providers/
    └── AppServiceProvider.php (✅ UPDATED)

database/
└── migrations/
    ├── 2025_04_17_000001_create_classrooms_table.php (✅ NEW)
    ├── 2025_04_17_000002_create_subjects_table.php (✅ NEW)
    ├── 2025_04_17_000003_create_students_table.php (✅ NEW)
    └── 2025_04_17_000004_create_student_subject_table.php (✅ NEW)

routes/
├── web.php
└── api.php (✅ NEW)

bootstrap/
└── app.php (✅ UPDATED)
```

---

## 🎯 Tóm Tắt Hoàn Thành

| Bài | Yêu Cầu | Trạng Thái | Vị Trí |
|-----|---------|-----------|--------|
| 1 | Vẽ ERD | ✅ | Mermaid Diagram |
| 2 | Migrations & Models | ✅ | database/migrations/, app/Models/ |
| 3 | Eloquent Relationships | ✅ | app/Models/ |
| 4 | Advanced Queries | ✅ | app/Services/QueryExamples.php |
| 5 | Local & Global Scopes | ✅ | app/Models/, app/Models/Scopes/ |
| 6 | Repository Pattern | ✅ | app/Repositories/ |
| 7 | REST API | ✅ | app/Http/Controllers/StudentApiController.php, routes/api.php |

---

## 📝 Ghi Chú

- Tất cả migrations sử dụng `cascadeOnDelete()` để đảm bảo dữ liệu nhất quán
- Global Scope tự động sắp xếp sinh viên theo tên, có thể bỏ qua với `withoutGlobalScopes()`
- Repository Pattern giúp tách biệt logic database khỏi controller
- API responses tuân theo REST standard với HTTP status codes phù hợp
- Validation được áp dụng cho tất cả API endpoints

---

## 🤝 Support

Nếu gặp vấn đề hoặc có câu hỏi, vui lòng kiểm tra:
1. Migrations đã chạy thành công
2. Database connections trong .env
3. Routes đã được register đúng
4. Models imports đúng namespaces
