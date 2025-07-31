# 🚀 Laravel Module Generator - Complete Guide

> A comprehensive guide for generating Laravel modules with all supported data types, examples, and testing commands.

## 📋 Table of Contents

- [Installation](#-installation)
- [Quick Start](#-quick-start)
- [Command Structure](#-command-structure)
- [Data Types Reference](#-data-types-reference)
- [Testing Commands](#-testing-commands)
- [Advanced Examples](#-advanced-examples)
- [Best Practices](#-best-practices)
- [Troubleshooting](#-troubleshooting)

---
## ⚡ Installation

### Go To this Repo and Branch must be master
```bash
https://github.com/MahfujuRahman/Boiler-Plate/tree/master
```

### Git clone or Download Zip
```bash
git clone https://github.com/MahfujuRahman/Boiler-Plate.git
```

### Composer and Npm Install
```bash
composer install && npm install
```
### Run this command for fresh migrate and passport install
```bash
npm run reload
```
### Run project
```bash
php artisan serve && npm run dev
```
---

## 🚀 Quick Start

### Basic Module Generation
```bash
php artisan make:module UserManagement/User [name:string,email:string-255,is_active:boolean,role:enum-admin.superadmin.user] --vue
```

### Basic Table Generation
```bash
php artisan make:table UserManagement/User/UserProfile [user_id:bigint,bio:text,avatar:file] --model
```
### Run With BelongsTo Relationship 
```bash
php artisan make:module ContentManagement/Blog [title:string-255,blog_category_id:bigint{ContentManagement/BlogCategory},slug:string-255,excerpt:text] --vue
```
---

## 🏗️ Command Structure

### Module Command
```bash
php artisan make:module ModuleName/SubModule [field1:type1,field2:type2] --vue
```

### Table Command
```bash
php artisan make:table ModuleName/SubModule/TableName [field1:type1,field2:type2] --model
```

### 📝 Module Command With BelongsTo Relationship 
```bash
php artisan make:module ModuleName/SubModule [field1:type1{ModuleName/SubModule},field2:type2] --vue
```
Suppose you want to link `BlogManagement/BlogCategory` to `BlogManagement/Blog`.

In the **Blog** module, define the field like this: `blog_category_id:bigint{BlogManagement/BlogCategory}`


This will:

- Automatically generate a **select dropdown** in the form for `blog_category_id`.
- Populate the dropdown with data from the `BlogCategory` module.

> **Note:** Always use the `{ModuleName/SubModule}` format to correctly define the relational path.

### Generated Files
- **Module with Relation**: Use this curly `{}` to define relationship and `ModuleName/SubModule` should be your relational command path.
- **Module**: Creates controllers, migrations, Vue components, routes
- **Table**: Creates migration and model files only
- **Flags**: `--vue` for Vue components, `--model` for Eloquent models

---

## 📊 Data Types Reference

### 🔤 String Types

| Type | Migration | Form Field | Example |
|------|-----------|------------|---------|
| `string` | `string(100)` | `text` | `name:string` |
| `string-255` | `string(255)` | `text` | `email:string-255` |
| `string-50` | `string(50)` | `text` | `code:string-50` |
| `text` | `text` | `textarea` | `description:text` |
| `longtext` | `longtext` | `textarea` | `content:longtext` |
| `stringfile` | `string(100)` | `file` | `avatar:stringfile` |
| `file` | `string(100)` | `file` | `document:file` |
| `password` | `string(100)` | `password` | `password:password` |

### 🔢 Numeric Types

| Type | Migration | Form Field | Example |
|------|-----------|------------|---------|
| `integer` / `int` | `integer` | `number` | `quantity:integer` |
| `bigint` / `biginteger` | `bigInteger` | `number` | `user_id:bigint` |
| `tinyint` | `tinyInteger` | `select` (Yes/No) | `priority:tinyint` |
| `unsigned_int` | `unsignedInteger` | `number` | `count:unsigned_int` |
| `unsignedInteger` | `unsignedInteger` | `number` | `id:unsignedInteger` |
| `year` | `year` | `number` (1900-2100) | `birth_year:year` |
| `float` | `float` | `number` (step: 0.01) | `price:float` |
| `double` | `double` | `number` (step: 0.01) | `weight:double` |
| `decimal` | `decimal` | `number` (step: 0.01) | `amount:decimal` |

### ✅ Boolean & Selection Types

| Type | Migration | Form Field | Example |
|------|-----------|------------|---------|
| `boolean` | `tinyInteger` (default: 0) | `select` (Yes/No) | `is_active:boolean` |
| `boolean-val1.val2` | `enum(['val1','val2'])` | `select` (custom) | `status:boolean-active.inactive` |
| `tinyint-val1.val2` | `enum(['val1','val2'])` | `select` (custom) | `priority:tinyint-high.low` |
| `enum-val1.val2` | `enum(['val1','val2'])` | `select` | `status:enum-active.inactive` |

### 📅 Date & Time Types

| Type | Migration | Form Field | Example |
|------|-----------|------------|---------|
| `date` | `date` | `date` | `birth_date:date` |
| `datetime` | `datetime` | `datetime-local` | `created_at:datetime` |
| `datetime-local` | `datetime` | `datetime-local` | `event_time:datetime-local` |
| `time` | `time` | `time` | `start_time:time` |
| `timestamp` | `timestamp` | `datetime-local` | `last_seen:timestamp` |

### 🔧 Special Types

| Type | Migration | Form Field | Example |
|------|-----------|------------|---------|
| `json` | `json` | `textarea` | `metadata:json` |
| `binary` | `binary` | `file` | `data:binary` |
| `uuid` | `uuid` | `text` (readonly) | `identifier:uuid` |

---

## 🧪 Testing Commands

### 🎯 Complete Test Suite

#### All Data Types Test
```bash
php artisan make:module TestModule/ComprehensiveTest [
  basic_string:string,
  long_string:string-255,
  short_string:string-50,
  description:text,
  long_content:longtext,
  basic_number:number,
  quantity:integer,
  count:int,
  user_id:bigint,
  category_id:biginteger,
  priority:tinyint,
  priority_custom:tinyint-high.medium.low,
  unsigned_count:unsigned_int,
  unsigned_id:unsignedInteger,
  birth_year:year,
  is_active:boolean,
  status_custom:boolean-active.inactive.pending,
  price:float,
  weight:double,
  amount:decimal,
  birth_date:date,
  created_at:datetime,
  event_time:datetime-local,
  start_time:time,
  last_seen:timestamp,
  metadata:json,
  status:enum-active.inactive.pending,
  difficulty:enum-easy.medium.hard,
  avatar:stringfile,
  document:file,
  binary_data:binary,
  identifier:uuid,
  user_password:password
] --vue
```

### 🎨 Quick Test Commands

#### Essential Types
```bash
php artisan make:module TestModule/QuickTest [
  name:string-100,
  email:string-255,
  description:text,
  age:integer,
  user_id:bigint,
  is_active:boolean,
  price:float,
  birth_date:date,
  created_at:datetime,
  metadata:json,
  status:enum-active.inactive,
  avatar:stringfile,
  password:password
] --vue
```

#### String Types Only
```bash
php artisan make:module TestModule/StringTest [
  basic_string:string,
  long_string:string-255,
  short_string:string-50,
  file_path:stringfile,
  document:file,
  password:password
] --vue
```

#### Numeric Types Only
```bash
php artisan make:module TestModule/NumericTest [
  count:integer,
  big_id:bigint,
  tiny_flag:tinyint,
  unsigned_count:unsigned_int,
  unsigned_id:unsignedInteger,
  birth_year:year,
  is_active:boolean,
  price:float,
  weight:double,
  amount:decimal
] --vue
```

#### Boolean & Enum Types
```bash
php artisan make:module TestModule/BooleanTest [
  is_active:boolean,
  is_featured:boolean,
  status:boolean-active.inactive.pending,
  priority:tinyint,
  level:tinyint-high.medium.low,
  flag:tinyint-yes.no
] --vue
```

#### Date & Time Types
```bash
php artisan make:module TestModule/DateTimeTest [
  birth_date:date,
  created_at:datetime,
  event_time:datetime-local,
  start_time:time,
  last_seen:timestamp
] --vue
```

#### Special Types
```bash
php artisan make:module TestModule/SpecialTest [
  metadata:json,
  status:enum-active.inactive.pending,
  binary_data:binary,
  identifier:uuid
] --vue
```
---

## 💡 Best Practices

### ✅ Do's
- Use descriptive field names: `user_id` instead of `uid`
- Choose appropriate string lengths: `string-255` for emails
- Use `bigint` for foreign keys
- Use `enum` for fixed options
- Use `json` for complex data structures
- Use `boolean` for yes/no fields
- Use `decimal` for currency values

### ❌ Don'ts
- Don't use `text` for short strings
- Don't use `string` without length for large text
- Don't use `integer` for foreign keys (use `bigint`)
- Don't use `float` for currency (use `decimal`)
- Don't create enum with too many options

### 🔧 Naming Conventions
- Use snake_case for field names
- Use descriptive names: `created_at` not `ca`
- Use `_id` suffix for foreign keys
- Use `is_` prefix for boolean fields
- Use `_at` suffix for datetime fields
- Use `_count` suffix for counters

---

## 🐛 Troubleshooting

### Common Issues

#### 1. Migration Errors
```bash
# Check migration file syntax
php artisan migrate:status

# Run specific migration
php artisan migrate --path='/app/Modules/Management/ModuleName/Database/migration_file.php'
```

#### 2. String Length Issues
- **Error**: String too long
- **Solution**: Use `string-255` or `text` for longer strings

#### 3. Enum Format Issues
- **Error**: Invalid enum format
- **Solution**: Use dots (.) not commas: `status:enum-active.inactive`

#### 4. Boolean Default Values
- **Issue**: Boolean fields not defaulting to 0
- **Solution**: System automatically sets `default(0)` for boolean fields

#### 5. File Upload Issues
- **Issue**: File uploads not working
- **Solution**: Use `stringfile` for file paths, `file` for actual files

### Testing Checklist

- [ ] Run migration successfully
- [ ] Check all field types are correct
- [ ] Verify enum options work
- [ ] Test boolean fields default to 0
- [ ] Confirm file upload fields work
- [ ] Test Vue components load correctly
- [ ] Check form validation works
- [ ] Verify CRUD operations work

### Migration Commands
```bash
# Run all migrations
php artisan migrate

# Run specific module migration
php artisan migrate --path='/app/Modules/Management/ModuleName/Database/'

# Rollback last migration
php artisan migrate:rollback

# Check migration status
php artisan migrate:status
```

### Cleanup Commands
```bash
# Remove test migrations
php artisan migrate:rollback --path='/app/Modules/Management/TestModule/Database/'

# Remove test module directory
rm -rf app/Modules/Management/TestModule/
```

---

## 📚 Additional Resources

### Generated File Structure
```
app/Modules/Management/ModuleName/
├── Controllers/
│   ├── ModuleNameController.php
│   └── API/
├── Database/
│   └── create_module_names_table.php
├── Models/
│   └── ModuleName.php
├── Routes/
│   ├── web.php
│   └── api.php
└── Views/ (if --vue flag used)
    ├── components/
    ├── pages/
    └── setup/
```

### Form Field Mappings
- `text` → `<input type="text">`
- `textarea` → `<textarea>`
- `number` → `<input type="number">`
- `date` → `<input type="date">`
- `datetime-local` → `<input type="datetime-local">`
- `time` → `<input type="time">`
- `password` → `<input type="password">`
- `file` → `<input type="file">`
- `select` → `<select><option>`

---

## 🎉 Conclusion

This Laravel Module Generator provides a powerful way to quickly scaffold modules with proper database migrations and Vue.js components. Use the testing commands to validate your setup and refer to the data types reference when building your applications.

For more advanced usage and customization, explore the generated files and modify them according to your specific requirements.

**Happy Coding!** 🚀
