<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Quiz\Quiz;
use App\Models\Blog\Blogs;
use App\Models\CourseType;
use App\Models\ItServices;
use App\Models\SuccessStory;
use Illuminate\Http\Request;
use App\Models\Blog\BlogTags;
use App\Models\Course\Course;
use App\Models\Quiz\QuizUser;
use App\Models\ContactMessage;
use App\Models\GalleryCategory;
use App\Models\Blog\BlogWriters;
use App\Models\CareerCounseling;
use App\Models\CourseSepciality;
use App\Models\CourseOutcomeStep;
use App\Models\EnrollInformation;
use App\Models\Quiz\QuizQuestion;
use App\Models\Seminars\Seminars;
use Illuminate\Support\Facades\DB;
use App\Models\Blog\BlogsCategories;
use App\Models\Course\CourseBatches;
use App\Models\Course\CourseCategory;
use App\Models\WebsiteCoreInformation;
use App\Models\Quiz\QuizQuestionOption;
use App\Models\Course\CourseInstructors;
use App\Models\Course\CourseBatchStudent;
use Illuminate\Support\Facades\Validator;
use App\Models\Quiz\QuizQuestionSubmission;
use App\Models\Seminars\SeminarParticipants;
use App\Models\Course\CourseModuleClassRoutines;
use App\Models\Course\CourseModuleTaskCompleteByUsers;

class WebsiteController extends Controller
{
    public function index()
    {
        $course_categories = CourseCategory::where('status', 'active')->get();

        $all = $this->all_course();
        $courses = $all['courses'];
        $course_types = $all['course_types'];

        $courseBatch = CourseBatches::active()->orderBy('id', 'DESC')->get();

        $seminar = Seminars::whereDate('date_time', '>', Carbon::today())->where('status', 'active')->get();
        $course_speciality = CourseSepciality::get();
        $course_learning_steps = CourseOutcomeStep::get();
        $success_stories = SuccessStory::limit(6)->get();

        // $banners =
        // $it_services = ItServices::get();
        return view(
            'frontend.home',
            [
                'course_categories' => $course_categories,
                'course_types' => $course_types,

                'courses' => $courses,
                "seminar" => $seminar,

                'course_speciality' => $course_speciality,
                'course_learning_steps' => $course_learning_steps,
                'success_stories' => $success_stories,
                // 'it_services' => $it_services

                'courseBatches' => $courseBatch
            ]
        );
    }

    public function all_types()
    {
        return CourseType::active()->get();
    }

    public function all_course()
    {
        $course_types = CourseType::where('status', 'active')->get();

        if (request()->slug) {
            $slug = request()->slug;

            $courseType = DB::table('course_course_types')
                ->where('course_type_id', (int) $slug)
                ->pluck('course_id') // Get an array of course_ids
                ->toArray();

            $courseIds = !empty($courseType) ? $courseType : [(int) $slug];

            $courses = Course::active()
                ->with(['course_batch' => function ($batch) {
                    $batch->orderBy('id', 'desc')->first();
                }])
                ->whereIn('id', $courseIds)
                ->paginate(6);
        } else {
            $courses = Course::active()
                ->with(['course_batch' => function ($batch) {
                    $batch->orderBy('id', 'desc')->take(1);
                }])
                ->paginate(6);
        }

        return ['courses' => $courses, 'course_types' => $course_types];
    }

    public function course_details($slug)
    {

        $data = Course::active()->where('slug', $slug)->first();

        $instructors = $data->course_instructors()->get();

        $batch_details = $data->course_batch()
            ->select([
                'id',
                'course_id',
                'admission_end_date',
                'batch_student_limit',
                'seat_booked',
                'course_price',
                'after_discount_price',
                'booked_percent'
            ])
            ->active()->orderBy('id', 'DESC')->first();

        $check_enrolled = false;
        if (auth()->check()) {
            $check_enrolled = EnrollInformation::where('student_id', auth()->user()->id)
                ->where('course_id', $data->id)->exists();
        }
        return view('frontend.pages.course_details', ['batch_details' => $batch_details, 'data' => $data, 'check_enrolled' => $check_enrolled, 'instructors' => $instructors]);
    }

