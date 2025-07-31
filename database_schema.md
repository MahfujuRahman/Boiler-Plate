# Database Schema for TechPark English Platform

## Core Tables

### 1. Users & Authentication
```sql
-- users table
id: bigint (PK)
first_name: varchar(100)
last_name: varchar(100)
user_name: varchar(100)
telegram_id: varchar(100)
telegram_name: text
mobile_number: varchar(20)
photo: varchar(255)
email: varchar(255)
email_verified_at: datetime
password: varchar(255)
remember_token: varchar(255)
created_at: timestamp
updated_at: timestamp

-- user_social_links table
id: bigint (PK)
user_id: bigint (FK -> users.id)
media_name: varchar(100)
link: varchar(100)
created_at: timestamp
updated_at: timestamp

-- user_contact_numbers table
id: bigint (PK)
user_id: bigint (FK -> users.id)
phone_number: varchar(45)
created_at: timestamp
updated_at: timestamp
```

### 2. Contact & Communication
```sql
-- contact_messages table
id: bigint (PK)
full_name: varchar(100)
email: varchar(100)
subject: varchar(255)
message: text
is_seen: boolean (default: 0)
created_at: timestamp
updated_at: timestamp
```

## Website Content Management

### 3. Homepage Elements
```sql
-- website_banners table
id: bigint (PK)
title: varchar(255)
subtitle: text
is_featured: boolean
image: varchar(255)
btn_one_text: varchar(50)
btn_one_url: varchar(255)
btn_two_text: varchar(50)
btn_two_url: varchar(255)
created_at: timestamp
updated_at: timestamp

-- sub_banners table
id: bigint (PK)
title: varchar(255)
image: varchar(255)
created_at: timestamp
updated_at: timestamp

-- success_stories table
id: bigint (PK)
title: varchar(255)
thumbnail_image: varchar(255)
video_link: varchar(255)
created_at: timestamp
updated_at: timestamp

-- our_specialities table
id: bigint (PK)
title: varchar(255)
image: varchar(255)
created_at: timestamp
updated_at: timestamp

-- our_trainers table
id: bigint (PK)
title: varchar(255)
description: text
image: varchar(255)
created_at: timestamp
updated_at: timestamp
```

### 4. Seminars
```sql
-- seminars table
id: bigint (PK)
title: varchar(255)
poster: varchar(255)
whatsapp_group: varchar(255)
facebook_group: varchar(255)
telegram_group: varchar(255)
details: text
date_time: datetime
promo_video: text
created_at: timestamp
updated_at: timestamp

-- seminar_participants table
id: bigint (PK)
seminar_id: bigint (FK -> seminars.id)
full_name: varchar(100)
email: varchar(50)
phone_number: varchar(20)
address: varchar(255)
created_at: timestamp
updated_at: timestamp
```

### 5. About Page Content
```sql
-- about_us table
id: bigint (PK)
title: varchar(255)
description: text
image: varchar(255)
created_at: timestamp
updated_at: timestamp

-- website_brands table
id: bigint (PK)
title: varchar(255)
image: varchar(255)
created_at: timestamp
updated_at: timestamp

-- our_motos table
id: bigint (PK)
title: varchar(255)
description: text
image: varchar(255)
created_at: timestamp
updated_at: timestamp

-- our_missions table
id: bigint (PK)
title: varchar(255)
description: text
image: varchar(255)
created_at: timestamp
updated_at: timestamp

-- our_visions table
id: bigint (PK)
title: varchar(255)
description: text
image: varchar(255)
created_at: timestamp
updated_at: timestamp

-- our_teams table
id: bigint (PK)
title: varchar(255)
description: text
image: json
created_at: timestamp
updated_at: timestamp
```

### 6. Gallery System
```sql
-- gallery_categories table
id: bigint (PK)
title: varchar(255)
description: text
created_at: timestamp
updated_at: timestamp

-- galleries table
id: bigint (PK)
gallery_category_id: bigint (FK -> gallery_categories.id)
title: varchar(255)
description: text
image: varchar(255)
top_image: boolean
created_at: timestamp
updated_at: timestamp
```

## Blog System

