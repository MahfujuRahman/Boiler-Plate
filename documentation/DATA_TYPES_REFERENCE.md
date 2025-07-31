# Data Types Reference Guide

This documentation provides a comprehensive guide for all supported data types in the Laravel module generation system, showing how they map to database migrations and frontend form fields.

## Quick Reference Table

| Command Type | Migration Type | Form Field Type | Example |
|--------------|----------------|-----------------|---------|
| `string` | `string(100)` | `text` | `name:string` |
| `string-255` | `string(255)` | `text` | `email:string-255` |
| `text` | `text` | `textarea` | `description:text` |
| `longtext` | `longtext` | `textarea` | `content:longtext` |
| `integer`, `int` | `integer` | `number` | `quantity:integer` |
| `bigint` | `bigInteger` | `number` | `user_id:bigint` |
| `tinyint` | `tinyInteger` | `select` (Yes/No) | `priority:tinyint` |
| `unsigned_int` | `unsignedInteger` | `number` | `count:unsigned_int` |
| `unsignedInteger` | `unsignedInteger` | `number` | `id:unsignedInteger` |
| `year` | `year` | `number` (min: 1900, max: 2100) | `birth_year:year` |
| `boolean` | `tinyInteger` | `select` (Yes/No) | `is_active:boolean` |
| `boolean-val1.val2` | `enum(['val1','val2'])` | `select` (custom) | `status:boolean-active.inactive` |
| `tinyint-val1.val2` | `enum(['val1','val2'])` | `select` (custom) | `priority:tinyint-high.low` |
| `float` | `float` | `number` (step: 0.01) | `price:float` |
| `double` | `double` | `number` (step: 0.01) | `weight:double` |
| `decimal` | `decimal` | `number` (step: 0.01) | `amount:decimal` |
| `date` | `date` | `date` | `birth_date:date` |
| `datetime` | `datetime` | `datetime` | `created_at:datetime` |
| `datetime-local` | `datetime` | `datetime` | `event_time:datetime-local` |
| `time` | `time` | `time` | `start_time:time` |
| `timestamp` | `timestamp` | `datetime` | `last_seen:timestamp` |
| `json` | `json` | `textarea` | `metadata:json` |
| `enum-val1.val2` | `enum(['val1','val2'])` | `select` | `status:enum-active.inactive` |
| `stringfile` | `string(100)` | `file` | `avatar:stringfile` |
| `file` | `string(100)` | `file` | `document:file` |
| `binary` | `binary` | `file` | `data:binary` |
| `uuid` | `uuid` | `text` (readonly) | `identifier:uuid` |
| `password` | `string(100)` | `password` | `password:password` |

## Command Structure

```bash
php artisan make:module ModuleName/SubModule [field_name:data_type] --vue
php artisan make:table ModuleName/SubModule/TableName [field_name:data_type] --model
```

## Data Type Mappings

### 1. String Types

#### Basic String
- **Command**: `field_name:string`
- **Migration**: `$table->string('field_name', 100)->nullable();`
- **Form Field**: `type: "text"`
- **Example**: `title:string`

#### String with Custom Length
- **Command**: `field_name:string-255`
- **Migration**: `$table->string('field_name', 255)->nullable();`
- **Form Field**: `type: "text"`
- **Example**: `email:string-255`

#### String File (File Upload)
- **Command**: `field_name:stringfile`
- **Migration**: `$table->string('field_name', 100)->nullable();`
- **Form Field**: `type: "file", multiple: "false"`
- **Example**: `avatar:stringfile`

#### File (Alternative File Upload)
- **Command**: `field_name:file`
- **Migration**: `$table->string('field_name', 100)->nullable();`
- **Form Field**: `type: "file"`
- **Example**: `document:file`

### 2. Text Types

#### Text
- **Command**: `field_name:text`
- **Migration**: `$table->text('field_name')->nullable();`
- **Form Field**: `type: "textarea"`
- **Example**: `description:text`

#### Long Text
- **Command**: `field_name:longtext`
- **Migration**: `$table->text('field_name')->nullable();`
- **Form Field**: `type: "textarea"`
- **Example**: `content:longtext`

### 3. Integer Types

#### Number (Alternative Integer)
- **Command**: `field_name:number`
- **Migration**: `$table->integer('field_name')->nullable();`
- **Form Field**: `type: "number"`
- **Example**: `count:number`

#### Integer
- **Command**: `field_name:integer` or `field_name:int` or `field_name:intiger`
- **Migration**: `$table->integer('field_name')->nullable();`
- **Form Field**: `type: "number"`
- **Example**: `quantity:integer`

#### Big Integer
- **Command**: `field_name:bigint` or `field_name:biginteger`
- **Migration**: `$table->bigInteger('field_name')->nullable();`
- **Form Field**: `type: "number"`
- **Example**: `user_id:bigint`

