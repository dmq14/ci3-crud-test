# API Documentation

## Base URL
```
http://localhost/ci3-crud-test/index.php/api
```

> Replace `http://localhost/ci3-crud-test/` with your deployment URL if needed.

---

## Endpoints

### 1. Get all items
- **Method:** GET
- **Endpoint:** `/api/v1/items`
- **Description:** Retrieve all items from database
- **Request Body:** None
- **Response Example:**
```json
{
  "status": true,
  "data": [
    {"id": 1, "title": "Item 1", "description": "Description 1", "created_at": "2025-09-13 10:00:00", "updated_at": null},
    {"id": 2, "title": "Item 2", "description": "Description 2", "created_at": "2025-09-13 10:10:00", "updated_at": null}
  ]
}
```

---

### 2. Get item by ID
- **Method:** GET
- **Endpoint:** `/api/v1/items/{id}`
- **Description:** Retrieve a single item by its ID
- **Request Body:** None
- **Response Example:**
```json
{
  "status": true,
  "data": {"id": 1, "title": "Item 1", "description": "Description 1", "created_at": "2025-09-13 10:00:00", "updated_at": null}
}
```
- **Error Response Example (Item not found):**
```json
{
  "status": false,
  "message": "Item not found"
}
```

---

### 3. Create new item
- **Method:** POST
- **Endpoint:** `/api/v1/items`
- **Description:** Add a new item to the database
- **Request Body (JSON):**
```json
{
  "title": "New Item",
  "description": "New item description"
}
```
- **Response Example:**
```json
{
  "status": true,
  "message": "Item created",
  "id": 3
}
```
- **Error Response Example (Validation error):**
```json
{
  "status": false,
  "message": "Title is required"
}
```

---

### 4. Update an item
- **Method:** PUT
- **Endpoint:** `/api/v1/items/{id}`
- **Description:** Update an existing item by ID
- **Request Body (JSON):**
```json
{
  "title": "Updated Item",
  "description": "Updated description"
}
```
- **Response Example:**
```json
{
  "status": true,
  "message": "Item updated"
}
```
- **Error Response Examples:**
```json
{
  "status": false,
  "message": "Item not found"
}
```
```json
{
  "status": false,
  "message": "Title is required"
}
```

---

### 5. Delete an item
- **Method:** DELETE
- **Endpoint:** `/api/v1/items/{id}`
- **Description:** Delete an item by its ID
- **Request Body:** None
- **Response Example:**
```json
{
  "status": true,
  "message": "Item deleted"
}
```
- **Error Response Example (Item not found):**
```json
{
  "status": false,
  "message": "Item not found"
}
```

---

## Notes
- All endpoints return JSON.
- For POST and PUT, set `Content-Type: application/json` in request headers.
- Replace `{id}` with the actual item ID.
- API uses boolean `status` field (`true` for success, `false` for errors) matching the current `Items` controller logic.