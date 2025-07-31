# Whimsical Database Design Guide

## Main Entity Groups for Whimsical ERD

### 1. USER MANAGEMENT
- **users** (Central entity)
  - user_social_links
  - user_contact_numbers

### 2. WEBSITE CONTENT
- **website_banners**
- **sub_banners** 
- **success_stories**
- **our_specialities**
- **our_trainers**
- **about_us**
- **website_brands**
- **our_motos**
- **our_missions** 
- **our_visions**
- **our_teams**

### 3. COMMUNICATION
- **contact_messages**
- **seminars**
  - seminar_participants

### 4. GALLERY SYSTEM
- **gallery_categories**
- **galleries** (FK: gallery_category_id)

### 5. BLOG SYSTEM
- **blog_categories**
- **blog_writers**
- **blog_tags**
- **blogs** (FK: blog_category_id)
  - blog_blog_categories (junction table)
  - blog_comments (FK: blog_id, user_id)
    - blog_comment_replies (FK: blog_comment_id)
    - blog_comment_blog_comment_replies (junction)
  - blog_metas (FK: blog_id)
  - blog_video_links (FK: blog_id)
  - blog_views (FK: blog_id, user_id)

### 6. COURSE SYSTEM (Most Complex)
- **course_types**
- **course_categories**
- **courses** (Central course entity)
  - course_course_categories (junction)
  - course_course_types (junction)
  - course_batches (FK: course_id)
    - course_batch_students (FK: course_id, batch_id, student_id[users])
  - course_milestones (FK: course_id)
    - course_modules (FK: course_id, milestone_id)
      - course_module_classes (FK: course_id, milestone_id, course_modules_id)
        - course_module_class_resources (FK: course_id, course_module_class_id, course_module_id)
        - course_module_class_routines (FK: course_id, module_id, class_id)
        - course_module_class_quizzes (FK: course_id, course_module_id, course_module_class_id, quiz_id)
        - course_module_class_exams (FK: course_id, course_module_id, course_module_class_id)
  - course_instructors (FK: user_id, course_id)
    - course_course_instructors (junction: instructor_id, course_id, batch_id)
  - Course Detail Tables (all FK: course_id):
    - course_essential_requirements
    - course_faqs
    - course_for_whoms
    - course_job_positions
    - course_job_works
    - course_module_at_a_glances
    - course_outcome_steps
    - course_what_you_will_gets
    - course_why_you_learn_from_us
    - course_you_will_learns
  - course_module_task_complete_by_users (FK: course_id, module_id, class_id, user_id)

### 7. QUIZ & EXAMINATION
- **quiz_question_topics**
- **quizzes**
  - quiz_questions (FK: quiz_question_topic_id, quiz_id)
    - quiz_question_options (FK: quiz_id, question_id)
    - quiz_question_submissions (FK: user_id, quiz_id, question_id, option_id)
  - quiz_quiz_questions (junction)
  - quiz_users (FK: user_id, quiz_id)

## Whimsical Implementation Steps:

### Step 1: Create Main Entities
1. Start with core entities: **users**, **courses**, **blogs**, **quizzes**
2. Add primary keys (id) and timestamps to each

### Step 2: Add Relationships
1. **One-to-Many relationships:**
   - users → user_social_links, user_contact_numbers
   - courses → course_batches, course_milestones, course_modules
   - blogs → blog_comments, blog_metas, blog_views
   - quizzes → quiz_questions → quiz_question_options

2. **Many-to-Many relationships:**
   - courses ↔ course_categories (via course_course_categories)
   - courses ↔ course_types (via course_course_types)
   - blogs ↔ blog_categories (via blog_blog_categories)
   - quizzes ↔ quiz_questions (via quiz_quiz_questions)

### Step 3: Group by Color/Sections
- **Blue**: User Management
- **Green**: Course System  
- **Orange**: Blog System
- **Purple**: Quiz System
- **Gray**: Website Content
- **Yellow**: Communication

### Step 4: Key Constraints to Note
- All tables have `id` as primary key (bigint, auto-increment)
- All tables have `created_at` and `updated_at` timestamps
- Foreign keys should be `bigint` type
- Enum fields: courses.type, course_batches.show_percentage_on_cards, course_batch_students.is_complete

### Step 5: Important Indexes to Consider
- course_id on all course-related tables
- user_id on user-related tables
- blog_id on blog-related tables
- quiz_id on quiz-related tables

This structure will create a comprehensive Learning Management System database that handles:
- User management and authentication
- Course creation and management
- Student enrollment and progress tracking
- Quiz and examination system
- Blog and content management
- Website content management
- Communication and contact management