### 7. Blog Management
```sql
-- blog_categories table
id: bigint (PK)
title: varchar(100)
description: text
created_at: timestamp
updated_at: timestamp

-- blog_writers table
id: bigint (PK)
name: varchar(100)
created_at: timestamp
updated_at: timestamp

-- blog_tags table
id: bigint (PK)
title: varchar(150)
created_at: timestamp
updated_at: timestamp

-- blogs table
id: bigint (PK)
blog_category_id: bigint (FK -> blog_categories.id)
title: varchar(100)
description: text
tags: text
publish_date: datetime
writer: varchar(100)
meta_description: text
meta_keywords: varchar(100)
thumbnail_image: varchar(100)
images: text
blog_type: varchar(100)
url: varchar(100)
show_top: varchar(100)
contributors: json
created_at: timestamp
updated_at: timestamp

-- blog_blog_categories table (Many-to-Many)
id: bigint (PK)
blog_id: bigint (FK -> blogs.id)
blog_category_id: bigint (FK -> blog_categories.id)
created_at: timestamp
updated_at: timestamp

-- blog_comments table
id: bigint (PK)
blog_id: bigint (FK -> blogs.id)
user_id: bigint (FK -> users.id)
name: varchar(100)
email: varchar(100)
comment: text
created_at: timestamp
updated_at: timestamp

-- blog_comment_replies table
id: bigint (PK)
blog_comment_id: bigint (FK -> blog_comments.id)
comment: text
created_at: timestamp
updated_at: timestamp

-- blog_comment_blog_comment_replies table
id: bigint (PK)
blog_comment_id: bigint (FK -> blog_comments.id)
blog_comment_reply_id: bigint (FK -> blog_comment_replies.id)
created_at: timestamp
updated_at: timestamp

-- blog_metas table
id: bigint (PK)
blog_id: bigint (FK -> blogs.id)
title: varchar(150)
description: longtext
keywords: varchar(150)
image: varchar(100)
image_alter_text: varchar(150)
image_title: varchar(150)
created_at: timestamp
updated_at: timestamp

-- blog_video_links table
id: bigint (PK)
blog_id: bigint (FK -> blogs.id)
video_link: varchar(50)
created_at: timestamp
updated_at: timestamp

-- blog_views table
id: bigint (PK)
blog_id: bigint (FK -> blogs.id)
user_id: bigint (FK -> users.id)
ip: varchar(100)
created_at: timestamp
updated_at: timestamp
```

## Course Management System

### 8. Core Course Tables
```sql
-- course_types table
id: bigint (PK)
title: varchar(200)
created_at: timestamp
updated_at: timestamp

-- course_categories table
id: bigint (PK)
title: varchar(200)
image: varchar(100)
created_at: timestamp
updated_at: timestamp

-- courses table
id: bigint (PK)
title: varchar(255)
image: varchar(255)
intro_video: varchar(255)
published_at: date
is_published: boolean
what_is_this_course: text
why_is_this_course: text
course_module_text: text
type: enum('online', 'offline', 'daycare')
created_at: timestamp
updated_at: timestamp

-- course_course_categories table (Many-to-Many)
id: bigint (PK)
course_category_id: bigint (FK -> course_categories.id)
course_id: bigint (FK -> courses.id)
created_at: timestamp
updated_at: timestamp

-- course_course_types table (Many-to-Many)
id: bigint (PK)
course_type_id: bigint (FK -> course_types.id)
course_id: bigint (FK -> courses.id)
created_at: timestamp
updated_at: timestamp
```

### 9. Course Batches & Students
```sql
-- course_batches table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
batch_name: varchar(100)
admission_start_date: datetime
admission_end_date: datetime
batch_student_limit: bigint
seat_booked: int
booked_percent: float
course_price: double
course_discount: double
after_discount_price: double
first_class_date: datetime
class_days: varchar(100)
class_start_time: time
class_end_time: time
show_percentage_on_cards: enum('yes', 'no')
created_at: timestamp
updated_at: timestamp

-- course_batch_students table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
batch_id: bigint (FK -> course_batches.id)
student_id: bigint (FK -> users.id)
course_percent: float
is_complete: enum('complete', 'incomplete') default 'incomplete'
created_at: timestamp
updated_at: timestamp
```

### 10. Course Content Structure
```sql
-- course_milestones table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
milestone_no: bigint
title: varchar(200)
created_at: timestamp
updated_at: timestamp

-- course_modules table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
milestone_id: bigint (FK -> course_milestones.id)
module_no: bigint
title: varchar(100)
created_at: timestamp
updated_at: timestamp

-- course_module_classes table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
milestone_id: bigint (FK -> course_milestones.id)
course_modules_id: bigint (FK -> course_modules.id)
class_no: varchar(20)
title: text
type: enum('live', 'recorded')
class_video_link: varchar(150)
class_video_poster: varchar(100)
created_at: timestamp
updated_at: timestamp

-- course_module_class_resources table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
course_module_class_id: bigint (FK -> course_module_classes.id)
course_module_id: bigint (FK -> course_modules.id)
resource_content: text
resource_link: varchar(100)
created_at: timestamp
updated_at: timestamp

-- course_module_class_routines table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
module_id: bigint (FK -> course_modules.id)
class_id: bigint (FK -> course_module_classes.id)
date: date
time: time
topic: text
created_at: timestamp
updated_at: timestamp
```

### 11. Course Instructors
```sql
-- course_instructors table
id: bigint (PK)
user_id: bigint (FK -> users.id)
course_id: bigint (FK -> courses.id)
cover_photo: varchar(100)
full_name: varchar(100)
designation: varchar(100)
short_description: text
description: longtext
details: longtext
created_at: timestamp
updated_at: timestamp

-- course_course_instructors table (Many-to-Many)
id: bigint (PK)
instructor_id: bigint (FK -> course_instructors.id)
course_id: bigint (FK -> courses.id)
batch_id: bigint (FK -> course_batches.id)
created_at: timestamp
updated_at: timestamp
```

