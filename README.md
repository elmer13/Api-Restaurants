# 🍽️ API Restaurants - Laravel 12

RESTful API for restaurant management with JWT authentication and interactive documentation.

### Core Technologies
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

### API Tools
![Sanctum](https://img.shields.io/badge/Laravel_Sanctum-4B5563?style=for-the-badge)
![Swagger](https://img.shields.io/badge/Swagger-85EA2D?style=for-the-badge&logo=swagger&logoColor=black)
![Postman](https://img.shields.io/badge/Postman-FF6C37?style=for-the-badge&logo=postman&logoColor=white)

### Frontend Extras
![Font Awesome](https://img.shields.io/badge/Font_Awesome-528DD7?style=for-the-badge&logo=font-awesome&logoColor=white)


## 📋 Table of Contents
- [Requirements](#-requirements)
- [Development Environment](#-development-environment)
- [Initial Configuration](#-initial-configuration)
- [Endpoints](#-endpoints)
- [Authentication with Sanctum](#-authentication-with-sanctum)
- [API Documentation with Swagger](#-api-documentation-with-swagger)
- [Frontend](#-frontend)

## 🛠 Requirements
- PHP 8.2+ (https://www.php.net/downloads.php)
- XAMPP 3.3+ (MySQL, Apache) - (https://www.apachefriends.org/download.html)
- Composer 2.8+ - (https://getcomposer.org/download/)

## 🛠 Development Environment
- Visual Studio Code - (https://code.visualstudio.com/Download)
- Postman (https://www.postman.com/downloads/)
- GitHub (https://github.com/elmer13/Api-Restaurants)
- Laravel 12
- phpMyAdmin (BDD)
- Swagger
  
## 🚀 Initial Configuration
```bash
# 1. Clone repository
git clone https://github.com/elmer13/Api-Restaurants.git
cd api-restaurants

# 2. Install Dependencies
composer install

# 3. Configure Environment
cp .env.example .env
php artisan key:generate

# 4. Database (Create DB and run migrations)
php artisan migrate --seed

# 5. Start Development Server
php artisan serve
```

## 🔌 Endpoints

### Restaurants
| Method  | Endpoint | Description | Autenticación |
|--------|----------|-------------|---------------|
| `GET`    | `/api/restaurants`         | List all restaurants | Sí |
| `POST`   | `/api/restaurants`         | Create new restaurant | Sí |
| `GET`    | `/api/restaurants/{id}`    | Get restaurant details | Sí |
| `PUT`    | `/api/restaurants/{id}`    | Update restaurant | Sí |
| `DELETE` | `/api/restaurants/{id}`    | Delete restaurant | Sí |

### Users
| Method | Endpoint | Description | Autenticación |
|--------|----------|-------------|---------------|
| `POST`   | `/api/register`           | Register new user | No |
| `POST`   | `/api/login`              | Login (get token) | No |
| `POST`   | `/api/logout`             | Logout (invalidate token) | Sí |
| `GET`    | `/api/user`               | Get authenticated user info | Sí |


## 🔐 Authentication with Sanctum
### Authentication Flow
1. **User Registration** (get API Key):
   ```bash
   curl -X POST http://localhost:8000/api/register \
     -H "Content-Type: application/json" \
     -d '{
       "name": "Usuario Ejemplo",
       "email": "usuario@ejemplo.com",
       "password": "password-seguro",
       "password_confirmation": "password-seguro"
     }'
    ```
2. **Login (Generate New Token)**:
   ```bash
    curl -X POST http://localhost:8000/api/login \
      -H "Content-Type: application/json" \
      -d '{
        "email": "usuario@ejemplo.com",
        "password": "password-seguro"
      }'
    ```
   **Successful Response:**:
   ```bash
       {
          "token": "1|abcdef123456789...",
          "user": {
            "id": 1,
            "name": "Usuario Ejemplo"
          }
       }
    ```
3. **Accessing Protected Endpoints**:
   Include the token in the Authorization header:
   ```bash
    curl -X GET http://localhost:8000/api/user \
      -H "Accept: application/json" \
      -H "Authorization: Bearer 1|abcdef123456789..."
    ```
4. **Logout (Revoke Token)**:
   Include the token in the Authorization header:
   ```bash
    curl -X POST http://localhost:8000/api/logout \
      -H "Authorization: Bearer 1|abcdef123456789..."
    ```   
## 📚 API Documentation with Swagger

1. **Installation**:
   ```bash
    composer require darkaonline/l5-swagger
    php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider"
    ```
2. **Basic Configuration**:
    Edit config/l5-swagger.php:
   ```bash
    'paths' => [
        'docs' => storage_path('api-docs'), // Ruta de generación
        'annotations' => [
            base_path('app/Http/Controllers'), // Donde buscar anotaciones
        ],
    ],
    ```
3. **Model Annotations**:
   Example for Restaurant Model (`app/Models/Restaurant.php`)
   ```bash
    /**
     * @OA\Schema(
     *     schema="Restaurant",
     *     title="Restaurante",
     *     required={"name"},
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="name", type="string", example="Restaurante Ejemplo"),
     *     @OA\Property(property="address", type="string", example="Calle Falsa 123")
     * )
     */
    class Restaurant extends Model
    {
        // ...
    }
    ```
4. **Controller Annotations**:
   ### Example for RestaurantController (`app/Http/Controllers/RestaurantController.php`)
   ```bash
    /**
     * @OA\Get(
     *     path="/api/restaurants",
     *     summary="Listar restaurantes",
     *     tags={"Restaurantes"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Restaurant")
     *         )
     *     )
     * )
     */
    public function index()
    {
        // ...
    }
    ```
5. **Generate Documentation**:
   ```bash
   php artisan l5-swagger:generate
   ```
   Access the web interface:
   ```bash
   http://localhost:8000/api/documentation
   ```   
6. **Protected Endpoints**:
   Example for authenticated routes:
   ```bash
   /**
     * @OA\Post(
     *     path="/api/restaurants",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response=401, description="No autorizado")
     * )
     */
   ```

## 🖥 Frontend
 For this project, we've utilized **Laravel Blade** and **Tailwind CSS** for frontend development.

### Key Features:
- **Blade Templating**:
  - Component-based architecture
  - Template inheritance
  - Direct PHP integration

- **Tailwind CSS**:
  - Utility-first styling
  - Responsive design out-of-the-box
  - Custom configuration available


### Views    
 #### List
   <img width="1361" height="628" alt="image" src="https://github.com/user-attachments/assets/0f19be9c-0f60-4f2e-9fc1-0f943ec5e397" />
   
#### Create
<img width="1354" height="658" alt="image" src="https://github.com/user-attachments/assets/aee615e2-6454-43cd-852a-738d03e0aeaf" />

 #### Read
   <img width="1349" height="651" alt="image" src="https://github.com/user-attachments/assets/3a53e6e2-68e1-4289-b0c5-babddab94dae" />

 #### Update
   <img width="1351" height="664" alt="image" src="https://github.com/user-attachments/assets/b1eccc96-c816-4eb1-a850-0fe47d6759f3" />

 #### Delete
   <img width="1350" height="657" alt="image" src="https://github.com/user-attachments/assets/24acc2eb-e0d8-4921-81ea-fe759d0007ee" />


### UX (User Experience) Enhancements

#### Form Error Feedback
```html
<!-- resources/views/restaurants/create.blade.php -->
<input 
  class="@error('name') border-red-500 focus:ring-red-500 @enderror"
  type="text" 
  name="name"
>
@error('name')
  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
@enderror
```
- Error states show red borders and clear messages
- Prevents form resubmission by preserving user input
#### Smooth Hover Transitions
```html
<button class="transition-colors duration-200 hover:bg-blue-600">
  Create Restaurant
</button>
```
- Visual feedback on interactive elements
#### Empty State Handling
```html
@if($restaurants->isEmpty())
<div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mt-6">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <i class="fas fa-exclamation-triangle text-yellow-400 text-lg"></i>
        </div>
        <div class="ml-3">
            <p class="text-sm text-yellow-700">
                No restaurants yet. <a href="{{route('restaurants.create')}}" class="font-medium underline text-yellow-700 hover:text-yellow-600">Add your first one!</a>.
            </p>
        </div>
    </div>
</div>
@endif
```
#### Delete Confirmation
```html
<button onclick="return confirm('Are you sure you want to delete this restaurant?')">
  Delete
</button>
```


### UI (User Interface) Enhancements

#### Responsive Design
```html
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
  <!-- Content adapts to screen size -->
</div>
```

#### Button Consistency

| Action   | Base Classes       | Hover State        |
|----------|--------------------|--------------------|
| Create   | `bg-green-500`     | `hover:bg-green-600` |
| Edit     | `bg-blue-500`      | `hover:bg-blue-600`  |
| Delete   | `bg-red-500`       | `hover:bg-red-600`   |

#### Icon Integration
```html
<a href="{{route('restaurants.create')}}">
    <i class="fas fa-plus mr-1"></i>
    Add Restaurant
</a>
```

#### Spacing System
```html
<div class="space-y-4"> <!-- Vertical spacing -->
  <div class="p-6"> <!-- Padding -->
    <h2 class="mb-4">Section</h2> <!-- Margin bottom -->
  </div>
</div>
```

## 💛 Credits

### Author
Elmer García Yavi 

[![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github)](https://github.com/elmer13)  
[![LinkedIn](https://img.shields.io/badge/LinkedIn-0A66C2?style=for-the-badge&logo=linkedin)](https://www.linkedin.com/in/elmer-garcia-yavi-486828239/)  
✉️ egarciayavi@hotmail.com 

### Special Thanks
- To the [Laravel](https://laravel.com) community for their incredible PHP framework
- [Tailwind CSS](https://tailwindcss.com) for their utility-first CSS approach
- [Swagger](https://swagger.io) for enabling interactive API documentation

### License
[![MIT License](https://img.shields.io/badge/Licencia-MIT-green.svg?style=for-the-badge)](LICENSE)

---

**"If you're seeing this, thanks for checking out my project!"** 🌟
