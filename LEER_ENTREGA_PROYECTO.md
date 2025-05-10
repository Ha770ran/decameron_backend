# 📦 ENTREGA FINAL – Proyecto Decameron

Entrega técnica completa de sistema para gestión de hoteles y habitaciones con backend en PHP + PostgreSQL y frontend en Vue 3, conectados y desplegados en la nube.

---

## 📝 Información General

- 🔧 **Tecnologías**: PHP, PostgreSQL, Vue 3, Vite, Axios
- 🌐 **Despliegue en la nube**: Render (API) y Vercel (UI)
- 🧩 **Estructura**: Arquitectura MVC con rutas RESTful y separación backend/frontend
- 📐 **Incluye**: Diagramas UML, Dump SQL, documentación

---

## 🔗 ENLACES IMPORTANTES

### 🖥️ Frontend (Vercel)
URL:  
👉 [`https://frontend-decameron.vercel.app`](https://frontend-decameron.vercel.app)

---

### 🛠️ Backend API (Render)
URL base:  
👉 [`https://decameron-backend.onrender.com`](https://decameron-backend.onrender.com)

#### Endpoints REST principales:

| Método | URL                                 | Descripción                    |
|--------|-------------------------------------|--------------------------------|
| GET    | `/hotels.php`                       | Listar hoteles                 |
| POST   | `/hotels.php`                       | Crear hotel                    |
| PUT    | `/hotels.php`                       | Editar hotel                   |
| DELETE | `/hotels.php?id=ID`                 | Eliminar hotel                 |
| GET    | `/rooms.php?hotel_id=ID`            | Listar habitaciones por hotel |
| POST   | `/rooms.php`                        | Crear habitación               |
| PUT    | `/rooms.php`                        | Editar habitación              |
| DELETE | `/rooms.php?id=ID`                  | Eliminar habitación            |

---

### 🧾 Repositorios GitHub

- 📦 Backend:  
  [`https://github.com/Ha770ran/decameron_backend`](https://github.com/Ha770ran/decameron_backend)

- 💻 Frontend:  
  [`https://github.com/Ha770ran/frontend-decameron`](https://github.com/Ha770ran/frontend-decameron)

---

### 🗄️ Dump SQL de la base de datos

Archivo `.sql` exportado desde DBeaver (con estructura y datos):

👉 [`dump/dump-decameron_hotels_c8eq-202505092127.sql`](https://github.com/Ha770ran/decameron_backend/blob/main/dump/dump-decameron_hotels_c8eq-202505092127.sql)

---

### 🧩 Diagramas UML

Diagramas de Casos de Uso y Clases realizados en Draw.io:

👉 [`https://app.diagrams.net/`](https://app.diagrams.net/)  
(Copia local o descarga disponible en carpeta `/uml` si aplica)

---

### 📘 Documentación técnica

Cada repositorio incluye su propio:

- `README.md`: instrucciones de instalación, ejecución y despliegue
- Variables de entorno (`.env`) para conectar con backend
- Rutas REST descritas y probadas en Postman

---

## 👤 Autor

- **Nombre**: Halloran  
- **Email**: hebi.tech@gmail.com  
- **GitHub**: [@Ha770ran](https://github.com/Ha770ran)

---

## ✅ Entrega completada

Sistema funcional, probado y desplegado en línea.