#### Tiny Integer
- **Command**: `field_name:tinyint`
- **Migration**: `$table->tinyInteger('field_name')->default(0);`
- **Form Field**: `type: "radio"`
- **Example**: `priority:tinyint`

#### Unsigned Integer
- **Command**: `field_name:unsigned_int` or `field_name:unsignedInteger`
- **Migration**: `$table->unsigned_int('field_name')->nullable();` or `$table->unsignedInteger('field_name')->nullable();`
- **Form Field**: `type: "number"`
- **Example**: `count:unsigned_int`

#### Year
- **Command**: `field_name:year`
- **Migration**: `$table->year('field_name')->nullable();`
- **Form Field**: `type: "number", min: "1900", max: "2100"`
- **Example**: `birth_year:year`

### 4. Boolean Type

#### Boolean
- **Command**: `field_name:boolean`
- **Migration**: `$table->tinyInteger('field_name')->default(0);`
- **Form Field**: `type: "select"` with Yes/No options
- **Example**: `is_active:boolean`

#### Boolean with Custom Options
- **Command**: `field_name:boolean-active.inactive.pending`
- **Migration**: `$table->enum('field_name', ['active', 'inactive', 'pending'])->nullable();`
- **Form Field**: `type: "select"` with custom options
- **Example**: `status:boolean-active.inactive.pending`

#### Tiny Integer with Custom Options
- **Command**: `field_name:tinyint-high.medium.low`
- **Migration**: `$table->enum('field_name', ['high', 'medium', 'low'])->nullable();`
- **Form Field**: `type: "select"` with custom options
- **Example**: `priority:tinyint-high.medium.low`

### 5. Date and Time Types

#### Date
- **Command**: `field_name:date`
- **Migration**: `$table->date('field_name')->nullable();`
- **Form Field**: `type: "date"`
- **Example**: `birth_date:date`

#### DateTime
- **Command**: `field_name:datetime`
- **Migration**: `$table->datetime('field_name')->nullable();`
- **Form Field**: `type: "datetime"`
- **Example**: `created_at:datetime`

#### DateTime Local
- **Command**: `field_name:datetime-local`
- **Migration**: `$table->datetime('field_name')->nullable();`
- **Form Field**: `type: "datetime"`
- **Example**: `event_time:datetime-local`

### 6. Time Types

#### Time
- **Command**: `field_name:time`
- **Migration**: `$table->time('field_name')->nullable();`
- **Form Field**: `type: "time"`
- **Example**: `start_time:time`

#### Timestamp
- **Command**: `field_name:timestamp`
- **Migration**: `$table->timestamp('field_name')->nullable();`
- **Form Field**: `type: "datetime"`
- **Example**: `last_seen:timestamp`

### 7. Numeric Types

#### Float
- **Command**: `field_name:float`
- **Migration**: `$table->float('field_name')->nullable();`
- **Form Field**: `type: "number", step: "0.01"`
- **Example**: `price:float`

#### Double
- **Command**: `field_name:double`
- **Migration**: `$table->double('field_name')->nullable();`
- **Form Field**: `type: "number", step: "0.01"`
- **Example**: `weight:double`

#### Decimal
- **Command**: `field_name:decimal`
- **Migration**: `$table->decimal('field_name')->nullable();`
- **Form Field**: `type: "number", step: "0.01"`
- **Example**: `amount:decimal`

### 8. JSON Type

#### JSON
- **Command**: `field_name:json`
- **Migration**: `$table->json('field_name')->nullable();`
- **Form Field**: `type: "textarea", placeholder: "Enter JSON data"`
- **Example**: `metadata:json`

### 9. Enum Type

#### Enum with Options
- **Command**: `field_name:enum-option1.option2.option3`
- **Migration**: `$table->enum('field_name', ['option1', 'option2', 'option3'])->nullable();`
- **Form Field**: 
  ```javascript
  type: "select",
  multiple: false,
  data_list: [
    { label: "Option1", value: "option1" },
    { label: "Option2", value: "option2" },
    { label: "Option3", value: "option3" }
  ]
  ```
- **Example**: `status:enum-active.inactive.pending`

### 10. Password Type

#### Password
- **Command**: `field_name:password`
- **Migration**: `$table->string('field_name', 100)->nullable();`
- **Form Field**: `type: "password"`
- **Example**: `password:password`

### 11. Special Types

#### Binary
- **Command**: `field_name:binary`
- **Migration**: `$table->binary('field_name')->nullable();`
- **Form Field**: `type: "file"`
- **Example**: `data:binary`

#### UUID
- **Command**: `field_name:uuid`
- **Migration**: `$table->uuid('field_name')->nullable();`
- **Form Field**: `type: "text", readonly: true`
- **Example**: `identifier:uuid`