### 12. Course Details & Content
```sql
-- course_essential_requirements table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
title: text
created_at: timestamp
updated_at: timestamp

-- course_faqs table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
title: text
description: text
created_at: timestamp
updated_at: timestamp

-- course_for_whoms table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
title: text
created_at: timestamp
updated_at: timestamp

-- course_job_positions table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
serial: tinyint
title: text
created_at: timestamp
updated_at: timestamp

-- course_job_works table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
title: text
created_at: timestamp
updated_at: timestamp

-- course_module_at_a_glances table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
title: text
created_at: timestamp
updated_at: timestamp

-- course_outcome_steps table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
serial: int
title: varchar(100)
created_at: timestamp
updated_at: timestamp

-- course_what_you_will_gets table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
title: text
created_at: timestamp
updated_at: timestamp

-- course_why_you_learn_from_us table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
title: text
created_at: timestamp
updated_at: timestamp

-- course_you_will_learns table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
title: text
created_at: timestamp
updated_at: timestamp
```

## Quiz & Examination System

### 13. Quiz Management
```sql
-- quiz_question_topics table
id: bigint (PK)
title: varchar(200)
description: longtext
created_at: timestamp
updated_at: timestamp

-- quizzes table
id: bigint (PK)
title: varchar(255)
description: text
created_at: timestamp
updated_at: timestamp

-- quiz_questions table
id: bigint (PK)
quiz_question_topic_id: bigint (FK -> quiz_question_topics.id)
quiz_id: bigint (FK -> quizzes.id)
topic_title: varchar(200)
title: varchar(200)
mark: int
is_multiple: varchar(100)
created_at: timestamp
updated_at: timestamp

-- quiz_question_options table
id: bigint (PK)
quiz_id: bigint (FK -> quizzes.id)
question_id: bigint (FK -> quiz_questions.id)
title: varchar(191)
is_correct: boolean
created_at: timestamp
updated_at: timestamp

-- quiz_quiz_questions table (Many-to-Many)
id: bigint (PK)
quiz_id: bigint (FK -> quizzes.id)
quiz_question_id: bigint (FK -> quiz_questions.id)
created_at: timestamp
updated_at: timestamp

-- quiz_question_submissions table
id: bigint (PK)
user_id: bigint (FK -> users.id)
quiz_id: bigint (FK -> quizzes.id)
question_id: bigint (FK -> quiz_questions.id)
option_id: bigint (FK -> quiz_question_options.id)
is_correct: boolean
created_at: timestamp
updated_at: timestamp

-- quiz_users table
id: bigint (PK)
user_id: bigint (FK -> users.id)
quiz_id: bigint (FK -> quizzes.id)
mark: double
created_at: timestamp
updated_at: timestamp
```

### 14. Course Integration with Quizzes & Exams
```sql
-- course_module_class_quizzes table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
course_module_id: bigint (FK -> course_modules.id)
course_module_class_id: bigint (FK -> course_module_classes.id)
quiz_id: bigint (FK -> quizzes.id)
created_at: timestamp
updated_at: timestamp

-- course_module_class_exams table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
course_module_id: bigint (FK -> course_modules.id)
course_module_class_id: bigint (FK -> course_module_classes.id)
exam_id: bigint
created_at: timestamp
updated_at: timestamp

-- course_module_task_complete_by_users table
id: bigint (PK)
course_id: bigint (FK -> courses.id)
module_id: bigint (FK -> course_modules.id)
class_id: bigint (FK -> course_module_classes.id)
user_id: bigint (FK -> users.id)
content_id: bigint
quiz_id: bigint (FK -> quizzes.id)
exam_id: bigint
created_at: timestamp
updated_at: timestamp
```

## Key Relationships Summary

### Primary Foreign Key Relationships:
1. **Users** → UserSocialLink, UserContactNumber, BlogComment, BlogView, QuizQuestionSubmission, QuizUser, CourseBatchStudent, CourseInstructors
2. **Courses** → CourseBatch, CourseModule, CourseMilestone, CourseModuleClass, CourseInstructors, and all course detail tables
3. **Blogs** → BlogComment, BlogMeta, BlogVideoLink, BlogView
4. **Quizzes** → QuizQuestion, QuizQuestionOption, QuizQuestionSubmission, QuizUser
5. **Gallery** → GalleryCategory
6. **Seminars** → SeminarParticipant

### Many-to-Many Relationships:
- Blog ↔ BlogCategory
- Course ↔ CourseCategory
- Course ↔ CourseType
- Course ↔ CourseInstructor
- Quiz ↔ QuizQuestion
- BlogComment ↔ BlogCommentReply

This schema represents a comprehensive Learning Management System with blog, course management, quiz system, and website content management capabilities.
