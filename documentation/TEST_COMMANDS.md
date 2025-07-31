# Test C`````bash
php artisan make:module TestModule/ComprehensiveDataTypeTest [basic_string:string,long_string:string-255,short_string:string-50,description:text,long_content:longtext,basic_number:number,quantity:integer,count:int,typo_integer:intiger,user_id:bigint,category_id:biginteger,priority:tinyint,priority_custom:tinyint-high.medium.low,unsigned_count:unsigned_int,unsigned_id:unsignedInteger,birth_year:year,is_active:boolean,status_custom:boolean-active.inactive.pending,price:float,weight:double,amount:decimal,birth_date:date,created_at:datetime,event_time:datetime-local,start_time:time,last_seen:timestamp,metadata:json,status:enum-active.inactive.pending,difficulty:enum-easy.medium.hard,avatar:stringfile,document:file,binary_data:binary,identifier:uuid,user_password:password] --vue
```sh
php artisan make:module TestModule/ComprehensiveDataTypeTest [basic_string:string,long_string:string-255,short_string:string-50,description:text,long_content:longtext,basic_number:number,quantity:integer,count:int,typo_integer:intiger,user_id:bigint,category_id:biginteger,priority:tinyint,unsigned_count:unsigned_int,unsigned_id:unsignedInteger,birth_year:year,is_active:boolean,price:float,weight:double,amount:decimal,birth_date:date,created_at_fju:datetime,event_time:datetime-local,start_time:time,last_seen:timestamp,metadata:json,status_fhdj:enum-active.inactive.pending,difficulty:enum-easy.medium.hard,avatar:stringfile,document:file,binary_data:binary,identifier:uuid,user_password:password] --vue
```ands for Data Types

This file contains ready-to-use test commands for validating all supported data types in the Laravel module generation system.

## Complete Data Type Test Command

### Single Line Command (Copy & Paste Ready)

```bash
php artisan make:module TestModule/ComprehensiveDataTypeTest [basic_string:string,long_string:string-255,short_string:string-50,description:text,long_content:longtext,basic_number:number,quantity:integer,count:int,typo_integer:intiger,user_id:bigint,category_id:biginteger,priority:tinyint,is_active:boolean,price:float,weight:double,amount:decimal,birth_date:date,created_at_jgjkl:datetime,event_time:datetime-local,start_time:time,last_seen:timestamp,metadata:json,status_test:enum-active.inactive.pending,difficulty:enum-easy.medium.hard,avatar:stringfile,document:file,binary_data:binary,identifier:uuid,user_password:password] --vue
```

### Formatted Command (Readable)

```bash
php artisan make:module TestModule/ComprehensiveDataTypeTest [basic_string:string,
long_string:string-255,short_string:string-50,description:text,long_content:longtext,basic_number:number,quantity:integer,count:int,typo_integer:intiger,user_id:bigint,category_id:biginteger,priority:tinyint,unsigned_count:unsigned_int,unsigned_id:unsignedInteger,birth_year:year,is_active:boolean,price:float,weight:double,amount:decimal,birth_date:date,created_at:datetime,event_time:datetime-local,start_time:time,last_seen:timestamp,metadata:json,status_test:enum-active.inactive.pending,difficulty:enum-easy.medium.hard,avatar:stringfile,document:file,binary_data:binary,identifier:uuid,user_password:password] --vue
```

## Quick Test Commands

### Essential Data Types Only

```bash
php artisan make:module TestModule/QuickTest [name:string-100,email:string-255,description:text,age:integer,user_id:bigint,is_active:boolean,price:float,birth_date:date,created_at:datetime,metadata:json,status:enum-active.inactive,avatar:stringfile,password:password] --vue
```

### String Types Test

```bash
php artisan make:module TestModule/StringTest [basic_string:string,long_string:string-255,short_string:string-50,file_path:stringfile,document:file,password:password] --vue
```

### Numeric Types Test

