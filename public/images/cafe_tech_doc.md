# Technical Documentation
# Cafe Management System

**Version:** 1.0.0  
**Last Updated:** December 2025  
**Tech Stack:** Laravel 12, React 18, Midtrans Sandbox

---

## Table of Contents

1. [System Architecture](#1-system-architecture)
2. [Design Specifications](#2-design-specifications)
3. [User Roles & Permissions](#3-user-roles--permissions)
4. [Application Features](#4-application-features)
5. [API Endpoints](#5-api-endpoints)
6. [Database Structure](#6-database-structure)
7. [Business Flows](#7-business-flows)
8. [Frontend Components](#8-frontend-components)
9. [Security & Authentication](#9-security--authentication)
10. [Deployment Guide](#10-deployment-guide)

---

## 1. System Architecture

### 1.1 Technology Stack

#### Backend
- **Framework:** Laravel 12
- **API Type:** RESTful API
- **Authentication:** Laravel Sanctum (Token-based)
- **Payment Gateway:** Midtrans Snap (Sandbox)
- **Database:** MySQL 8.0+
- **PDF Generation:** DomPDF / Snappy
- **Server Requirements:** PHP 8.2+, Composer

#### Frontend
- **Framework:** React 18.x
- **Build Tool:** Vite
- **UI Components:** 
  - **Radix UI** - Accessible component primitives
  - **shadcn/ui** - Re-usable component library
  - **Lucide React** - Modern icon library
  - **Recharts** - Charting library for dashboard
  - **Framer Motion** - Animation library
- **State Management:** React Context API + Hooks
- **HTTP Client:** Axios
- **Routing:** React Router v6
- **Form Handling:** React Hook Form + Zod validation
- **Styling:** Tailwind CSS 3.x
- **Date Handling:** date-fns

#### Additional Libraries
- **react-hot-toast** - Notifications
- **react-table** - Advanced table functionality
- **react-image-gallery** - Product image carousel
- **swiper** - Modern slider/carousel for promos
- **react-pdf** - PDF viewer

### 1.2 System Architecture Diagram

```
┌─────────────────────────────────────────────────────────┐
│                     Client Layer                        │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐ │
│  │   User Web   │  │  Admin Web   │  │    Mobile    │ │
│  │   (React)    │  │   (React)    │  │  (Optional)  │ │
│  └──────────────┘  └──────────────┘  └──────────────┘ │
└─────────────────────────────────────────────────────────┘
                          │
                          │ HTTPS/REST API
                          ▼
┌─────────────────────────────────────────────────────────┐
│                  Application Layer                      │
│  ┌──────────────────────────────────────────────────┐  │
│  │         Laravel 12 Backend                       │  │
│  │  ┌──────────┐  ┌──────────┐  ┌──────────┐      │  │
│  │  │   Auth   │  │   Menu   │  │  Payment │      │  │
│  │  │ Service  │  │ Service  │  │  Service │      │  │
│  │  └──────────┘  └──────────┘  └──────────┘      │  │
│  └──────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────┐
│                   Data Layer                            │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐ │
│  │    MySQL     │  │   Redis      │  │   Storage    │ │
│  │   Database   │  │   Cache      │  │   (Images)   │ │
│  └──────────────┘  └──────────────┘  └──────────────┘ │
└─────────────────────────────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────┐
│                External Services                        │
│  ┌──────────────┐  ┌──────────────┐                    │
│  │   Midtrans   │  │   Storage    │                    │
│  │   Payment    │  │   (S3/Local) │                    │
│  └──────────────┘  └──────────────┘                    │
└─────────────────────────────────────────────────────────┘
```

### 1.3 Application Flow

```
User Journey:
Browse → Select Menu → Add to Cart → Checkout → 
Payment (Midtrans) → Order Confirmation → Download Receipt

Admin Journey:
Login → Dashboard → Manage (Menus/Orders/Tables) → 
View Analytics → Generate Reports
```

---

## 2. Design Specifications

### 2.1 Design System

#### Color Palette
```css
/* Primary Colors */
--primary-50: #fdf8f6;
--primary-100: #f2e8e5;
--primary-200: #eaddd7;
--primary-300: #e0cec7;
--primary-400: #d2bab0;
--primary-500: #bfa094;
--primary-600: #a18072;
--primary-700: #977669;
--primary-800: #846358;
--primary-900: #43302b;

/* Neutral Colors */
--neutral-50: #fafafa;
--neutral-100: #f5f5f5;
--neutral-200: #e5e5e5;
--neutral-300: #d4d4d4;
--neutral-400: #a3a3a3;
--neutral-500: #737373;
--neutral-600: #525252;
--neutral-700: #404040;
--neutral-800: #262626;
--neutral-900: #171717;

/* Semantic Colors */
--success: #10b981;
--warning: #f59e0b;
--error: #ef4444;
--info: #3b82f6;
```

#### Typography
```css
/* Font Family */
font-family: 'Inter', system-ui, -apple-system, sans-serif;

/* Font Sizes */
--text-xs: 0.75rem;    /* 12px */
--text-sm: 0.875rem;   /* 14px */
--text-base: 1rem;     /* 16px */
--text-lg: 1.125rem;   /* 18px */
--text-xl: 1.25rem;    /* 20px */
--text-2xl: 1.5rem;    /* 24px */
--text-3xl: 1.875rem;  /* 30px */
--text-4xl: 2.25rem;   /* 36px */

/* Font Weights */
--font-normal: 400;
--font-medium: 500;
--font-semibold: 600;
--font-bold: 700;
```

#### Spacing System
```css
/* Based on 4px baseline */
--spacing-1: 0.25rem;   /* 4px */
--spacing-2: 0.5rem;    /* 8px */
--spacing-3: 0.75rem;   /* 12px */
--spacing-4: 1rem;      /* 16px */
--spacing-6: 1.5rem;    /* 24px */
--spacing-8: 2rem;      /* 32px */
--spacing-12: 3rem;     /* 48px */
--spacing-16: 4rem;     /* 64px */
```

#### Border Radius
```css
--radius-sm: 0.25rem;   /* 4px */
--radius-md: 0.5rem;    /* 8px */
--radius-lg: 0.75rem;   /* 12px */
--radius-xl: 1rem;      /* 16px */
--radius-full: 9999px;  /* Fully rounded */
```

### 2.2 UI Components Style Guide

#### Cards
- Light shadow: `box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1)`
- Hover effect: Scale 1.02 with transition
- Border radius: 12px
- Padding: 24px

#### Buttons
```
Primary: Coffee brown background, white text
Secondary: White background, coffee brown border
Hover: Slightly darker shade with transition
Disabled: Gray background, reduced opacity
```

#### Forms
- Input height: 40px
- Border: 1px solid neutral-300
- Focus: Primary color border with ring
- Error state: Red border with error message below

#### Animations
```javascript
// Framer Motion Variants
const fadeIn = {
  hidden: { opacity: 0, y: 20 },
  visible: { opacity: 1, y: 0, transition: { duration: 0.5 } }
};

const slideIn = {
  hidden: { x: -100, opacity: 0 },
  visible: { x: 0, opacity: 1, transition: { duration: 0.4 } }
};

const staggerChildren = {
  visible: { transition: { staggerChildren: 0.1 } }
};
```

### 2.3 Responsive Breakpoints

```css
/* Mobile First Approach */
--screen-sm: 640px;   /* Mobile landscape */
--screen-md: 768px;   /* Tablet */
--screen-lg: 1024px;  /* Desktop */
--screen-xl: 1280px;  /* Large desktop */
--screen-2xl: 1536px; /* Extra large */
```

---

## 3. User Roles & Permissions

### 3.1 User (Customer)

**Capabilities:**
- ✅ View landing page with featured menus and promos
- ✅ Browse menu catalog with categories
- ✅ Read coffee education articles
- ✅ Add items to cart
- ✅ Checkout (Dine-in or Take-away)
- ✅ Select table (for Dine-in orders)
- ✅ Make payment via Midtrans
- ✅ Download PDF receipt
- ✅ Make table reservations
- ✅ View order history
- ✅ Update profile information

**Restrictions:**
- ❌ Cannot access admin dashboard
- ❌ Cannot manage menu items
- ❌ Cannot view other users' orders
- ❌ Cannot modify completed orders

### 3.2 Admin/Owner

**Capabilities:**
- ✅ Full access to admin dashboard
- ✅ View sales analytics and charts
- ✅ Manage menus (CRUD operations)
- ✅ Manage categories
- ✅ Manage promotions
- ✅ Manage tables and capacity
- ✅ View and update order status
- ✅ View and manage reservations
- ✅ Manage inventory/stock
- ✅ Generate and print receipts
- ✅ View transaction reports
- ✅ Manage user accounts

**Dashboard Metrics:**
- Daily/Monthly revenue
- Total orders
- Popular menu items
- Table occupancy rate
- Stock alerts
- Pending reservations

---

## 4. Application Features

### 4.1 Customer Features

#### 4.1.1 Landing Page
**Components:**
- Hero section with high-resolution coffee imagery
- Animated promo slider (Swiper)
- Featured menu grid
- Coffee education preview cards
- Call-to-action buttons
- Testimonials section
- Footer with contact info

**Implementation:**
```jsx
import { Swiper, SwiperSlide } from 'swiper/react';
import { Autoplay, Pagination } from 'swiper/modules';
import { motion } from 'framer-motion';

<Swiper
  modules={[Autoplay, Pagination]}
  autoplay={{ delay: 5000 }}
  pagination={{ clickable: true }}
>
  {promos.map(promo => (
    <SwiperSlide key={promo.id}>
      <PromoCard {...promo} />
    </SwiperSlide>
  ))}
</Swiper>
```

#### 4.1.2 Menu Catalog
**Features:**
- Grid layout (responsive: 1-2-3-4 columns)
- Category filter with tabs
- Search functionality
- Sort options (price, popularity, name)
- Quick view modal
- Add to cart button
- Stock indicator
- Price display
- Image lazy loading

**Card Structure:**
```jsx
<Card>
  <Image src={menu.image} alt={menu.name} />
  <Badge>{menu.category}</Badge>
  <Title>{menu.name}</Title>
  <Description>{menu.description}</Description>
  <PriceTag>Rp {menu.price.toLocaleString()}</PriceTag>
  <StockIndicator stock={menu.stock} />
  <AddToCartButton />
</Card>
```

#### 4.1.3 Menu Detail Modal
**Content:**
- Large product image
- Full description
- Ingredients/specifications
- Nutritional info (optional)
- Size options (if applicable)
- Quantity selector
- Add to cart button
- Related products

#### 4.1.4 Shopping Cart
**Features:**
- Real-time quantity update
- Remove item functionality
- Subtotal calculation
- Item thumbnail preview
- Empty cart state
- Continue shopping link
- Proceed to checkout button

**Implementation:**
```jsx
import { useCart } from '@/contexts/CartContext';

const Cart = () => {
  const { items, updateQty, removeItem, total } = useCart();
  
  return (
    <Sheet>
      {items.map(item => (
        <CartItem 
          key={item.id}
          {...item}
          onUpdateQty={updateQty}
          onRemove={removeItem}
        />
      ))}
      <Separator />
      <Total amount={total} />
      <CheckoutButton />
    </Sheet>
  );
};
```

#### 4.1.5 Checkout Process
**Steps (Stepper Component):**

**Step 1: Order Type Selection**
- Dine-in
- Take-away

**Step 2: Table Selection (if Dine-in)**
- Display available tables
- Show capacity
- Real-time availability status
- Visual table map (optional)

**Step 3: Order Review**
- Item summary
- Total amount
- Special notes/requests field

**Step 4: Payment**
- Midtrans Snap integration
- Payment method selection
- Security information

**Implementation:**
```jsx
import { Steps } from '@/components/ui/steps';

const steps = [
  { title: 'Order Type', icon: ShoppingBag },
  { title: 'Table Selection', icon: Armchair },
  { title: 'Review', icon: ClipboardList },
  { title: 'Payment', icon: CreditCard }
];

<Steps current={currentStep} items={steps} />
```

#### 4.1.6 Payment Integration (Midtrans Snap)
**Flow:**
1. Request payment token from backend
2. Load Midtrans Snap script
3. Display payment modal
4. Handle payment callback
5. Update order status
6. Reduce stock automatically
7. Generate PDF receipt

**Code Example:**
```jsx
const handlePayment = async (orderId) => {
  try {
    const { data } = await axios.post('/api/midtrans/token', {
      order_id: orderId
    });
    
    window.snap.pay(data.token, {
      onSuccess: (result) => {
        handlePaymentSuccess(result);
      },
      onPending: (result) => {
        handlePaymentPending(result);
      },
      onError: (result) => {
        handlePaymentError(result);
      }
    });
  } catch (error) {
    toast.error('Payment initiation failed');
  }
};
```

#### 4.1.7 Coffee Education
**Features:**
- Card-based layout
- Categories (brewing methods, bean types, origins)
- Rich text content
- Images and videos
- Accordion for detailed info
- Related articles
- Social sharing buttons

**Component:**
```jsx
import { Accordion } from '@/components/ui/accordion';

<Accordion type="single" collapsible>
  {coffeeInfo.map(info => (
    <AccordionItem key={info.id} value={info.id}>
      <AccordionTrigger>{info.title}</AccordionTrigger>
      <AccordionContent>
        <img src={info.image} alt={info.title} />
        <div dangerouslySetInnerHTML={{ __html: info.content }} />
      </AccordionContent>
    </AccordionItem>
  ))}
</Accordion>
```

#### 4.1.8 Table Reservation
**Form Fields:**
- Full name (required)
- Phone number (required)
- Email (optional)
- Date (date picker)
- Time (time picker)
- Number of people (required)
- Table selection (based on capacity)
- Special notes (textarea)

**Validation:**
- Future date only
- Available time slots
- Table capacity check
- Phone number format

**Implementation:**
```jsx
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import * as z from 'zod';

const reservationSchema = z.object({
  name: z.string().min(3),
  phone: z.string().regex(/^[0-9]{10,13}$/),
  date: z.date().min(new Date()),
  time: z.string(),
  people_count: z.number().min(1).max(20),
  table_id: z.string(),
  note: z.string().optional()
});

const { register, handleSubmit, formState: { errors } } = useForm({
  resolver: zodResolver(reservationSchema)
});
```

### 4.2 Admin Features

#### 4.2.1 Dashboard
**Components:**
- KPI Cards (Total Revenue, Orders, Customers, Tables)
- Line Chart (Daily/Monthly revenue trend)
- Bar Chart (Top selling products)
- Pie Chart (Order type distribution)
- Recent orders table
- Low stock alerts
- Pending reservations widget
- Quick actions panel

**Chart Implementation:**
```jsx
import { LineChart, Line, BarChart, Bar, PieChart, Pie, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer } from 'recharts';

<ResponsiveContainer width="100%" height={300}>
  <LineChart data={salesData}>
    <CartesianGrid strokeDasharray="3 3" />
    <XAxis dataKey="date" />
    <YAxis />
    <Tooltip />
    <Legend />
    <Line type="monotone" dataKey="revenue" stroke="#8b4513" />
  </LineChart>
</ResponsiveContainer>
```

#### 4.2.2 Menu Management
**Features:**
- Data table with pagination
- Search and filter
- Sorting by column
- Bulk actions (delete, update stock)
- Quick edit inline
- Image upload with preview
- Category assignment
- Stock management
- Price history (optional)

**Table Component:**
```jsx
import { useReactTable, getCoreRowModel, getPaginationRowModel, getSortedRowModel, getFilteredRowModel } from '@tanstack/react-table';

const columns = [
  { accessorKey: 'image', header: 'Image', cell: ImageCell },
  { accessorKey: 'name', header: 'Name', enableSorting: true },
  { accessorKey: 'category', header: 'Category' },
  { accessorKey: 'price', header: 'Price', enableSorting: true },
  { accessorKey: 'stock', header: 'Stock', cell: StockCell },
  { accessorKey: 'actions', header: 'Actions', cell: ActionsCell }
];

const table = useReactTable({
  data: menus,
  columns,
  getCoreRowModel: getCoreRowModel(),
  getPaginationRowModel: getPaginationRowModel(),
  getSortedRowModel: getSortedRowModel(),
  getFilteredRowModel: getFilteredRowModel()
});
```

#### 4.2.3 Order Management
**Features:**
- Real-time order updates
- Status badges (Pending, Processing, Completed, Cancelled)
- Filter by status, date, order type
- Order detail view
- Status update dropdown
- Print receipt button
- Customer information display
- Payment status indicator
- Refund functionality (if needed)

**Status Badge Component:**
```jsx
const statusColors = {
  pending: 'bg-yellow-100 text-yellow-800',
  processing: 'bg-blue-100 text-blue-800',
  completed: 'bg-green-100 text-green-800',
  cancelled: 'bg-red-100 text-red-800'
};

<Badge className={statusColors[order.status]}>
  {order.status.toUpperCase()}
</Badge>
```

#### 4.2.4 Promotion Management
**Form Fields:**
- Title
- Description
- Banner image
- Discount type (Percentage/Fixed Amount)
- Discount value
- Start date
- End date
- Applicable menu items (multi-select)
- Active status toggle

**Validation:**
- End date must be after start date
- Discount value validation based on type
- Image size/format validation

#### 4.2.5 Table Management
**Features:**
- Visual table layout (optional grid view)
- Add/Edit/Delete tables
- Table number assignment
- Capacity setting
- Status (Available, Occupied, Reserved)
- QR code generation (optional)
- Merge tables functionality (optional)

**Table Card:**
```jsx
<Card className={`border-2 ${table.status === 'available' ? 'border-green-500' : 'border-red-500'}`}>
  <TableNumber>{table.table_number}</TableNumber>
  <Capacity>{table.capacity} seats</Capacity>
  <StatusBadge status={table.status} />
  <ActionButtons />
</Card>
```

#### 4.2.6 Reservation Management
**Features:**
- Calendar view
- List view with filters
- Status update (Pending, Confirmed, Cancelled, Completed)
- Customer contact information
- Table assignment
- SMS/Email confirmation (optional)
- Waitlist management
- No-show tracking

**Calendar Integration:**
```jsx
import { Calendar } from '@/components/ui/calendar';
import { format } from 'date-fns';

<Calendar
  mode="single"
  selected={selectedDate}
  onSelect={setSelectedDate}
  modifiers={{ reserved: reservedDates }}
  modifiersClassNames={{ reserved: 'bg-primary-100' }}
/>
```

#### 4.2.7 Stock Management
**Features:**
- Low stock alerts (threshold configurable)
- Stock history log
- Bulk update
- Stock adjustment with reason
- Export to Excel
- Reorder point setting
- Supplier management (optional)

#### 4.2.8 Reports & Analytics
**Available Reports:**
- Sales report (daily/weekly/monthly)
- Product performance
- Customer analytics
- Table utilization
- Payment method breakdown
- Peak hours analysis
- Export to PDF/Excel

---

## 5. API Endpoints

### 5.1 Authentication

#### Login
```http
POST /api/auth/login
Content-Type: application/json

Request Body:
{
  "email": "user@example.com",
  "password": "password123"
}

Response: 200 OK
{
  "token": "1|laravel_sanctum_token_here",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "user@example.com",
    "role": "user"
  }
}
```

#### Register
```http
POST /api/auth/register
Content-Type: application/json

Request Body:
{
  "name": "John Doe",
  "email": "user@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}

Response: 201 Created
{
  "token": "1|laravel_sanctum_token_here",
  "user": { ... }
}
```

#### Logout
```http
POST /api/auth/logout
Authorization: Bearer {token}

Response: 200 OK
{
  "message": "Logged out successfully"
}
```

#### Get Current User
```http
GET /api/auth/me
Authorization: Bearer {token}

Response: 200 OK
{
  "id": 1,
  "name": "John Doe",
  "email": "user@example.com",
  "role": "user"
}
```

### 5.2 Menu Management

#### Get All Menus
```http
GET /api/menus
Query Parameters:
  - category_id (optional)
  - search (optional)
  - sort_by (optional): price|name|popularity
  - order (optional): asc|desc
  - page (optional)
  - per_page (optional)

Response: 200 OK
{
  "data": [
    {
      "id": 1,
      "name": "Espresso",
      "description": "Strong coffee shot",
      "price": 25000,
      "category_id": 1,
      "category": {
        "id": 1,
        "name": "Coffee"
      },
      "image": "/storage/menus/espresso.jpg",
      "stock": 100
    }
  ],
  "meta": {
    "current_page": 1,
    "total": 50,
    "per_page": 12
  }
}
```

#### Get Single Menu
```http
GET /api/menus/{id}

Response: 200 OK
{
  "id": 1,
  "name": "Espresso",
  ...
}
```

#### Create Menu (Admin)
```http
POST /api/menus
Authorization: Bearer {admin_token}
Content-Type: multipart/form-data

Request Body:
{
  "name": "Cappuccino",
  "description": "Espresso with steamed milk",
  "price": 35000,
  "category_id": 1,
  "image": File,
  "stock": 100
}

Response: 201 Created
{
  "id": 2,
  "name": "Cappuccino",
  ...
}
```

#### Update Menu (Admin)
```http
PUT /api/menus/{id}
Authorization: Bearer {admin_token}
Content-Type: application/json

Request Body:
{
  "name": "Cappuccino Grande",
  "price": 40000,
  "stock": 150
}

Response: 200 OK
{
  "id": 2,
  "name": "Cappuccino Grande",
  ...
}
```

#### Delete Menu (Admin)
```http
DELETE /api/menus/{id}
Authorization: Bearer {admin_token}

Response: 200 OK
{
  "message": "Menu deleted successfully"
}
```

### 5.3 Categories

#### Get All Categories
```http
GET /api/categories

Response: 200 OK
{
  "data": [
    {
      "id": 1,
      "name": "Coffee",
      "menus_count": 15
    }
  ]
}
```

#### Create Category (Admin)
```http
POST /api/categories
Authorization: Bearer {admin_token}

Request Body:
{
  "name": "Desserts"
}

Response: 201 Created
```

#### Update Category (Admin)
```http
PUT /api/categories/{id}
Authorization: Bearer {admin_token}

Request Body:
{
  "name": "Sweet Desserts"
}

Response: 200 OK
```

#### Delete Category (Admin)
```http
DELETE /api/categories/{id}
Authorization: Bearer {admin_token}

Response: 200 OK
```

### 5.4 Promotions

#### Get All Promos
```http
GET /api/promos
Query Parameters:
  - active (optional): true|false

Response: 200 OK
{
  "data": [
    {
      "id": 1,
      "title": "Weekend Special",
      "description": "Get 20% off all drinks",
      "start_date": "2025-12-14",
      "end_date": "2025-12-15",
      "discount_type": "percentage",
      "discount_value": 20,
      "image": "/storage/promos/weekend.jpg"
    }
  ]
}
```

#### Create Promo (Admin)
```http
POST /api/promos
Authorization: Bearer {admin_token}

Request Body:
{
  "title": "Christmas Sale",
  "description": "Special discount for Christmas",
  "start_date": "2025-12-24",
  "end_date": "2025-12-26",
  "discount_type": "percentage",
  "discount_value": 15,
  "image": File
}

Response: 201 Created
```

#### Update Promo (Admin)
```http
PUT /api/promos/{id}
Authorization: Bearer {admin_token}

Response: 200 OK
```

#### Delete Promo (Admin)
```http
DELETE /api/promos/{id}
Authorization: Bearer {admin_token}

Response: 200 OK
```

### 5.5 Orders

#### Create Order
```http
POST /api/orders
Authorization: Bearer {token}

Request Body:
{
  "items": [
    {
      "menu_id": 1,
      "quantity": 2,
      "price": 25000
    }
  ],
  "order_type": "dine_in",
  "table_id": 5,
  "note": "Extra sugar"
}

Response: 201 Created
{
  "id": 100,
  "total_price": 50000,
  "status": "pending",
  "payment_status": "pending",
  "order_type": "dine_in",
  "table_id": 5,
  "midtrans_order_id": "ORDER-100-1234567890"
}
```

#### Get Orders
```http
GET /api/orders
Authorization: Bearer {token}
Query Parameters:
  - status (optional)
  - order_type (optional)
  - date_from (optional)
  - date_to (optional)
  - page (optional)

Response: 200 OK
{
  "data": [ ... ],
  "meta": { ... }
}
```

#### Get Single Order
```http
GET /api/orders/{id}
Authorization: Bearer {token}

Response: 200 OK
{
  "id": 100,
  "user": { ... },
  "items": [
    {
      "menu": { ... },
      "quantity": 2,
      "price": 25000,
      "subtotal": 50000
    }
  ],
  "total_price": 50000,
  "status": "completed",
  "payment_status": "paid",
  "table": { ... },
  "pdf_path": "/storage/receipts/ORDER-100.pdf"
}
```

#### Update Order Status (Admin)
```http
PUT /api/orders/{id}/status
Authorization: Bearer {admin_token}

Request Body:
{
  "status": "processing"
}

Response: 200 OK
{
  "id": 100,
  "status": "processing",
  "updated_at": "2025-12-13 10:30:00"
}
```

#### Download Receipt
```http
GET /api/orders/{id}/receipt
Authorization: Bearer {token}

Response: 200 OK
Content-Type: application/pdf
```

### 5.6 Midtrans Payment

#### Request Payment Token
```http
POST /api/midtrans/token
Authorization: Bearer {token}

Request Body:
{
  "order_id": 100
}

Response: 200 OK
{
  "token": "midtrans_snap_token_here",
  "redirect_url": "https://app.sandbox.midtrans.com/snap/v2/..."
}
```

#### Payment Callback (Webhook)
```http
POST /api/midtrans/callback
Content-Type: application/json

Request Body:
{
  "order_id": "ORDER-100-1234567890",
  "transaction_status": "settlement",
  "payment_type": "bank_transfer",
  "gross_amount": "50000.00",
  "signature_key": "..."
}

Response: 200 OK
{
  "message": "Payment processed successfully"
}
```

### 5.7 Coffee Information

#### Get All Coffee Info
```http
GET /api/coffee-info
Query Parameters:
  - category (optional)
  - search (optional)

Response: 200 OK
{
  "data": [
    {
      "id": 1,
      "title": "How to Brew Perfect Espresso",
      "content": "<p>Full HTML content...</p>",
      "image": "/storage/coffee-info/espresso.jpg",
      "category": "Brewing Methods",
      "created_at": "2025-12-01 10:00:00"
    }
  ]
}
```

#### Get Single Coffee Info
```http
GET /api/coffee-info/{id}

Response: 200 OK
```

#### Create Coffee Info (Admin)
```http
POST /api/coffee-info
Authorization: Bearer {admin_token}

Request Body:
{
  "title": "Understanding Coffee Origins",
  "content": "<p>...</p>",
  "image": File,
  "category": "Coffee Basics"
}

Response: 201 Created
```

#### Update Coffee Info (Admin)
```http
PUT /api/coffee-info/{id}
Authorization: Bearer {admin_token}

Response: 200 OK
```

#### Delete Coffee Info (Admin)
```http
DELETE /api/coffee-info/{id}
Authorization: Bearer {admin_token}

Response: 200 OK
```

### 5.8 Reservations

#### Create Reservation
```http
POST /api/reservations
Authorization: Bearer {token}

Request Body:
{
  "name": "John Doe",
  "phone": "081234567890",
  "date": "2025-12-20",
  "time": "18:00",
  "people_count": 4,
  "table_id": 5,
  "note": "Window seat preferred"
}

Response: 201 Created
{
  "id": 10,
  "name": "John Doe",
  "phone": "081234567890",
  "date": "2025-12-20",
  "time": "18:00",
  "people_count": 4,
  "table": {
    "id": 5,
    "table_number": "T-05",
    "capacity": 6
  },
  "status": "pending",
  "note": "Window seat preferred"
}
```

#### Get Reservations
```http
GET /api/reservations
Authorization: Bearer {token}
Query Parameters:
  - status (optional): pending|confirmed|cancelled|completed
  - date (optional)
  - page (optional)

Response: 200 OK
{
  "data": [ ... ],
  "meta": { ... }
}
```

#### Get Single Reservation
```http
GET /api/reservations/{id}
Authorization: Bearer {token}

Response: 200 OK
```

#### Update Reservation Status (Admin)
```http
PUT /api/reservations/{id}/status
Authorization: Bearer {admin_token}

Request Body:
{
  "status": "confirmed"
}

Response: 200 OK
{
  "id": 10,
  "status": "confirmed",
  "updated_at": "2025-12-13 10:30:00"
}
```

#### Cancel Reservation
```http
DELETE /api/reservations/{id}
Authorization: Bearer {token}

Response: 200 OK
{
  "message": "Reservation cancelled successfully"
}
```

### 5.9 Tables

#### Get All Tables
```http
GET /api/tables
Query Parameters:
  - status (optional): available|occupied|reserved
  - capacity_min (optional)
  - capacity_max (optional)

Response: 200 OK
{
  "data": [
    {
      "id": 1,
      "table_number": "T-01",
      "capacity": 4,
      "status": "available",
      "location": "Main Hall"
    }
  ]
}
```

#### Get Available Tables
```http
GET /api/tables/available
Query Parameters:
  - date (required)
  - time (required)
  - people_count (required)

Response: 200 OK
{
  "data": [
    {
      "id": 5,
      "table_number": "T-05",
      "capacity": 6,
      "location": "Window Side"
    }
  ]
}
```

#### Create Table (Admin)
```http
POST /api/tables
Authorization: Bearer {admin_token}

Request Body:
{
  "table_number": "T-10",
  "capacity": 4,
  "location": "Outdoor"
}

Response: 201 Created
```

#### Update Table (Admin)
```http
PUT /api/tables/{id}
Authorization: Bearer {admin_token}

Request Body:
{
  "capacity": 6,
  "status": "occupied"
}

Response: 200 OK
```

#### Delete Table (Admin)
```http
DELETE /api/tables/{id}
Authorization: Bearer {admin_token}

Response: 200 OK
```

### 5.10 Dashboard & Analytics (Admin)

#### Get Dashboard Stats
```http
GET /api/admin/dashboard
Authorization: Bearer {admin_token}
Query Parameters:
  - period (optional): today|week|month|year

Response: 200 OK
{
  "revenue": {
    "total": 15000000,
    "growth": 12.5,
    "chart_data": [
      { "date": "2025-12-01", "amount": 500000 },
      { "date": "2025-12-02", "amount": 750000 }
    ]
  },
  "orders": {
    "total": 250,
    "pending": 5,
    "processing": 3,
    "completed": 240,
    "cancelled": 2
  },
  "popular_items": [
    {
      "menu_id": 1,
      "name": "Espresso",
      "total_sold": 150,
      "revenue": 3750000
    }
  ],
  "table_occupancy": {
    "total_tables": 20,
    "occupied": 8,
    "available": 10,
    "reserved": 2,
    "percentage": 40
  },
  "low_stock_items": [
    {
      "id": 5,
      "name": "Latte",
      "stock": 10,
      "threshold": 20
    }
  ],
  "recent_orders": [ ... ],
  "pending_reservations": [ ... ]
}
```

#### Get Sales Report
```http
GET /api/admin/reports/sales
Authorization: Bearer {admin_token}
Query Parameters:
  - start_date (required)
  - end_date (required)
  - group_by (optional): day|week|month

Response: 200 OK
{
  "data": [
    {
      "period": "2025-12-01",
      "orders_count": 15,
      "revenue": 750000,
      "average_order_value": 50000
    }
  ],
  "summary": {
    "total_revenue": 15000000,
    "total_orders": 250,
    "average_order_value": 60000
  }
}
```

---

## 6. Database Structure

### 6.1 Entity Relationship Diagram

```
┌─────────────┐         ┌──────────────┐         ┌─────────────┐
│    Users    │────────<│    Orders    │>────────│    Tables   │
└─────────────┘         └──────────────┘         └─────────────┘
                               │
                               │
                        ┌──────▼──────────┐
                        │   OrderItems    │
                        └──────┬──────────┘
                               │
                        ┌──────▼──────┐
                        │    Menus    │
                        └──────┬──────┘
                               │
                        ┌──────▼───────┐
                        │  Categories  │
                        └──────────────┘

┌─────────────┐         ┌──────────────┐
│   Promos    │         │ CoffeeInfo   │
└─────────────┘         └──────────────┘

┌─────────────┐         ┌──────────────┐
│Reservations │────────<│    Tables    │
└─────────────┘         └──────────────┘
```

### 6.2 Table Schemas

#### Users Table
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    phone VARCHAR(20) NULL,
    avatar VARCHAR(255) NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_email (email),
    INDEX idx_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

#### Categories Table
```sql
CREATE TABLE categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT NULL,
    image VARCHAR(255) NULL,
    display_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_slug (slug),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

#### Menus Table
```sql
CREATE TABLE menus (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description TEXT NULL,
    price DECIMAL(10, 2) NOT NULL,
    category_id BIGINT UNSIGNED NOT NULL,
    image VARCHAR(255) NULL,
    stock INT DEFAULT 0,
    stock_threshold INT DEFAULT 10,
    is_available BOOLEAN DEFAULT TRUE,
    is_featured BOOLEAN DEFAULT FALSE,
    total_sold INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
    INDEX idx_category (category_id),
    INDEX idx_available (is_available),
    INDEX idx_featured (is_featured),
    INDEX idx_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

#### Promos Table
```sql
CREATE TABLE promos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    image VARCHAR(255) NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    discount_type ENUM('percentage', 'fixed') NOT NULL,
    discount_value DECIMAL(10, 2) NOT NULL,
    min_purchase DECIMAL(10, 2) DEFAULT 0,
    max_discount DECIMAL(10, 2) NULL,
    is_active BOOLEAN DEFAULT TRUE,
    usage_limit INT NULL,
    usage_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_dates (start_date, end_date),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

#### Tables Table
```sql
CREATE TABLE tables (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    table_number VARCHAR(50) UNIQUE NOT NULL,
    capacity INT NOT NULL,
    status ENUM('available', 'occupied', 'reserved', 'maintenance') DEFAULT 'available',
    location VARCHAR(100) NULL,
    qr_code VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_status (status),
    INDEX idx_table_number (table_number)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

#### Orders Table
```sql
CREATE TABLE orders (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    order_number VARCHAR(50) UNIQUE NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    discount_amount DECIMAL(10, 2) DEFAULT 0,
    final_price DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending',
    payment_status ENUM('pending', 'paid', 'failed', 'refunded') DEFAULT 'pending',
    payment_method VARCHAR(50) NULL,
    order_type ENUM('dine_in', 'take_away') NOT NULL,
    table_id BIGINT UNSIGNED NULL,
    midtrans_order_id VARCHAR(255) NULL,
    midtrans_transaction_id VARCHAR(255) NULL,
    pdf_path VARCHAR(255) NULL,
    note TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (table_id) REFERENCES tables(id) ON DELETE SET NULL,
    INDEX idx_user (user_id),
    INDEX idx_status (status),
    INDEX idx_payment_status (payment_status),
    INDEX idx_order_number (order_number),
    INDEX idx_midtrans (midtrans_order_id),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

#### Order Items Table
```sql
CREATE TABLE order_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id BIGINT UNSIGNED NOT NULL,
    menu_id BIGINT UNSIGNED NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    note TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_id) REFERENCES menus(id) ON DELETE CASCADE,
    INDEX idx_order (order_id),
    INDEX idx_menu (menu_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

#### Coffee Info Table
```sql
CREATE TABLE coffee_info (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content LONGTEXT NOT NULL,
    image VARCHAR(255) NULL,
    category VARCHAR(100) NULL,
    tags JSON NULL,
    views_count INT DEFAULT 0,
    is_published BOOLEAN DEFAULT TRUE,
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_slug (slug),
    INDEX idx_category (category),
    INDEX idx_published (is_published)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

#### Reservations Table
```sql
CREATE TABLE reservations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    people_count INT NOT NULL,
    table_id BIGINT UNSIGNED NULL,
    status ENUM('pending', 'confirmed', 'cancelled', 'completed', 'no_show') DEFAULT 'pending',
    note TEXT NULL,
    cancelled_at TIMESTAMP NULL,
    cancellation_reason TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (table_id) REFERENCES tables(id) ON DELETE SET NULL,
    INDEX idx_user (user_id),
    INDEX idx_table (table_id),
    INDEX idx_date (date),
    INDEX idx_status (status),
    INDEX idx_datetime (date, time)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

#### Stock History Table (Optional)
```sql
CREATE TABLE stock_history (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    menu_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NULL,
    quantity_before INT NOT NULL,
    quantity_after INT NOT NULL,
    quantity_change INT NOT NULL,
    type ENUM('addition', 'reduction', 'adjustment', 'order') NOT NULL,
    reference_id BIGINT UNSIGNED NULL,
    reference_type VARCHAR(50) NULL,
    note TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (menu_id) REFERENCES menus(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_menu (menu_id),
    INDEX idx_type (type),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

## 7. Business Flows

### 7.1 Order Flow (Complete Journey)

```
┌──────────────────────────────────────────────────────────┐
│                    ORDER FLOW DIAGRAM                    │
└──────────────────────────────────────────────────────────┘

[User] Browse Menu
    │
    ├─> Select Items
    │
    ├─> Add to Cart (Real-time update)
    │
    ├─> View Cart
    │
    └─> Proceed to Checkout
         │
         ├─> Step 1: Select Order Type
         │    ├─> Dine-in (requires table selection)
         │    └─> Take-away
         │
         ├─> Step 2: Table Selection (if Dine-in)
         │    ├─> Check table availability
         │    ├─> Select table
         │    └─> Update table status to 'reserved'
         │
         ├─> Step 3: Review Order
         │    ├─> View items summary
         │    ├─> Add special notes
         │    └─> Confirm total price
         │
         └─> Step 4: Payment
              │
              ├─> Create order (status: pending)
              │
              ├─> Request Midtrans payment token
              │
              ├─> Display Midtrans Snap modal
              │
              ├─> User completes payment
              │
              └─> Midtrans sends callback
                   │
                   ├─> Verify signature
                   │
                   ├─> Update order status based on payment:
                   │    ├─> Success: status='processing', payment_status='paid'
                   │    ├─> Pending: status='pending', payment_status='pending'
                   │    └─> Failed: status='cancelled', payment_status='failed'
                   │
                   ├─> Reduce stock for each menu item
                   │
                   ├─> Update table status to 'occupied' (if dine-in)
                   │
                   ├─> Generate PDF receipt
                   │
                   ├─> Send confirmation email (optional)
                   │
                   └─> Redirect to order confirmation page
                        │
                        └─> User can download PDF receipt

[Admin] Order Management
    │
    ├─> View all orders in dashboard
    │
    ├─> Filter by status/date/type
    │
    ├─> Update order status:
    │    ├─> pending → processing (preparing order)
    │    ├─> processing → completed (order ready/delivered)
    │    └─> any → cancelled (with reason)
    │
    ├─> Print receipt
    │
    └─> When order completed:
         ├─> Update table status to 'available' (if dine-in)
         └─> Update sales analytics
```

### 7.2 Reservation Flow

```
┌──────────────────────────────────────────────────────────┐
│                  RESERVATION FLOW DIAGRAM                │
└──────────────────────────────────────────────────────────┘

[User] Navigate to Reservation Page
    │
    ├─> Fill reservation form:
    │    ├─> Name (required)
    │    ├─> Phone (required)
    │    ├─> Email (optional)
    │    ├─> Date (date picker, future dates only)
    │    ├─> Time (time picker, business hours only)
    │    ├─> Number of people (required)
    │    └─> Special notes (optional)
    │
    ├─> Frontend validation
    │
    ├─> Check available tables:
    │    ├─> Filter by capacity >= people_count
    │    ├─> Filter by availability on selected date/time
    │    └─> Display available tables
    │
    ├─> Select preferred table
    │
    ├─> Submit reservation
    │
    └─> System creates reservation (status: pending)
         │
         ├─> Update table status to 'reserved'
         │
         ├─> Send confirmation to user
         │
         └─> Notify admin dashboard

[Admin] Reservation Management
    │
    ├─> View all reservations
    │
    ├─> View in calendar or list format
    │
    ├─> Filter by status/date
    │
    ├─> Review pending reservations
    │
    ├─> Update reservation status:
    │    ├─> pending → confirmed (approved)
    │    │    ├─> Send confirmation SMS/email to customer
    │    │    └─> Keep table reserved
    │    │
    │    ├─> pending/confirmed → cancelled (rejected/customer cancellation)
    │    │    ├─> Update table status to 'available'
    │    │    ├─> Send cancellation notification
    │    │    └─> Record cancellation reason
    │    │
    │    ├─> confirmed → completed (customer arrived and seated)
    │    │    └─> Update table status to 'occupied'
    │    │
    │    └─> confirmed → no_show (customer didn't arrive)
    │         └─> Update table status to 'available'
    │
    └─> View reservation history and analytics

[System] Automated Tasks (Optional)
    │
    ├─> Send reminder 1 day before reservation
    │
    ├─> Send reminder 2 hours before reservation
    │
    ├─> Auto-release table if customer doesn't arrive within 15 minutes
    │
    └─> Daily cleanup of past reservations
```

### 7.3 Stock Management Flow

```
┌──────────────────────────────────────────────────────────┐
│                STOCK MANAGEMENT FLOW DIAGRAM             │
└──────────────────────────────────────────────────────────┘

[Order Placement]
    │
    └─> When order status changes to 'paid':
         │
         ├─> For each item in order:
         │    │
         │    ├─> Check if stock >= quantity
         │    │    ├─> Yes: Proceed
         │    │    └─> No: Cancel order, refund payment
         │    │
         │    ├─> Reduce stock: stock = stock - quantity
         │    │
         │    ├─> Update total_sold: total_sold + quantity
         │    │
         │    └─> Log in stock_history:
         │         ├─> type: 'order'
         │         ├─> quantity_change: -quantity
         │         └─> reference: order_id
         │
         └─> Check stock threshold:
              ├─> If stock < threshold:
              │    └─> Create low stock alert for admin
              │
              └─> If stock = 0:
                   └─> Set menu is_available = false

[Admin Manual Stock Management]
    │
    ├─> View stock dashboard
    │
    ├─> Filter by low stock items
    │
    ├─> Stock Addition:
    │    ├─> Select menu item
    │    ├─> Enter quantity to add
    │    ├─> Enter note (e.g., "New stock delivery")
    │    ├─> Save
    │    └─> Log in stock_history (type: 'addition')
    │
    ├─> Stock Adjustment:
    │    ├─> Select menu item
    │    ├─> Enter new stock value
    │    ├─> Enter reason (e.g., "Physical count correction")
    │    ├─> Save
    │    └─> Log in stock_history (type: 'adjustment')
    │
    └─> Bulk Update:
         ├─> Upload CSV/Excel file
         ├─> Map columns (menu_id, quantity)
         ├─> Preview changes
         ├─> Confirm
         └─> Update all items and log history

[Automated Alerts]
    │
    ├─> Daily stock check (scheduled task)
    │
    ├─> If stock < threshold:
    │    ├─> Email notification to admin
    │    ├─> Dashboard alert badge
    │    └─> Optional: SMS to manager
    │
    └─> Weekly stock report:
         ├─> Items low in stock
         ├─> Most sold items
         ├─> Stock turnover rate
         └─> Recommended reorder quantities
```

### 7.4 Payment Integration Flow (Midtrans)

```
┌──────────────────────────────────────────────────────────┐
│              MIDTRANS PAYMENT FLOW DIAGRAM               │
└──────────────────────────────────────────────────────────┘

[Frontend] User clicks "Pay Now"
    │
    ├─> Display loading state
    │
    └─> POST /api/midtrans/token
         │
         └─> [Backend] Process payment token request:
              │
              ├─> Validate order data
              │
              ├─> Prepare transaction details:
              │    ├─> transaction_details:
              │    │    ├─> order_id: "ORDER-{id}-{timestamp}"
              │    │    └─> gross_amount: final_price
              │    │
              │    ├─> item_details: array of order items
              │    │
              │    └─> customer_details:
              │         ├─> first_name, email, phone
              │         └─> billing_address (optional)
              │
              ├─> Call Midtrans Snap API:
              │    POST https://app.sandbox.midtrans.com/snap/v1/transactions
              │    Authorization: Basic {SERVER_KEY_BASE64}
              │
              ├─> Receive snap_token
              │
              ├─> Store midtrans_order_id in orders table
              │
              └─> Return snap_token to frontend

[Frontend] Receive snap_token
    │
    ├─> Load Midtrans Snap.js library
    │
    ├─> Call window.snap.pay(token, {callbacks})
    │
    └─> Display Midtrans payment modal
         │
         ├─> User selects payment method:
         │    ├─> Bank Transfer (BCA, BNI, Mandiri, etc.)
         │    ├─> E-wallet (GoPay, OVO, DANA, etc.)
         │    ├─> Credit Card
         │    ├─> Convenience Store (Indomaret, Alfamart)
         │    └─> Others
         │
         ├─> User completes payment
         │
         └─> Midtrans processes transaction
              │
              ├─> Success: onSuccess callback triggered
              │    ├─> Close modal
              │    ├─> Show success message
              │    └─> Redirect to order confirmation
              │
              ├─> Pending: onPending callback triggered
              │    ├─> Close modal
              │    ├─> Show pending message with payment instructions
              │    └─> Redirect to pending orders page
              │
              └─> Error: onError callback triggered
                   ├─> Close modal
                   ├─> Show error message
                   └─> Allow user to retry

[Backend] Midtrans Notification Handler
    │
    └─> POST /api/midtrans/callback (Webhook)
         │
         ├─> Receive notification from Midtrans:
         │    ├─> order_id
         │    ├─> transaction_status
         │    ├─> fraud_status
         │    ├─> payment_type
         │    ├─> gross_amount
         │    └─> signature_key
         │
         ├─> Verify signature:
         │    ├─> Generate hash from: order_id + status_code + gross_amount + server_key
         │    ├─> Compare with received signature_key
         │    └─> If invalid: reject and log suspicious activity
         │
         ├─> Find order by midtrans_order_id
         │
         ├─> Update order based on transaction_status:
         │    │
         │    ├─> "capture" / "settlement" (Success):
         │    │    ├─> order.status = 'processing'
         │    │    ├─> order.payment_status = 'paid'
         │    │    ├─> order.payment_method = payment_type
         │    │    ├─> order.midtrans_transaction_id = transaction_id
         │    │    ├─> Reduce stock for all items
         │    │    ├─> Update table status to 'occupied' (if dine-in)
         │    │    ├─> Generate PDF receipt
         │    │    ├─> Send confirmation email
         │    │    └─> Create notification for admin
         │    │
         │    ├─> "pending" (Waiting for payment):
         │    │    ├─> order.status = 'pending'
         │    │    ├─> order.payment_status = 'pending'
         │    │    └─> Set expiry reminder (24 hours)
         │    │
         │    ├─> "deny" / "cancel" / "expire" (Failed):
         │    │    ├─> order.status = 'cancelled'
         │    │    ├─> order.payment_status = 'failed'
         │    │    ├─> Release reserved table
         │    │    └─> Send cancellation notification
         │    │
         │    └─> "refund" (Refunded):
         │         ├─> order.payment_status = 'refunded'
         │         ├─> Restore stock (add back quantities)
         │         ├─> Update table status
         │         └─> Log refund in transaction history
         │
         └─> Return 200 OK to Midtrans
              └─> Midtrans stops sending notifications

[Error Handling]
    │
    ├─> Payment timeout (Midtrans default: 24 hours)
    │    └─> Auto-cancel order, release table, notify customer
    │
    ├─> Insufficient stock during payment
    │    └─> Cancel order, initiate refund, notify customer
    │
    ├─> Network error during callback
    │    └─> Midtrans retries notification (exponential backoff)
    │
    └─> Duplicate notifications
         └─> Check if order already processed, return 200 OK without changes
```

---

## 8. Frontend Components

### 8.1 Component Structure

```
src/
├── components/
│   ├── ui/                      # shadcn/ui base components
│   │   ├── button.jsx
│   │   ├── card.jsx
│   │   ├── dialog.jsx
│   │   ├── input.jsx
│   │   ├── select.jsx
│   │   ├── badge.jsx
│   │   ├── table.jsx
│   │   ├── tabs.jsx
│   │   ├── sheet.jsx
│   │   ├── accordion.jsx
│   │   ├── calendar.jsx
│   │   ├── steps.jsx
│   │   └── ...
│   │
│   ├── layout/                  # Layout components
│   │   ├── Header.jsx
│   │   ├── Footer.jsx
│   │   ├── Sidebar.jsx
│   │   ├── AdminLayout.jsx
│   │   └── UserLayout.jsx
│   │
│   ├── menu/                    # Menu related components
│   │   ├── MenuCard.jsx
│   │   ├── MenuGrid.jsx
│   │   ├── MenuDetail.jsx
│   │   ├── CategoryFilter.jsx
│   │   └── MenuSearch.jsx
│   │
│   ├── cart/                    # Cart components
│   │   ├── CartSheet.jsx
│   │   ├── CartItem.jsx
│   │   ├── CartSummary.jsx
│   │   └── EmptyCart.jsx
│   │
│   ├── checkout/                # Checkout components
│   │   ├── CheckoutStepper.jsx
│   │   ├── OrderTypeSelector.jsx
│   │   ├── TableSelector.jsx
│   │   ├── OrderReview.jsx
│   │   └── PaymentButton.jsx
│   │
│   ├── admin/                   # Admin components
│   │   ├── Dashboard.jsx
│   │   ├── StatsCard.jsx
│   │   ├── RevenueChart.jsx
│   │   ├── OrdersTable.jsx
│   │   ├── MenuForm.jsx
│   │   ├── PromoForm.jsx
│   │   ├── TableManagement.jsx
│   │   └── ReservationList.jsx
│   │
│   ├── reservation/             # Reservation components
│   │   ├── ReservationForm.jsx
│   │   ├── TableAvailability.jsx
│   │   └── ReservationCard.jsx
│   │
│   ├── coffee-info/             # Coffee education components
│   │   ├── CoffeeInfoCard.jsx
│   │   ├── CoffeeInfoDetail.jsx
│   │   └── CoffeeInfoAccordion.jsx
│   │
│   └── common/                  # Shared components
│       ├── LoadingSpinner.jsx
│       ├── ErrorBoundary.jsx
│       ├── ImageUpload.jsx
│       ├── SearchBar.jsx
│       ├── Pagination.jsx
│       ├── StatusBadge.jsx
│       └── ConfirmDialog.jsx
│
├── pages/
│   ├── Home.jsx
│   ├── Menu.jsx
│   ├── MenuDetail.jsx
│   ├── Checkout.jsx
│   ├── OrderConfirmation.jsx
│   ├── CoffeeEducation.jsx
│   ├── Reservation.jsx
│   ├── Profile.jsx
│   ├── Login.jsx
│   ├── Register.jsx
│   └── admin/
│       ├── Dashboard.jsx
│       ├── MenuManagement.jsx
│       ├── OrderManagement.jsx
│       ├── PromoManagement.jsx
│       ├── TableManagement.jsx
│       ├── ReservationManagement.jsx
│       ├── StockManagement.jsx
│       └── Reports.jsx
│
├── contexts/
│   ├── AuthContext.jsx
│   ├── CartContext.jsx
│   └── ThemeContext.jsx
│
├── hooks/
│   ├── useAuth.js
│   ├── useCart.js
│   ├── useMenu.js
│   ├── useOrders.js
│   ├── useReservation.js
│   └── useMidtrans.js
│
├── lib/
│   ├── axios.js
│   ├── utils.js
│   └── constants.js
│
└── App.jsx
```

### 8.2 Key Component Examples

#### 8.2.1 MenuCard Component
```jsx
import { Card, CardContent, CardFooter } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { ShoppingCart, Eye } from 'lucide-react';
import { motion } from 'framer-motion';
import { useCart } from '@/contexts/CartContext';
import toast from 'react-hot-toast';

const MenuCard = ({ menu }) => {
  const { addToCart } = useCart();
  
  const handleAddToCart = () => {
    if (menu.stock === 0) {
      toast.error('Item out of stock');
      return;
    }
    
    addToCart(menu);
    toast.success('Added to cart');
  };
  
  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      animate={{ opacity: 1, y: 0 }}
      whileHover={{ y: -8 }}
      transition={{ duration: 0.3 }}
    >
      <Card className="overflow-hidden hover:shadow-lg transition-shadow">
        <div className="relative h-48 overflow-hidden">
          <img 
            src={menu.image} 
            alt={menu.name}
            className="w-full h-full object-cover"
          />
          {menu.is_featured && (
            <Badge className="absolute top-2 right-2 bg-amber-500">
              Featured
            </Badge>
          )}
          {menu.stock === 0 && (
            <div className="absolute inset-0 bg-black/60 flex items-center justify-center">
              <Badge variant="destructive">Out of Stock</Badge>
            </div>
          )}
        </div>
        
        <CardContent className="p-4">
          <Badge variant="outline" className="mb-2">
            {menu.category.name}
          </Badge>
          <h3 className="font-semibold text-lg mb-2">{menu.name}</h3>
          <p className="text-sm text-gray-600 line-clamp-2 mb-3">
            {menu.description}
          </p>
          <div className="flex items-center justify-between">
            <span className="text-xl font-bold text-primary-700">
              Rp {menu.price.toLocaleString('id-ID')}
            </span>
            <span className="text-sm text-gray-500">
              Stock: {menu.stock}
            </span>
          </div>
        </CardContent>
        
        <CardFooter className="p-4 pt-0 gap-2">
          <Button 
            variant="outline" 
            size="sm" 
            className="flex-1"
            onClick={() => {/* Open detail modal */}}
          >
            <Eye className="w-4 h-4 mr-2" />
            Detail
          </Button>
          <Button 
            size="sm" 
            className="flex-1"
            onClick={handleAddToCart}
            disabled={menu.stock === 0}
          >
            <ShoppingCart className="w-4 h-4 mr-2" />
            Add to Cart
          </Button>
        </CardFooter>
      </Card>
    </motion.div>
  );
};

export default MenuCard;
```

#### 8.2.2 CheckoutStepper Component
```jsx
import { useState } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { Button } from '@/components/ui/button';
import { Steps } from '@/components/ui/steps';
import { ShoppingBag, Armchair, ClipboardList, CreditCard } from 'lucide-react';
import OrderTypeSelector from './OrderTypeSelector';
import TableSelector from './TableSelector';
import OrderReview from './OrderReview';
import PaymentButton from './PaymentButton';

const steps = [
  { title: 'Order Type', icon: ShoppingBag },
  { title: 'Table', icon: Armchair },
  { title: 'Review', icon: ClipboardList },
  { title: 'Payment', icon: CreditCard }
];

const CheckoutStepper = ({ cart }) => {
  const [currentStep, setCurrentStep] = useState(0);
  const [orderData, setOrderData] = useState({
    orderType: null,
    tableId: null,
    note: ''
  });
  
  const handleNext = () => {
    if (currentStep < steps.length - 1) {
      setCurrentStep(currentStep + 1);
    }
  };
  
  const handleBack = () => {
    if (currentStep > 0) {
      setCurrentStep(currentStep - 1);
    }
  };
  
  const canProceed = () => {
    switch (currentStep) {
      case 0:
        return orderData.orderType !== null;
      case 1:
        return orderData.orderType === 'take_away' || orderData.tableId !== null;
      case 2:
        return true;
      default:
        return false;
    }
  };
  
  const renderStepContent = () => {
    switch (currentStep) {
      case 0:
        return (
          <OrderTypeSelector 
            value={orderData.orderType}
            onChange={(type) => setOrderData({ ...orderData, orderType: type })}
          />
        );
      case 1:
        if (orderData.orderType === 'take_away') {
          handleNext();
          return null;
        }
        return (
          <TableSelector 
            value={orderData.tableId}
            onChange={(tableId) => setOrderData({ ...orderData, tableId })}
          />
        );
      case 2:
        return (
          <OrderReview 
            cart={cart}
            orderData={orderData}
            onNoteChange={(note) => setOrderData({ ...orderData, note })}
          />
        );
      case 3:
        return (
          <PaymentButton 
            cart={cart}
            orderData={orderData}
          />
        );
      default:
        return null;
    }
  };
  
  return (
    <div className="max-w-4xl mx-auto">
      <Steps current={currentStep} items={steps} className="mb-8" />
      
      <AnimatePresence mode="wait">
        <motion.div
          key={currentStep}
          initial={{ opacity: 0, x: 20 }}
          animate={{ opacity: 1, x: 0 }}
          exit={{ opacity: 0, x: -20 }}
          transition={{ duration: 0.3 }}
          className="min-h-[400px]"
        >
          {renderStepContent()}
        </motion.div>
      </AnimatePresence>
      
      <div className="flex justify-between mt-8">
        <Button
          variant="outline"
          onClick={handleBack}
          disabled={currentStep === 0}
        >
          Back
        </Button>
        
        {currentStep < steps.length - 1 && (
          <Button
            onClick={handleNext}
            disabled={!canProceed()}
          >
            Next
          </Button>
        )}
      </div>
    </div>
  );
};

export default CheckoutStepper;
```

#### 8.2.3 Admin Dashboard Component
```jsx
import { useEffect, useState } from 'react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { LineChart, Line, BarChart, Bar, PieChart, Pie, Cell, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer } from 'recharts';
import { DollarSign, ShoppingCart, Users, Armchair } from 'lucide-react';
import { motion } from 'framer-motion';
import axios from '@/lib/axios';

const COLORS = ['#8b4513', '#d2691e', '#deb887', '#f4a460'];

const StatsCard = ({ title, value, icon: Icon, trend, color }) => (
  <motion.div
    initial={{ opacity: 0, y: 20 }}
    animate={{ opacity: 1, y: 0 }}
    transition={{ duration: 0.3 }}
  >
    <Card>
      <CardContent className="p-6">
        <div className="flex items-center justify-between">
          <div>
            <p className="text-sm text-gray-600">{title}</p>
            <h3 className="text-2xl font-bold mt-2">{value}</h3>
            {trend && (
              <p className={`text-sm mt-2 ${trend > 0 ? 'text-green-600' : 'text-red-600'}`}>
                {trend > 0 ? '↑' : '↓'} {Math.abs(trend)}%
              </p>
            )}
          </div>
          <div className={`p-4 rounded-full ${color}`}>
            <Icon className="w-6 h-6 text-white" />
          </div>
        </div>
      </CardContent>
    </Card>
  </motion.div>
);

const AdminDashboard = () => {
  const [stats, setStats] = useState(null);
  const [loading, setLoading] = useState(true);
  
  useEffect(() => {
    fetchDashboardData();
  }, []);
  
  const fetchDashboardData = async () => {
    try {
      const { data } = await axios.get('/api/admin/dashboard');
      setStats(data);
    } catch (error) {
      console.error('Failed to fetch dashboard data:', error);
    } finally {
      setLoading(false);
    }
  };
  
  if (loading) {
    return <div>Loading...</div>;
  }
  
  return (
    <div className="space-y-6">
      {/* Stats Cards */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <StatsCard
          title="Total Revenue"
          value={`Rp ${stats.revenue.total.toLocaleString('id-ID')}`}
          icon={DollarSign}
          trend={stats.revenue.growth}
          color="bg-green-500"
        />
        <StatsCard
          title="Total Orders"
          value={stats.orders.total}
          icon={ShoppingCart}
          color="bg-blue-500"
        />
        <StatsCard
          title="Active Customers"
          value={stats.customers?.total || 0}
          icon={Users}
          color="bg-purple-500"
        />
        <StatsCard
          title="Table Occupancy"
          value={`${stats.table_occupancy.percentage}%`}
          icon={Armchair}
          color="bg-orange-500"
        />
      </div>
      
      {/* Charts */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Revenue Chart */}
        <Card>
          <CardHeader>
            <CardTitle>Revenue Trend</CardTitle>
          </CardHeader>
          <CardContent>
            <ResponsiveContainer width="100%" height={300}>
              <LineChart data={stats.revenue.chart_data}>
                <CartesianGrid strokeDasharray="3 3" />
                <XAxis dataKey="date" />
                <YAxis />
                <Tooltip />
                <Legend />
                <Line 
                  type="monotone" 
                  dataKey="amount" 
                  stroke="#8b4513" 
                  strokeWidth={2}
                  name="Revenue"
                />
              </LineChart>
            </ResponsiveContainer>
          </CardContent>
        </Card>
        
        {/* Popular Items Chart */}
        <Card>
          <CardHeader>
            <CardTitle>Top Selling Items</CardTitle>
          </CardHeader>
          <CardContent>
            <ResponsiveContainer width="100%" height={300}>
              <BarChart data={stats.popular_items}>
                <CartesianGrid strokeDasharray="3 3" />
                <XAxis dataKey="name" />
                <YAxis />
                <Tooltip />
                <Legend />
                <Bar dataKey="total_sold" fill="#8b4513" name="Sold" />
              </BarChart>
            </ResponsiveContainer>
          </CardContent>
        </Card>
      </div>
      
      {/* Order Type Distribution */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <Card>
          <CardHeader>
            <CardTitle>Order Type Distribution</CardTitle>
          </CardHeader>
          <CardContent>
            <ResponsiveContainer width="100%" height={300}>
              <PieChart>
                <Pie
                  data={stats.order_type_distribution}
                  cx="50%"
                  cy="50%"
                  labelLine={false}
                  label={({ name, percent }) => `${name}: ${(percent * 100).toFixed(0)}%`}
                  outerRadius={100}
                  fill="#8884d8"
                  dataKey="value"
                >
                  {stats.order_type_distribution?.map((entry, index) => (
                    <Cell key={`cell-${index}`} fill={COLORS[index % COLORS.length]} />
                  ))}
                </Pie>
                <Tooltip />
              </PieChart>
            </ResponsiveContainer>
          </CardContent>
        </Card>
        
        {/* Low Stock Alert */}
        <Card>
          <CardHeader>
            <CardTitle>Low Stock Alert</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="space-y-4">
              {stats.low_stock_items.map((item) => (
                <div key={item.id} className="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                  <div>
                    <p className="font-medium">{item.name}</p>
                    <p className="text-sm text-gray-600">
                      Stock: {item.stock} / Threshold: {item.threshold}
                    </p>
                  </div>
                  <Badge variant="destructive">Low Stock</Badge>
                </div>
              ))}
              {stats.low_stock_items.length === 0 && (
                <p className="text-center text-gray-500 py-8">
                  All items are well stocked
                </p>
              )}
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  );
};

export default AdminDashboard;
```

### 8.3 Custom Hooks

#### 8.3.1 useCart Hook
```jsx
import { createContext, useContext, useState, useEffect } from 'react';
import toast from 'react-hot-toast';

const CartContext = createContext();

export const CartProvider = ({ children }) => {
  const [items, setItems] = useState([]);
  
  // Load cart from localStorage on mount
  useEffect(() => {
    const savedCart = localStorage.getItem('cart');
    if (savedCart) {
      setItems(JSON.parse(savedCart));
    }
  }, []);
  
  // Save cart to localStorage whenever it changes
  useEffect(() => {
    localStorage.setItem('cart', JSON.stringify(items));
  }, [items]);
  
  const addToCart = (menu, quantity = 1) => {
    setItems((prevItems) => {
      const existingItem = prevItems.find((item) => item.id === menu.id);
      
      if (existingItem) {
        // Check if new quantity exceeds stock
        if (existingItem.quantity + quantity > menu.stock) {
          toast.error('Insufficient stock');
          return prevItems;
        }
        
        return prevItems.map((item) =>
          item.id === menu.id
            ? { ...item, quantity: item.quantity + quantity }
            : item
        );
      }
      
      return [...prevItems, { ...menu, quantity }];
    });
  };
  
  const updateQuantity = (menuId, quantity) => {
    if (quantity <= 0) {
      removeFromCart(menuId);
      return;
    }
    
    setItems((prevItems) =>
      prevItems.map((item) => {
        if (item.id === menuId) {
          if (quantity > item.stock) {
            toast.error('Insufficient stock');
            return item;
          }
          return { ...item, quantity };
        }
        return item;
      })
    );
  };
  
  const removeFromCart = (menuId) => {
    setItems((prevItems) => prevItems.filter((item) => item.id !== menuId));
    toast.success('Item removed from cart');
  };
  
  const clearCart = () => {
    setItems([]);
    localStorage.removeItem('cart');
  };
  
  const getTotal = () => {
    return items.reduce((total, item) => total + item.price * item.quantity, 0);
  };
  
  const getItemCount = () => {
    return items.reduce((count, item) => count + item.quantity, 0);
  };
  
  return (
    <CartContext.Provider
      value={{
        items,
        addToCart,
        updateQuantity,
        removeFromCart,
        clearCart,
        total: getTotal(),
        itemCount: getItemCount()
      }}
    >
      {children}
    </CartContext.Provider>
  );
};

export const useCart = () => {
  const context = useContext(CartContext);
  if (!context) {
    throw new Error('useCart must be used within CartProvider');
  }
  return context;
};
```

#### 8.3.2 useMidtrans Hook
```jsx
import { useState, useEffect } from 'react';
import axios from '@/lib/axios';
import toast from 'react-hot-toast';

export const useMidtrans = () => {
  const [isLoaded, setIsLoaded] = useState(false);
  
  useEffect(() => {
    // Load Midtrans Snap script
    const script = document.createElement('script');
    script.src = 'https://app.sandbox.midtrans.com/snap/snap.js';
    script.setAttribute('data-client-key', import.meta.env.VITE_MIDTRANS_CLIENT_KEY);
    script.onload = () => setIsLoaded(true);
    document.body.appendChild(script);
    
    return () => {
      document.body.removeChild(script);
    };
  }, []);
  
  const requestPayment = async (orderId) => {
    if (!isLoaded) {
      toast.error('Payment system is loading...');
      return;
    }
    
    try {
      const { data } = await axios.post('/api/midtrans/token', {
        order_id: orderId
      });
      
      return new Promise((resolve, reject) => {
        window.snap.pay(data.token, {
          onSuccess: (result) => {
            toast.success('Payment successful!');
            resolve(result);
          },
          onPending: (result) => {
            toast.info('Waiting for payment...');
            resolve(result);
          },
          onError: (result) => {
            toast.error('Payment failed');
            reject(result);
          },
          onClose: () => {
            toast.info('Payment popup closed');
          }
        });
      });
    } catch (error) {
      toast.error('Failed to initiate payment');
      throw error;
    }
  };
  
  return { isLoaded, requestPayment };
};
```

---

## 9. Security & Authentication

### 9.1 Authentication Flow

```
┌──────────────────────────────────────────────────────────┐
│           LARAVEL SANCTUM AUTHENTICATION                 │
└──────────────────────────────────────────────────────────┘

[Registration]
    │
    ├─> User fills registration form
    │
    ├─> Frontend validates:
    │    ├─> Name (min 3 chars)
    │    ├─> Email format
    │    ├─> Password strength (min 8 chars)
    │    └─> Password confirmation match
    │
    ├─> POST /api/auth/register
    │
    └─> Backend: