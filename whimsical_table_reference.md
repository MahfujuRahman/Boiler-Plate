# Quick Reference: All Tables for Whimsical ERD

## 📋 Complete Table List (58 tables total)

### 👤 User Management (3 tables)
1. users
2. user_social_links  
3. user_contact_numbers

### 📚 Course System (26 tables)
4. courses
5. course_types
6. course_categories
7. course_course_categories
8. course_course_types
9. course_batches
10. course_batch_students
11. course_milestones
12. course_modules
13. course_module_classes
14. course_module_class_resources
15. course_module_class_routines
16. course_module_class_quizzes
17. course_module_class_exams
18. course_instructors
19. course_course_instructors
20. course_essential_requirements
21. course_faqs
22. course_for_whoms
23. course_job_positions
24. course_job_works
25. course_module_at_a_glances
26. course_outcome_steps
27. course_what_you_will_gets
28. course_why_you_learn_from_us
29. course_you_will_learns
30. course_module_task_complete_by_users

### 📝 Blog System (11 tables)
31. blogs
32. blog_categories
33. blog_blog_categories
34. blog_comments
35. blog_comment_replies
36. blog_comment_blog_comment_replies
37. blog_metas
38. blog_tags
39. blog_video_links
40. blog_views
41. blog_writers

### 🎯 Quiz System (7 tables)
42. quizzes
43. quiz_questions
44. quiz_question_options
45. quiz_question_submissions
46. quiz_question_topics
47. quiz_quiz_questions
48. quiz_users

### 🌐 Website Content (8 tables)
49. website_banners
50. sub_banners
51. success_stories
52. our_specialities
53. our_trainers
54. about_us
55. website_brands
56. our_motos
57. our_missions
58. our_visions
59. our_teams

### 🖼️ Gallery System (2 tables)
60. gallery_categories
61. galleries

### 📞 Communication (3 tables)
62. contact_messages
63. seminars
64. seminar_participants

## 🔗 Key Relationships to Draw

### Primary Relationships:
- **users** → user_social_links, user_contact_numbers, course_batch_students, quiz_users, blog_comments, blog_views
- **courses** → course_batches, course_milestones, course_modules, course_instructors, [all course detail tables]
- **course_milestones** → course_modules
- **course_modules** → course_module_classes
- **course_module_classes** → course_module_class_resources, course_module_class_routines, course_module_class_quizzes
- **blogs** → blog_comments, blog_metas, blog_video_links, blog_views
- **blog_comments** → blog_comment_replies
- **quizzes** → quiz_questions, quiz_users
- **quiz_questions** → quiz_question_options, quiz_question_submissions
- **gallery_categories** → galleries
- **seminars** → seminar_participants

### Many-to-Many (Junction Tables):
- course_course_categories (courses ↔ course_categories)
- course_course_types (courses ↔ course_types)  
- course_course_instructors (courses ↔ instructors ↔ batches)
- blog_blog_categories (blogs ↔ blog_categories)
- quiz_quiz_questions (quizzes ↔ quiz_questions)
- blog_comment_blog_comment_replies (comments ↔ replies)

## 🎨 Suggested Whimsical Color Scheme:
- 🔵 **Blue**: User Management
- 🟢 **Green**: Course System
- 🟠 **Orange**: Blog System  
- 🟣 **Purple**: Quiz System
- ⚫ **Gray**: Website Content
- 🔴 **Red**: Communication
- 🟡 **Yellow**: Gallery System

## 📐 Layout Suggestions:
1. **Center**: Place `users` and `courses` as central entities
2. **Left Side**: User management, Communication
3. **Right Side**: Blog system, Quiz system
4. **Top**: Website content, Gallery
5. **Bottom**: Course details and relationships

This gives you everything needed to create a comprehensive database design in Whimsical!