### 12. Time Type

#### Time
- **Command**: `field_name:time`
- **Migration**: `$table->time('field_name')->nullable();`
- **Form Field**: `type: "text"`
- **Example**: `start_time:time`

**Note**: Time fields are processed as regular strings in the migration but should be used for time values.

## Command Examples

### Basic Module Creation
```bash
php artisan make:module UserManagement/User [name:string-100,email:string-255,password:password,age:integer,is_active:boolean,birth_date:date,profile_image:stringfile] --vue
```

### Table Creation with Relationships
```bash
php artisan make:table BlogManagement/Blog/BlogComment [blog_id:bigint,user_id:bigint,comment:text,rating:float,status:enum-pending.approved.rejected] --model
```

### Complex Example with Multiple Data Types
```bash
php artisan make:module CourseManagement/Course [
  title:string-255,
  description:text,
  price:float,
  duration:integer,
  start_date:date,
  schedule:json,
  is_featured:boolean,
  difficulty:enum-beginner.intermediate.advanced,
  thumbnail:stringfile,
  category_id:bigint
] --vue
```

## Default Fields Added to All Tables

Every table automatically includes these fields:
- `id` - Primary key (auto-increment)
- `creator:bigint` - User who created the record
- `slug:string(50)` - URL-friendly identifier
- `status:enum(active,inactive)` - Record status (default: active)
- `created_at` - Creation timestamp
- `updated_at` - Last update timestamp
- `deleted_at` - Soft delete timestamp

## Migration Command Format

When you create a module or table, the migration command is automatically generated:

### For Modules
```bash
php artisan migrate --path='/app/Modules/Management/ModuleName/Database/create_table_name_table.php'
```

### For Tables
```bash
php artisan migrate --path='\App\Modules\Management\ModuleName\Database\create_table_name_table.php'
```

## Form Field Properties

Each form field automatically includes:
- `name` - Field name
- `label` - Display label (auto-generated from field name)
- `type` - Input type based on data type
- `value` - Default empty value
- Additional properties based on field type (multiple, data_list, etc.)

## Data Type Processing Rules

### String Length Processing
- If no length specified: defaults to 100 characters
- Custom length: `string-255` sets length to 255
- Pattern: `string-{number}` where {number} is the desired length

### Enum Processing
- Pattern: `enum-value1.value2.value3`
- Values are split by dots (.)
- Each value becomes an option in the select dropdown
- Labels are automatically capitalized

### Boolean Processing
- `boolean` and `tinyint` are treated the same
- Migration uses `tinyInteger` with default value 0
- Form field uses radio buttons for true/false selection

## Best Practices

1. **Use appropriate data types**: Choose the most suitable type for your data
2. **Specify string lengths**: Use `string-255` instead of just `string` for better control
3. **Use enums for fixed options**: Instead of string fields for status, use `enum-active.inactive`
4. **Foreign keys**: Use `bigint` for foreign key relationships
5. **File uploads**: Use `stringfile` for single file uploads
6. **Dates**: Use `date` for dates only, `datetime` for timestamps

## Troubleshooting

### Common Issues
1. **Invalid enum format**: Make sure to use dots (.) to separate enum values
2. **String length errors**: Ensure string lengths are specified correctly with hyphen
3. **Migration path**: Check that the migration path is correct for your module structure
4. **Typo in integer**: The system accepts `intiger` as well as `integer` (common typo)

### Error Messages
- If you see `tinyInteger` in your migration, it's likely from a `boolean` or `tinyint` field type
- String length parsing errors usually indicate incorrect format (use `string-255` not `string(255)`)

### Supported Type Variations
The system is flexible and accepts multiple variations for the same type:
- **Integer**: `int`, `integer`, `intiger`, `number`
- **Big Integer**: `bigint`, `biginteger`
- **Boolean**: `boolean`, `tinyint`
- **Text**: `text`, `longtext`
- **String**: `string`, `stringfile` (for file uploads), `file`

This documentation should be updated as new data types are added to the system.

## Practical Examples from Current Project

Here are some real examples from the `command.txt` file showing how these data types are used:

### User Management
```bash
php artisan make:table UserManagement/User/UserAddress [user_id:bigint,phone_number:json,address:text,country:string-255,city:string-255,state:string-255,post:string-255] --model
```

### Blog Management
```bash
php artisan make:module BlogManagement/Blog [blog_category_id:bigint,title:string-100,description:text,tags:text,publish_date:datetime,writer:string-100,thumbnail_image:string-100,images:text,blog_type:string-100,url:string-100,show_top:string-100,contributors:json,is_featured:boolean,is_published:boolean] --vue
```