    public function course_enroll($slug)
    {
        $course = Course::active()->where('slug', $slug)->select('id', 'title', 'slug', 'image')->with([
            'course_batch' => function ($q) {
                $q->select('id', 'course_id', 'course_price', 'after_discount_price')->active()->orderBy('id', 'DESC');
            }
        ])->first();

        return view('frontend.pages.course_enroll', ['course' => $course]);
    }

    public function course_enroll_submit($slug)
    {
        $this->validate(request(), [
            "trx_id" => ["required"],
        ]);

        $course = Course::active()->where('slug', $slug)->select('id', 'slug', 'title')->first();
        $batch = CourseBatches::active()->where('course_id', $course->id)
            ->orderBy('id', 'DESC')->select('id', 'batch_name')->first();

        $course_std_check = CourseBatchStudent::where('student_id', auth()->user()->id)
            ->where('batch_id', $batch->id)->where('course_id', $course->id)->exists();

        if (!$course_std_check) {
            $enroll_payment = new EnrollInformation();
            $enroll_payment->course_id = $course->id;
            $enroll_payment->student_id = auth()->user()->id;
            $enroll_payment->batch_id = $batch->id;
            $enroll_payment->trx_id = request()->trx_id;
            $enroll_payment->payment_type = 'online';
            $enroll_payment->save();

            $course_batch_student = new CourseBatchStudent();
            $course_batch_student->course_id = $enroll_payment->course_id;
            $course_batch_student->batch_id = $enroll_payment->batch_id;
            $course_batch_student->student_id = $enroll_payment->student_id;
            $course_batch_student->status = 'active';
            $course_batch_student->save();
            return redirect('/')->with('success', 'Course Enrolled Successfully!');
        } else {
            return redirect()->back()->with('warning', 'You are already enrolled!');
        }
    }

    public function type_wise_course()
    {
        // $courses = Course
        $seminar = Seminars::whereDate('date_time', '>', Carbon::today())->get();
        return view('frontend.home', compact('seminar'));
    }

