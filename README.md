# 🏨 Decameron - Sistema de Gestión de Hoteles y Habitaciones

Proyecto completo con backend en PHP + PostgreSQL y frontend en Vue.js, desarrollado como prueba técnica. Permite registrar hoteles, habitaciones y realizar operaciones CRUD desde una interfaz moderna y conectada a la nube.

---

## 🚀 Tecnologías Utilizadas

| Componente     | Tecnología            |
|----------------|------------------------|
| Backend        | PHP nativo + PDO       |
| Base de datos  | PostgreSQL             |
| Frontend       | Vue 3 + Vite + Axios   |
| Despliegue API | Render.com             |
| Despliegue Web | Vercel.com             |
| Administración | pgAdmin / DBeaver      |

---

## 📁 Estructura del Repositorio

decameron_backend/
├── controllers/
├── models/
├── routes/
├── dump/
│ └── dump-decameron_hotels_c8eq-202505092127.sql
├── db.php
├── index.php
└── README.md


---

## 🧪 ¿Cómo ejecutar el proyecto localmente?

### 🔸 Requisitos

- PHP (XAMPP o similar)
- PostgreSQL
- Git
- VS Code
- Node.js y npm (para frontend)

---

## 🔧 Instrucciones para el backend

### 1. Clonar el repositorio

```bash
git clone https://github.com/Ha770ran/decameron_backend.git
cd decameron_backend

## 🗄️ Restaurar base de datos desde dump

### 🔸 Opción A: Usando pgAdmin

1. Abre pgAdmin
2. Crea una nueva base llamada `decameron_hotels`
3. Clic derecho sobre la base > **Restore**
4. Selecciona el archivo:
5. En **Formato**, selecciona: `Plain`
6. Haz clic en **Ejecutar**

---

### 🔸 Opción B: Usando DBeaver

1. Conéctate a tu base de datos en DBeaver
2. Clic derecho sobre la base > **Tools > Restore**
3. Selecciona el archivo `.sql` que está en la carpeta `/dump/`
4. Inicia el proceso

#### 🌐 Ver el backend en producción
Render:
👉 https://decameron-backend.onrender.com

Puedes consumir endpoints como:

```bash
GET /hotels.php
POST /hotels.php
GET /rooms.php?hotel_id=1

##### 🖥️ Ver el frontend en producción
Vercel:
👉 https://frontend-decameron.vercel.app

Incluye:
Formulario para crear hoteles
Listado en tiempo real
Gestión de habitaciones
UI responsive adaptada a pantallas pequeñas

💡 Notas finales
Proyecto desarrollado como prueba técnica
Totalmente funcional, modular y desplegado en nube
Puede ser ampliado con login, reservas, reportes, etc.

👤 Autor
Nombre: Haloran Barney Iglesias
GitHub: @Ha770ran
Contacto: hebi.tech@gmail.com