### Quiz Management
```bash
php artisan make:module QuizManagement/QuizQuestion [quiz_question_topic_id:bigint,title:string-255,question_level:enum-easy.medium.hard,mark:float,is_multiple:boolean,session_year:string-20] --vue
```

### Contact Management
```bash
php artisan make:module CommunicationManagement/ContactMessage [full_name:string-100,email:string-100,subject:string-255,message:text,is_seen:boolean] --vue
```

### Course Management
```bash
php artisan make:module CourseManagement/CourseBatch [course_id:bigint,batch_name:string-100,admission_start_date:datetime,admission_end_date:datetime,batch_student_limit:bigint,seat_booked:int,booked_percent:float,after_discount_price:float,first_class_date:datetime,class_days:string-255,class_start_time:time,class_end_time:time,show_percentage_on_cards:enum-yes.no] --vue
```

## Testing Your Data Types

To test if your data types are working correctly:

### Comprehensive Test Command

Here's a single command that tests ALL supported data types:

```bash
php artisan make:module TestModule/ComprehensiveDataTypeTest [
  basic_string:string,
  long_string:string-255,
  short_string:string-50,
  description:text,
  long_content:longtext,
  basic_number:number,
  quantity:integer,
  count:int,
  typo_integer:intiger,
  user_id:bigint,
  category_id:biginteger,
  priority:tinyint,
  is_active:boolean,
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

### Simplified Test Command

For quick testing with most common types:

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

### Table Test Command

Test with a relational table:

```bash
php artisan make:table TestModule/ComprehensiveTest/TestRelation [
  parent_id:bigint,
  title:string-200,
  content:longtext,
  rating:float,
  is_featured:boolean,
  publish_date:datetime,
  tags:json,
  type:enum-public.private.draft,
  thumbnail:stringfile
] --model
```

### Step-by-Step Testing Process

1. **Create a test module**:
```bash
php artisan make:module TestModule/ComprehensiveDataTypeTest [basic_string:string,long_string:string-255,short_string:string-50,description:text,long_content:longtext,basic_number:number,quantity:integer,count:int,typo_integer:intiger,user_id:bigint,category_id:biginteger,priority:tinyint,is_active:boolean,price:float,weight:double,amount:decimal,birth_date:date,created_at:datetime,event_time:datetime-local,start_time:time,last_seen:timestamp,metadata:json,status:enum-active.inactive.pending,difficulty:enum-easy.medium.hard,avatar:stringfile,document:file,binary_data:binary,identifier:uuid,user_password:password] --vue
```

2. **Check the generated migration** in `app/Modules/Management/TestModule/Database/`

3. **Check the generated form fields** in the Vue component files

4. **Run the migration**:
```bash
php artisan migrate --path='/app/Modules/Management/TestModule/Database/create_comprehensive_data_type_tests_table.php'
```

### Expected Migration Output

The migration should contain:
```php
$table->id();
$table->string('basic_string', 100)->nullable();
$table->string('long_string', 255)->nullable();
$table->string('short_string', 50)->nullable();
$table->text('description')->nullable();
$table->text('long_content')->nullable();
$table->integer('basic_number')->nullable();
$table->integer('quantity')->nullable();
$table->integer('count')->nullable();
$table->integer('typo_integer')->nullable();
$table->bigInteger('user_id')->nullable();
$table->bigInteger('category_id')->nullable();
$table->tinyInteger('priority')->default(0);
$table->tinyInteger('is_active')->default(0);
$table->float('price')->nullable();
$table->double('weight')->nullable();
$table->decimal('amount')->nullable();
$table->date('birth_date')->nullable();
$table->datetime('created_at')->nullable();
$table->datetime('event_time')->nullable();
$table->time('start_time')->nullable();
$table->timestamp('last_seen')->nullable();
$table->json('metadata')->nullable();
$table->enum('status', ['active','inactive','pending'])->nullable();
$table->enum('difficulty', ['easy','medium','hard'])->nullable();
$table->string('avatar', 100)->nullable();
$table->string('document', 100)->nullable();
$table->binary('binary_data')->nullable();
$table->uuid('identifier')->nullable();
$table->string('user_password', 100)->nullable();
// ... default fields
```

### Expected Form Field Output

The form fields should include various input types:
- Text inputs for strings
- Textareas for text/longtext
- Number inputs for integers/floats
- Radio buttons for boolean
- Date/datetime inputs
- Select dropdowns for enums
- File inputs for uploads
- Password inputs for passwords

## Migration File Locations

- **Modules**: `/app/Modules/Management/{ModuleName}/Database/create_{table_name}_table.php`
- **Tables**: `/app/Modules/Management/{ModuleName}/Database/create_{table_name}_table.php`

## Frontend Form Field Locations

- **Vue Components**: Generated in the respective module directories
- **Form Fields**: Defined in separate `.js` files containing the form field configurations




