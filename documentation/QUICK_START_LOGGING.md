# User Activity Logging - Quick Start Guide

## 🚀 Get Started in 5 Minutes

### Step 1: Enable Automatic Logging (Already Done!)
Your middleware is already registered and will automatically log all authenticated user activities.

### Step 2: Test the System

Visit any authenticated route in your app - it's automatically being logged!

Or test with the example routes:
```
GET /logging-examples/automatic
POST /logging-examples/trait  
PUT /logging-examples/manual
```

### Step 3: Add Custom Logging to Your Controllers

```php
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\LogsUserActivity;  // Add this

class YourController extends Controller
{
    use LogsUserActivity;  // Add this
    
    public function store(Request $request)
    {
        // Your existing code...
        $user = User::create($request->validated());
        
        // Add this line for logging
        $this->logCrud('create', 'User', $user->id);
        
        return response()->json($user);
    }
    
    public function update(Request $request, $id)
    {
        // Your existing code...
        $user = User::findOrFail($id);
        $user->update($request->validated());
        
        // Add this line for logging
        $this->logCrud('update', 'User', $user->id);
        
        return response()->json($user);
    }
}
```

## 🎯 Common Use Cases

### 1. Simple Success/Error Logging
```php
try {
    // Your code here
    $result = $this->doSomething();
    
    $this->logSuccess('Operation completed successfully');
    
} catch (\Exception $e) {
    $this->logError('Operation failed: ' . $e->getMessage());
    throw $e;
}
```

### 2. Authentication Events
```php
// In your login controller
public function login(Request $request)
{
    if (Auth::attempt($credentials)) {
        $this->logAuth('User logged in successfully', 'login');
        return redirect('/dashboard');
    }
    
    $this->logAuth('Failed login attempt', 'login_failed');
    return back()->withErrors(['email' => 'Invalid credentials']);
}
```

### 3. Important Business Actions
```php
public function processPayment(Request $request)
{
    $payment = $this->paymentService->process($request->all());
    
    // Log with additional context
    $this->logSuccess(
        "Payment of ${$payment->amount} processed successfully",
        'payment_processing',
        [
            'payment_id' => $payment->id,
            'amount' => $payment->amount,
            'method' => $payment->method
        ]
    );
}
```

## 📊 View Your Logs

Your logs are stored in the `user_logs` table. Here's how to view them:

### In Laravel Tinker:
```php
php artisan tinker

// Get recent logs
$logs = App\Modules\Management\UserManagement\User\Models\UserLogModel::latest()->take(10)->get();

// View log details
foreach($logs as $log) {
    echo "User: {$log->user_id} | " . json_decode($log->log_details)->message . "\n";
}
```

### Create a Simple Admin View:
```php
// In a controller
public function activityLogs()
{
    $logs = UserLogModel::with('user')
        ->latest()
        ->paginate(50);
        
    return view('admin.activity-logs', compact('logs'));
}
```

## 🛠️ Customization

### Skip Logging for Specific Routes
Edit `app/Http/Middleware/LogUserActivityMiddleware.php`:

```php
$skipRoutes = [
    'api/health',
    'storage/',
    'favicon.ico',
    // Add your routes here
    'admin/logs',
    'api/internal',
];
```

### Add More Detail to Automatic Logging
In the same file, modify `getActivityType()`:

```php
private function getActivityType($request)
{
    $path = $request->getPathInfo();
    
    // Custom route handling
    if (str_contains($path, '/admin/')) {
        return [
            'title' => 'Admin Action',
            'message' => "Admin accessed {$path}",
            'type' => 'admin_access',
        ];
    }
    
    // Your custom logic here...
}
```

## 🔧 Advanced Usage

### For Static Classes (like your Actions)
```php
use App\Traits\LogsUserActivity;

class YourAction
{
    use LogsUserActivity;
    
    public static function execute($request)
    {
        try {
            // Your code...
            
            // Static logging
            self::logSuccessStatic(
                'Action completed',
                'action_type',
                ['data' => 'additional info'],
                $request
            );
            
        } catch (\Exception $e) {
            self::logErrorStatic(
                'Action failed: ' . $e->getMessage(),
                'action_type',
                500,
                ['error' => $e->getMessage()],
                $request
            );
        }
    }
}
```

### Full Control with Manual Events
```php
use App\Events\UserActivityEvent;

// When you need complete control
event(new UserActivityEvent(
    auth()->id(),
    [
        'title' => 'Custom Complex Action',
        'status' => 'success',
        'status_code' => 200,
        'message' => 'Something very specific happened',
        'action_type' => 'complex_business_logic',
    ],
    request(),
    [
        'custom_field_1' => 'value1',
        'metrics' => ['processing_time' => '2.3s'],
        'business_data' => ['order_id' => 123]
    ]
));
```

## 📈 Performance Tips

### 1. Use Queues for Heavy Logging
```bash
# Enable queues
php artisan queue:table
php artisan migrate
php artisan queue:work
```

### 2. Clean Old Logs Regularly
Add to your scheduler (`app/Console/Kernel.php`):

```php
protected function schedule(Schedule $schedule)
{
    // Keep only 30 days of logs
    $schedule->call(function () {
        UserLogModel::where('created_at', '<', now()->subDays(30))->delete();
    })->daily();
}
```

## 🎉 You're All Set!

The system is now:
- ✅ Automatically logging all user activities
- ✅ Ready for custom logging in your controllers
- ✅ Configured for optimal performance
- ✅ Storing detailed activity data

### What's Being Logged Automatically:
- Page visits and navigation
- Form submissions
- API calls
- File uploads
- User authentication
- All HTTP requests from authenticated users

### Need Help?
- Check the full documentation: `documentation/USER_ACTIVITY_LOGGING.md`
- Test with example routes: `/logging-examples/*`
- View logs in database table: `user_logs`

Happy logging! 🎯