    public function about()
    {
        $team_top_image = null;
        $team_related_image = null;

        $category = GalleryCategory::where('title', 'আমাদের টিম')->first();

        if ($category) {
            $team_top_image = Gallery::where('gallery_category_id', $category->id)->orderBy('top_image', 'DESC')->first();
            $team_related_image = Gallery::where('gallery_category_id', $category->id)->orderBy('top_image', 'DESC')->skip(1)->take(7)->get();
        }

        $website_about = WebsiteCoreInformation::where('status', 1)->first();
        $teachers = CourseInstructors::where('status', 'active')->with('instructor', 'courses', 'batches')->limit(3)->get();

        $all = $this->all_course();
        $courses = $all['courses'];
        $course_types = $all['course_types'];

        return view('frontend.pages.about', compact('team_top_image', 'team_related_image', 'website_about', 'teachers', 'courses', 'course_types'));
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function contact_submit(Request $request)
    {
        // dd(request()->all());
        $request->validate([
            'full_name' => ['required'],
            'subject' => ['required'],
            'email' => ['email', 'required'],
            'message' => ['string', 'required'],
        ]);


        $contact_message = new ContactMessage();
        $contact_message->full_name = request()->full_name;
        $contact_message->email = request()->email;
        $contact_message->subject = request()->subject;
        $contact_message->message = request()->message;
        $contact_message->save();

        return redirect()->back()->with('success', 'Your data has been successfully received!');
    }

    public function courses()
    {
        $course_categories = CourseCategory::where('status', 'active')->get();

        $all = $this->all_course();
        $courses = $all['courses'];
        $course_types = $all['course_types'];

        $courseBatch = CourseBatches::active()->orderBy('id', 'DESC')->get();

        return view('frontend.pages.courses', [
            'course_categories' => $course_categories,
            'course_types' => $course_types,
            'courses' => $courses,
            'courseBatches' => $courseBatch
        ]);
    }

    public function gallery()
    {
        if (request()->get('gallery_category_id')) {
            $galleryImages = Gallery::where('status', 'active')->where('gallery_category_id', request()->get('gallery_category_id'))->orderBy('top_image', 'DESC')->paginate(18);
            $galleryImages->appends('gallery_category_id', request()->gallery_category_id);
        } else {
            $galleryImages = Gallery::where('status', 'active')->orderBy('top_image', 'DESC')->paginate(18);
        }
        return view('frontend.pages.gallery', compact('galleryImages'));
    }

    public function blog()
    {

        $blog_categories = BlogsCategories::active()->get();
        $blog_tags = BlogTags::active()->get();
        $blog_writers = BlogWriters::active()->get();

        $blog_single = Blogs::where('published', 1)->where('is_featured', '1')->where('status', 'active')->latest()->first();

        $blog_single->category = $blog_single->category()->first();
        $blog_single->writer = $blog_single->writer()->first();
        // dd($blog_single);

        $blogs = Blogs::where('published', 1)
            ->select([
                'id',
                'title',
                'is_featured',
                'short_description',
                'image',
                'published',
                'slug',
                'creator',
                'created_at'
            ])
            ->where('status', 'active')->whereNotIn('id', [$blog_single->id])
            ->with(['category', 'tag', 'writer'])->paginate(6);

        // dd($blogs);

        return view('frontend.pages.blog', compact('blog_categories', 'blog_tags', 'blog_writers', 'blog_single', 'blogs'));
    }

    public function blog_details($slug)
    {
        $blog = Blogs::where('slug', $slug)->where('published', 1)
            ->where('status', 'active')
            ->with(['category', 'tag', 'writer'])->first();

        return view('frontend.pages.blog-details', compact('blog'));
    }

    public function seminar()
    {
        $seminars = Seminars::whereDate('date_time', '>', Carbon::today())->where('status', 'active')->get();
        return view('frontend.pages.seminar', compact('seminars'));
    }

    public function seminar_details($id)
    {
        $seminars = Seminars::whereDate('date_time', '>', Carbon::today())->get();
        $seminar_detail = Seminars::where('id', $id)->first();
        return view('frontend.pages.seminar-details', compact('seminars', 'seminar_detail'));
    }

    public function it_solution_services()
    {
        $it_services = ItServices::get();
        return view('frontend.pages.it_solution_services', [
            'it_services' => $it_services
        ]);
    }

    public function myCourse()
    {
        $user = User::find(auth()->user()->id);
        $userWithCourses = $user->load([
            'batchStudents' => function ($query) {
                $query->select('course_id', 'id', 'batch_id', 'student_id', 'course_percent', 'is_complete');
            },
            'batchStudents.course' => function ($query) {
                $query->select('id', 'title', 'image', 'slug');
            },
            'batchStudents.batch' => function ($q2) {
                $q2->select('id', 'batch_name', 'class_days', 'class_start_time', 'class_end_time');
            }
        ]);

        // Use collection methods to split courses based on 'is_complete'
        $completedCourses = $userWithCourses->batchStudents->where('is_complete', 'complete');
        $incompleteCourses = $userWithCourses->batchStudents->where('is_complete', 'incomplete');
        // dd($userWithCourses, $completedCourses, $incompleteCourses);

        return view('frontend.pages.mycourse', [
            'user_course' => $userWithCourses->batchStudents,
            'complete_courses' => $completedCourses,
            'incomplete_courses' => $incompleteCourses,
        ]);
    }



    public function routine_details($course_id)
    {
        $course_routines = CourseModuleClassRoutines::select('id', 'course_id', 'date')->where('course_id', $course_id)->get();
        $month = [];
        // ddd($course_routines);
        if (count($course_routines) > 0) {
            foreach ($course_routines as $course_routine) {
                // dd($course_routine->date->format('m'));
                $formated_date = $course_routine->date->format('m');
                array_push($month, $formated_date);
            }
        }

        $months = array_unique($month);
        sort($months);
        $month_wise_routines = [];
        foreach ($months as $key => $value) {
            $month_name = Carbon::parse("2023-$value-01")->format('F');
            $month_wise_routines[$month_name] = CourseModuleClassRoutines::where('course_id', $course_id)->with(['class'])->whereMonth('date', $value)->get();
        }

        return $month_wise_routines;
    }

    public function myCourseDetails($slug)
    {

        $data = Course::active()->where('slug', $slug)->select('id', 'title')->first();

        $data->routines = $this->routine_details($data->id);
        // dd($data->course_mile_stones);
        $data->course_mile_stones = $data->course_mile_stones()->orderBy('milestone_no', 'ASC')->get();
        // $data->course_module = $data->course_modules()->orderBy('module_no','ASC')->get();

        foreach ($data->course_mile_stones as $key => $mileStones) {
            $modules = $mileStones->course_modules()->orderBy('module_no', 'ASC')->get();
            $mileStones->course_modules = $modules;
            foreach ($mileStones->course_modules as $key => $module) {

                $classes = $module->classes()->get();

                foreach ($classes as $key => $class) {

                    $class_watched_check = CourseModuleTaskCompleteByUsers::where('class_id', $class->id)
                        ->where('quiz_id', null)
                        ->where('exam_id', null)
                        ->where('course_id', $data->id)
                        ->first();

                    if ($key == 0) {
                        $class->is_complete = true;
                    } else {
                        $class->is_complete = false;
                        if ($class_watched_check != null) {
                            $class->is_complete = true;
                        }
                    }

                    $class_quiz = $class->class_quiz()->with(['quiz'])->orderBy('id', 'DESC')->first();
                    $class_exam = $class->class_exam()->with(['exam'])->orderBy('id', 'DESC')->first();

                    if ($class_quiz != null) {
                        $quiz_complete_check = CourseModuleTaskCompleteByUsers::where('class_id', $class->id)
                            ->where('course_id', $data->id)
                            ->where('user_id', auth()->user()->id)
                            ->where('quiz_id', $class_quiz->quiz_id)
                            ->first();

                        $class->class_quiz = $class_quiz;

                        $class->class_quiz->is_complete = false;
                        if ($quiz_complete_check != null) {
                            $class->class_quiz->is_complete = true;
                        }
                    }

                    if ($class_exam != null) {
                        $exam_complete_check = CourseModuleTaskCompleteByUsers::where('class_id', $class->id)
                            ->where('course_id', $data->id)
                            ->where('user_id', auth()->user()->id)
                            ->where('exam_id', $class_exam->exam_id)
                            ->first();

                        $class->class_exam = $class_exam;

                        $class->class_exam->is_complete = false;
                        if ($exam_complete_check != null) {
                            $class->class_exam->is_complete = true;
                        }
                    }
                }

                $module->classes = $classes;
                // $data->course_module[$key] = $module;
            }
        }

        // ddd($data->toArray());

        return view('frontend.pages.my_course_details', ['course' => $data]);
    }

    public function registerSeminar()
    {
        $validator = Validator::make(request()->all(), [
            'full_name' => ['required'],
            'phone_number' => ['required'],
            'email' => ['email', 'nullable'],
            'address' => ['string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $seminar = new SeminarParticipants();
        $seminar->seminar_id = request()->seminar_id;
        $seminar->full_name = request()->full_name;
        $seminar->email = request()->email;
        $seminar->phone_number = request()->phone_number;
        $seminar->address = request()->address;
        $seminar->save();

        return response()->json(['message' => 'Registraiton for the seminar completed'], 200);
    }


    public function teacher_details($teacher_name, $slug)
    {

        // $teacher = CourseInstructors::where('slug', $slug)->first();
        $teacher = CourseInstructors::where('slug', $slug)->with('instructor', 'courses', 'batches')->first();

        return view('frontend.pages.teacher-details', compact('teacher'));
    }

    public function trainer_details()
    {

        // $teacher = CourseInstructors::where('slug', $slug)->first();
        // $trainers = CourseInstructors::with('instructor', 'courses', 'batches')->limit(6)->get();
        $website_about = WebsiteCoreInformation::where('status', 1)->first();
        $trainers = CourseInstructors::where('status', 'active')->with('instructor', 'courses', 'batches')->paginate(9);

        return view('frontend.pages.trainer-details', compact('website_about', 'trainers'));
    }

    public function stories()
    {

        $website_about = WebsiteCoreInformation::where('status', 1)->first();
        $trainers = CourseInstructors::where('status', 'active')->with('instructor', 'courses', 'batches')->paginate(9);
        $success_stories = SuccessStory::paginate(12);

        return view('frontend.pages.success_story_all', compact('success_stories'));
    }

    public function career_counseling()
    {
        // dd(request()->all());
        $validator = Validator::make(request()->all(), [
            'name' => ['required'],
            'email' => ['email'],
            'phone' => ['required'],
            'description' => ['required'],
            'category' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new CareerCounseling();
        $data->name = request()->name;
        $data->email = request()->email ?? '';
        $data->phone = request()->phone;
        $data->description = request()->description;
        $data->category = request()->category;
        $data->save();


        // return response()->json($data, 200);
        return response()->json(
            [
                'data' => $data,
            ],
            200
        );
    }


    public function privacy_policy()
    {
        $website_about = WebsiteCoreInformation::where('status', 1)->select('privacy_policy')->first();
        return view('frontend.pages.extra.privacy_policy', compact('website_about'));
    }

    public function refund_policy()
    {
        $website_about = WebsiteCoreInformation::where('status', 1)->select('refund_policy')->first();
        return view('frontend.pages.extra.refund_policy', compact('website_about'));
    }

    public function terms_policy()
    {
        $website_about = WebsiteCoreInformation::where('status', 1)->select('terms_condition')->first();
        return view('frontend.pages.extra.terms_policy', compact('website_about'));
    }

    public function cookies_policy()
    {
        $website_about = WebsiteCoreInformation::where('status', 1)->select('cookies_policy')->first();
        return view('frontend.pages.extra.cookies_policy', compact('website_about'));
    }

    public function affiliation()
    {
        $website_about = WebsiteCoreInformation::where('status', 1)->select('affiliation')->first();
        return view('frontend.pages.extra.affiliation', compact('website_about'));
    }

    public function sitemap()
    {
        return view('frontend.pages.extra.sitemap');
    }


    public function quizes()
    {

        // $quiz = Quiz::where('id', 1)->with([
        //     'questions' => function ($q) {
        //         $q->with([
        //             'options' => function ($q) {
        //                 $q->select(['id', 'quiz_id', 'question_id', 'title']);
        //             },
        //         ]);
        //     }
        // ])->first();
        // return response()->json($quiz);

        $user = auth()->user();

        $isAttemtQuiz = QuizQuestionSubmission::where('user_id', $user->id)->where('quiz_id', request()->quiz_id)->first();
        if ($isAttemtQuiz->quiz_id == request()->quiz_id) {
            return redirect()->route('website.quizes');
        }

        $quizes = Quiz::select(['id', 'title'])->get();


        return view('frontend.pages.quiz', compact('quizes'));
    }

    public function quiz_attend($id)
    {
        // $this->middleware('api:auth');

        $quiz = Quiz::where('id', $id)->with([
            'questions' => function ($q) {
                $q->with([
                    'options' => function ($q) {
                        $q->select(['id', 'quiz_id', 'question_id', 'title']);
                    },
                ]);
            }
        ])->first();


        return view('frontend.pages.quiz-submit', compact('quiz'));
    }

    public function quiz_submit()
    {
        // $this->middleware('api:auth');

        // $user = auth()->user();


        // $isAttemtQuiz = QuizQuestionSubmission::where('user_id', $user->id)->where('quiz_id', request()->quiz_id)->first();
        // if($isAttemtQuiz->quiz_id == request()->quiz_id) {
        //     return redirect()->route('website.quizes');
        // }



        if (isset(request()->quiz_id) && isset(request()->submission)) {

            $corrects = [];
            $total = 0;

            $entries = [];
            $quiz = Quiz::find(request()->quiz_id);
            foreach (request()->submission as $question_id => $submission_ids) {
                sort($submission_ids);
                $correct_answers = QuizQuestionOption::where('question_id', $question_id)->where('is_correct', 1)
                    ->get()->map(function ($i) {
                        return $i->id;
                    })->toArray();

                // dd(request()->correct_answers);

                $question = QuizQuestion::find($question_id);

                $corrects[] = [
                    $question_id => $submission_ids == $correct_answers,
                    "mark" => $question->mark,
                    "correct" => $correct_answers,
                    "given" => $submission_ids,
                ];

                foreach ($submission_ids as $option_id) {
                    $option = QuizQuestionOption::where('id', $option_id)->where('question_id', $question_id)->first();
                    $entries[] = [
                        "user_id" => auth()->user()->id,
                        'quiz_id' => $quiz->id,
                        'question_id' => $question->id,
                        'option_id' => (int) $option_id,
                        'is_correct' => $option->is_correct,
                    ];
                }

                // Safely accessing 'given' key
                // $last_correct = end($corrects);
                // $given = isset($last_correct['given']) ? $last_correct['given'] : null;

                // $lastIndex = count($corrects) - 1;
                // $given = $corrects[$lastIndex]['given'];

                // dd($submission_ids, $correct_answers, $corrects, $corrects[count($corrects) - 1]['correct'], $given);

                if ($submission_ids == $correct_answers) {
                    $total += $question->mark;
                }

                // $quiz_counts = $quiz->questions()->count();
            }
            // dd($entries);

            QuizQuestionSubmission::insert($entries);
            $quiz_user = new QuizUser();
            $quiz_user->user_id = auth()->user()->id;
            $quiz_user->quiz_id = $quiz->id;
            $quiz_user->mark = $total;
            $quiz_user->save();

            return redirect()->route('website.quizes.details',  ['id' => $quiz->id]);
        }

        return redirect()->back();
    }


    public function quiz_details($id)
    {
        $user_id = auth()->user()->id;
        $quiz_submissions = QuizQuestionSubmission::where('user_id', $user_id)->where('quiz_id', $id)->get();
        // return $quiz_submissions;

        $quiz = Quiz::where('id', $id)->with([
            'questions' => function ($q) {
                $q->with([
                    'options' => function ($q) {
                        $q->select(['id', 'quiz_id', 'question_id', 'title', 'is_correct']);
                    },
                ]);
            }
        ])->first();

        // return $quiz;

        $optionsByQuestion = [];
        foreach ($quiz_submissions as $quiz_submission) {
            $questionId = $quiz_submission['question_id'];
            if (!isset($optionsByQuestion[$questionId])) {
                $optionsByQuestion[$questionId] = [];
            }
            $optionsByQuestion[$questionId][] = $quiz_submission['option_id'];
        }

        foreach ($quiz['questions'] as &$question) {
            $questionId = $question['id'];
            $question['user_submissions'] = isset($optionsByQuestion[$questionId]) ? $optionsByQuestion[$questionId] : [];
        }

        unset($question);

        // return $quiz;

        return view('frontend.pages.quiz-submission-details', compact('quiz', 'quiz_submissions'));
    }
}



















// quizes {
//     $user = User::find(auth()->user()->id);
//         $userWithCourses = $user->load([
//             'batchStudents' => function ($query) {
//                 $query->select('course_id', 'id', 'batch_id', 'student_id', 'course_percent', 'is_complete');
//             },
//             'batchStudents.course' => function ($query) {
//                 $query->select('id', 'title', 'image', 'slug');
//             },
//             'batchStudents.batch' => function ($q2) {
//                 $q2->select('id', 'batch_name', 'class_days', 'class_start_time', 'class_end_time');
//             }
//         ]);

//         Use collection methods to split courses based on 'is_complete'
//         $completedCourses = $userWithCourses->batchStudents->where('is_complete', 'complete');
//         $incompleteCourses = $userWithCourses->batchStudents->where('is_complete', 'incomplete');
//         dd($userWithCourses, $completedCourses, $incompleteCourses);



//         return view('frontend.pages.quiz', [
//             'user_course' => $userWithCourses->batchStudents,
//             'complete_courses' => $completedCourses,
//             'incomplete_courses' => $incompleteCourses,
//         ]);
// }
