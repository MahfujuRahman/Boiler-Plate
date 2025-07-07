<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Controllers\Frontend\FrontendController;
use App\Modules\Controllers\Frontend\Auth\AuthController as FrontendAuthController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\CourseManagerController;
use App\Http\Controllers\Auth\WebsiteCoreInformationController;
use App\Http\Controllers\Auth\CounselingController;
use App\Http\Controllers\Auth\SeminarController;
use App\Http\Controllers\Auth\ProfileController;
use App\Models\Course\Course;
use App\Models\Quiz\Quiz;
use App\Models\Quiz\QuizQuestion;
use App\Models\Quiz\QuizQuestionOption;



Route::get('/', [FrontendController::class, 'HomePage'])->name('HomePage');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [FrontendAuthController::class, 'LoginPage'])->name('LoginPage');
Route::get('/register', [FrontendAuthController::class, 'RegisterPage'])->name('RegisterPage');
Route::get('/forgot-password', [FrontendAuthController::class, 'ForgotPassword'])->name('ForgotPassword');


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Website Routes
// Route::get('/', [WebsiteController::class, 'index'])->name("website");
Route::get('/about', [WebsiteController::class, 'about'])->name("about");
Route::get('/contact', [WebsiteController::class, 'contact'])->name("contact");
Route::post('/contact', [WebsiteController::class, 'contact_submit'])->name("contact_submit");
Route::get('/courses', [WebsiteController::class, 'courses'])->name("courses");
Route::get('/course/{slug}', [WebsiteController::class, 'course_details'])->name("course_details");

Route::get('/gallery', [WebsiteController::class, 'gallery'])->name("gallery");
Route::get('/blog', [WebsiteController::class, 'blog'])->name("blog");
Route::get('/blog/{slug}', [WebsiteController::class, 'blog_details'])->name("blog_details");
Route::get('/seminar', [WebsiteController::class, 'seminar'])->name("seminar");
Route::get('/seminar/details/{id}', [WebsiteController::class, 'seminar_details'])->name("seminar.details");
Route::get('/it-solution-services', [WebsiteController::class, 'it_solution_services'])->name("it_solution_services");
Route::post('/seminar-registration', [WebsiteController::class, 'registerSeminar'])->name("registerSeminar");

Route::get('/teacher/{teacher_name}/{slug}', [WebsiteController::class, 'teacher_details'])->name("teacher.details");
Route::get('/trainers', [WebsiteController::class, 'trainer_details'])->name("trainer.details");
Route::get('/stories', [WebsiteController::class, 'stories'])->name("stories");
Route::post('/career-counseling', [WebsiteController::class, 'career_counseling'])->name("career.counseling");

// Policy Routes
Route::get('/privacy-policy', [WebsiteController::class, 'privacy_policy'])->name("privacy.policy");
Route::get('/refund-policy', [WebsiteController::class, 'refund_policy'])->name("refund.policy");
Route::get('/cookies-policy', [WebsiteController::class, 'cookies_policy'])->name("cookies.policy");
Route::get('/terms-policy', [WebsiteController::class, 'terms_policy'])->name("terms.policy");
Route::get('/affiliation', [WebsiteController::class, 'affiliation'])->name("affiliation.policy");
Route::get('/sitemap', [WebsiteController::class, 'sitemap'])->name("sitemap.policy");

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/course/enroll/{slug}', [WebsiteController::class, 'course_enroll'])->name("course_enroll");
    Route::post('/course/enroll/submit/{slug}', [WebsiteController::class, 'course_enroll_submit'])->name("course_enroll_submit");

    // User Course Routes
    Route::get('/my-course', [WebsiteController::class, 'myCourse'])->name("myCourse");
    Route::get('/my-course/{slug}', [WebsiteController::class, 'myCourseDetails'])->name("mycourse_details");
    Route::get('/quizes', [WebsiteController::class, 'quizes'])->name("website.quizes");
    Route::get('/quiz-attend/{id}', [WebsiteController::class, 'quiz_attend'])->name("website.quiz_attend");
    Route::get('/quizes/details/{id}', [WebsiteController::class, 'quiz_details'])->name("website.quizes.details");
    Route::any('/quiz-submit', [WebsiteController::class, 'quiz_submit'])->name("quiz_submit");

    // Course Manager Routes
    Route::prefix('course-manager')->group(function () {
        Route::get('/', [CourseManagerController::class, 'dashboard'])->name("course_manager_dashboard");
        Route::get('/courses', [CourseManagerController::class, 'courses'])->name("course_manager_courses");
        Route::get('/quizes', [CourseManagerController::class, 'quizes'])->name("course_manager_quizes");
        Route::get('/teachers', [CourseManagerController::class, 'teachers'])->name("course_manager_teacher");
        Route::get('/gallerycs', [CourseManagerController::class, 'gallerycs'])->name("course_manager_gallerycs");
        Route::get('/gallery', [CourseManagerController::class, 'gallery'])->name("course_manager_gallery");
    });

    // Website Core Routes
    Route::prefix('website-core')->group(function () {
        Route::get('/', [WebsiteCoreInformationController::class, 'webiste_core'])->name("website_core");
    });

    // Website Brand Routes
    Route::prefix('website-brand')->group(function () {
        Route::get('/', [WebsiteCoreInformationController::class, 'webiste_brand'])->name("webiste_brand");
    });

    // Website Banner Routes
    Route::prefix('website-banner')->group(function () {
        Route::get('/', [WebsiteCoreInformationController::class, 'webiste_banner'])->name("webiste_banner");
    });

    // Career Counseling Routes
    Route::prefix('career-counseling')->group(function () {
        Route::get('/', [CounselingController::class, 'career_counseling'])->name("career_counseling");
    });

    // Backend Seminar Routes
    Route::prefix('backend/seminar')->group(function () {
        Route::get('/', [SeminarController::class, 'seminar'])->name("backend.seminar");
    });
});

// Auth Routes
// Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_submit'])->name('login_sumbit');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register-sumbit', [AuthController::class, 'register_sumbit'])->name('register_sumbit');

Route::post('logout', [AuthController::class, 'logout_submit'])->name('logout');

// Profile Routes
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::post('/profile', [ProfileController::class, 'profileUpdate'])->name('update_profile');

// Dashboard Route
Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->name('dashboard')->middleware('auth');

// Test Routes
Route::get('/tests', function () {
    $quiz = Quiz::where('id', 1)->with([
        'questions' => function ($q) {
            $q->with([
                'options' => function ($q) {
                    $q->select(['id', 'quiz_id', 'question_id', 'title']);
                },
            ]);
        }
    ])->first();
    return view('quiz', compact('quiz'));
});

Route::post('/qsubmit', function () {
    $corrects = [];
    $total = 0;

    $quiz = Quiz::find(request()->quiz_id);

    foreach (request()->submission as $question_id => $submission_ids) {
        sort($submission_ids);
        $correct_answers = QuizQuestionOption::where('question_id', $question_id)->where('is_correct', 1)
            ->get()->map(function ($i) {
                return $i->id;
            })->toArray();

        $question = QuizQuestion::find($question_id);

        $corrects[] = [
            $question_id => $submission_ids == $correct_answers,
            "mark" => $question->mark,
            "correct" => $correct_answers,
            "given" => $submission_ids,
        ];
        if ($submission_ids == $correct_answers) {
            $total += $question->mark;
        }
    }
    dd(request()->all(), $corrects, $total, $quiz->questions()->count());
})->name('qsubmit');