```bash
php artisan make:module TestModule/NumericTest [count:integer,big_id:bigint,tiny_flag:tinyint,unsigned_count:unsigned_int,unsigned_id:unsignedInteger,birth_year:year,is_active:boolean,price:float,weight:double,amount:decimal] --vue
```

### Date/Time Types Test

```bash
php artisan make:module TestModule/DateTimeTest [birth_date:date,created_at:datetime,event_time:datetime-local,start_time:time,last_seen:timestamp] --vue
```

### Boolean and TinyInt Test

```bash
php artisan make:module TestModule/BooleanTest [is_active:boolean,is_featured:boolean,status:boolean-active.inactive.pending,priority:tinyint,level:tinyint-high.medium.low,flag:tinyint-yes.no] --vue
```

### Special Types Test

```bash
php artisan make:module TestModule/SpecialTest [metadata:json,status:enum-active.inactive.pending,binary_data:binary,identifier:uuid] --vue
```

## Table Test Commands

### Comprehensive Table Test

```bash
php artisan make:table TestModule/ComprehensiveTest/TestRelation [parent_id:bigint,title:string-200,content:longtext,rating:float,is_featured:boolean,publish_date:datetime,tags:json,type:enum-public.private.draft,thumbnail:stringfile] --model
```

### User Profile Table Test

```bash
php artisan make:table TestModule/UserProfile/UserProfileDetails [user_id:bigint,full_name:string-255,bio:text,age:integer,is_verified:boolean,profile_image:stringfile,social_links:json,account_type:enum-free.premium.enterprise,created_at:datetime] --model
```

### E-commerce Product Table Test

```bash
php artisan make:table TestModule/EcommercePr/ProductVariant [product_id:bigint,sku:string-100,name:string-255,description:text,price:float,discount_price:decimal,stock:integer,is_active:boolean,images:json,category:enum-electronics.clothing.books,created_date:datetime,updated_date:timestamp] --model
```

## Expected Results

### Migration File Location
- **Module**: `/app/Modules/Management/TestModule/Database/create_comprehensive_data_type_tests_table.php`
- **Table**: `/app/Modules/Management/TestModule/Database/create_test_relations_table.php`

### Migration Command
```bash
php artisan migrate --path='/app/Modules/Management/TestModule/Database/create_comprehensive_data_type_tests_table.php'
```

### Form Field Location
- Generated in the Vue component files within the respective module directories

## Testing Checklist

- [ ] Run the comprehensive test command
- [ ] Check migration file is generated correctly
- [ ] Verify all data types are mapped correctly
- [ ] Check form fields are generated with correct input types
- [ ] Run the migration successfully
- [ ] Test enum options are created properly
- [ ] Verify string lengths are applied correctly
- [ ] Check boolean fields default to 0
- [ ] Confirm file upload fields are configured correctly

## Common Issues to Check

1. **String Length**: Ensure `string-255` creates `string('field', 255)`
2. **Enum Format**: Check `enum-val1.val2` creates `enum('field', ['val1', 'val2'])`
3. **Boolean Default**: Verify `boolean` creates `tinyInteger('field')->default(0)`
4. **File Fields**: Confirm `stringfile` creates `string('field', 100)` with file input type
5. **JSON Fields**: Check `json` creates `json('field')` with textarea input
6. **Typo Handling**: Verify `intiger` is treated as `integer`

## Cleanup Commands

After testing, you can remove the test modules:

```bash
# Remove test migrations (if needed)
php artisan migrate:rollback --path='/app/Modules/Management/TestModule/Database/create_comprehensive_data_type_tests_table.php'

# Remove test module directories
rm -rf app/Modules/Management/TestModule/
```

## Notes

- All commands create Vue components with `--vue` flag
- Table commands create models with `--model` flag
- Default fields (id, creator, slug, status, timestamps, soft deletes) are automatically added
- All fields are nullable by default except boolean/tinyint (default: 0)
