# Vending Machine API Documentation

## **Authentication**

### **Register a New User**
- **Endpoint:** `POST /api/register`
- **Request Body:**
  ```json
  {
      "name": "John Doe",
      "email": "john@example.com",
      "password": "password",
      "password_confirmation": "password"
  }
  ```
- **Response:**
  ```json
  {
      "message": "User registered successfully"
  }
  ```

### **Login and Get a Token**
- **Endpoint:** `POST /api/login`
- **Request Body:**
  ```json
  {
      "email": "john@example.com",
      "password": "password"
  }
  ```
- **Response:**
  ```json
  {
      "token": "your_auth_token",
      "user": {
          "id": 1,
          "name": "John Doe",
          "email": "john@example.com"
      }
  }
  ```

### **Logout**
- **Endpoint:** `POST /api/logout`
- **Headers:**
  ```
  Authorization: Bearer your_auth_token
  ```
- **Response:**
  ```json
  {
      "message": "Logged out successfully"
  }
  ```

---

## **Product Management**

### **Get All Products** (Public Access)
- **Endpoint:** `GET /api/products`
- **Response:**
  ```json
  [
      {
          "id": 1,
          "name": "Coke",
          "price": 3.99,
          "quantity_available": 10
      }
  ]
  ```

### **Add a New Product** (Admin Only)
- **Endpoint:** `POST /api/products`
- **Headers:**
  ```
  Authorization: Bearer your_auth_token
  ```
- **Request Body:**
  ```json
  {
      "name": "Pepsi",
      "price": 6.88,
      "quantity_available": 20
  }
  ```
- **Response:**
  ```json
  {
      "message": "Product added successfully",
      "product": {
          "id": 2,
          "name": "Pepsi",
          "price": 6.88,
          "quantity_available": 20
      }
  }
  ```

### **Update a Product** (Admin Only)
- **Endpoint:** `PUT /api/products/{product_id}`
- **Headers:**
  ```
  Authorization: Bearer your_auth_token
  ```
- **Request Body:**
  ```json
  {
      "name": "Coke Zero",
      "price": 4.50,
      "quantity_available": 15
  }
  ```
- **Response:**
  ```json
  {
      "message": "Product updated successfully"
  }
  ```

### **Delete a Product** (Admin Only)
- **Endpoint:** `DELETE /api/products/{product_id}`
- **Headers:**
  ```
  Authorization: Bearer your_auth_token
  ```
- **Response:**
  ```json
  {
      "message": "Product deleted successfully"
  }
  ```

---

## **Purchases and Transactions**

### **Purchase a Product**
- **Endpoint:** `POST /api/purchase/{product_id}`
- **Headers:**
  ```
  Authorization: Bearer your_auth_token
  ```
- **Request Body:**
  ```json
  {
      "quantity": 2
  }
  ```
- **Response:**
  ```json
  {
      "message": "Purchase successful"
  }
  ```

### **View User Transactions**
- **Endpoint:** `GET /api/transactions`
- **Headers:**
  ```
  Authorization: Bearer your_auth_token
  ```
- **Response:**
  ```json
  [
      {
          "id": 1,
          "user_id": 1,
          "product": {
              "name": "Coke",
              "price": 3.99
          },
          "quantity": 2,
          "total_price": 7.98,
          "created_at": "2025-02-26T12:34:56"
      }
  ]
  ```

### **View All Transactions (Admin Only)**
- **Endpoint:** `GET /api/all-transactions`
- **Headers:**
  ```
  Authorization: Bearer your_auth_token
  ```
- **Response:**
  ```json
  [
      {
          "id": 1,
          "user": {
              "name": "John Doe"
          },
          "product": {
              "name": "Coke"
          },
          "quantity": 2,
          "total_price": 7.98,
          "created_at": "2025-02-26T12:34:56"
      }
  ]
  ```

