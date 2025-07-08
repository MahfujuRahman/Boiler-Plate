# User Activity Logging System Documentation

## Table of Contents
1. [Overview](#overview)
2. [Architecture](#architecture)
3. [Installation & Setup](#installation--setup)
4. [Usage Methods](#usage-methods)
5. [Configuration](#configuration)
6. [Examples](#examples)
7. [Best Practices](#best-practices)
8. [Troubleshooting](#troubleshooting)
9. [Performance Optimization](#performance-optimization)

## Overview

The User Activity Logging System provides comprehensive tracking of user activities across your Laravel application. It offers three different approaches to logging:

- **Middleware (Automatic)**: Logs all authenticated user requests automatically
- **Trait Methods (Easy & Clean)**: Provides convenient methods for common logging scenarios
- **Manual Events (Full Control)**: Offers complete control over what and when to log

## Architecture

### Core Components

```
app/
├── Events/
│   └── UserActivityEvent.php          # Main event class
├── Listeners/
│   └── LogUserActivity.php            # Event listener that handles logging
├── Traits/
│   └── LogsUserActivity.php           # Convenient logging methods
├── Http/
│   └── Middleware/
│       └── LogUserActivityMiddleware.php  # Automatic logging middleware
└── Modules/Management/UserManagement/User/Models/
    └── UserLogModel.php               # Database model for logs
```

### Event Flow

```
User Action → [Middleware/Trait/Manual] → UserActivityEvent → LogUserActivity Listener → Database
```

## Installation & Setup

### 1. Register Event & Listener

In `app/Providers/EventServiceProvider.php`:

```php
protected $listen = [
    \App\Events\UserActivityEvent::class => [
        \App\Listeners\LogUserActivity::class,
    ],
];
```

### 2. Register Middleware

In `app/Http/Kernel.php`:

```php
// Add to web middleware group for automatic logging
protected $middlewareGroups = [
    'web' => [
        // ... other middleware
        \App\Http\Middleware\LogUserActivityMiddleware::class,
    ],
];

// Add middleware alias for selective use
protected $middlewareAliases = [
    // ... other aliases
    'log.activity' => \App\Http\Middleware\LogUserActivityMiddleware::class,
];
```

### 3. Include Example Routes (Optional)

In `routes/web.php`:

```php
require __DIR__.'/logging_examples.php';
```

## Usage Methods

### Method 1: Middleware (Automatic Logging)

**When to use**: For comprehensive activity tracking without code changes.

**Setup**: Add middleware to routes or globally.

```php
// Global (in Kernel.php web middleware group)
\App\Http\Middleware\LogUserActivityMiddleware::class,

// Specific routes
Route::middleware(['auth', 'log.activity'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
```

**What it logs**:
- All HTTP requests from authenticated users
- Request method (GET, POST, PUT, DELETE)
- URL path and route name
- Response status code
- IP address and user agent
- Timestamp

**Automatic filtering**: Skips logging for:
- Asset files (.css, .js, .png, etc.)
- Health check endpoints
- Storage files

### Method 2: Trait Methods (Easy & Clean)

**When to use**: For specific business logic events and common patterns.

**Setup**: Add trait to your classes.

```php
use App\Traits\LogsUserActivity;

class UserController extends Controller
{
    use LogsUserActivity;
    
    public function store(Request $request)
    {
        // Your business logic
        
        // Log success
        $this->logSuccess('User created successfully', 'user_creation');
        
        // Log CRUD operation
        $this->logCrud('create', 'User', $user->id, ['email' => $user->email]);
        
        // Log authentication event
        $this->logAuth('User registration completed', 'registration');
    }
}
```

**Available Methods**:

#### Instance Methods
```php
// Success logging
$this->logSuccess($message, $actionType = 'action', $additionalData = []);

// Error logging
$this->logError($message, $actionType = 'action', $statusCode = 500, $additionalData = []);

// Info logging
$this->logInfo($message, $actionType = 'action', $additionalData = []);

// CRUD operations
$this->logCrud($operation, $model, $modelId = null, $additionalData = []);
// $operation: 'create', 'read', 'update', 'delete'

// Authentication events
$this->logAuth($message, $actionType = 'authentication', $additionalData = []);
```

#### Static Methods (for Actions/Services)
```php
// Static versions for use in static classes
self::logSuccessStatic($message, $actionType, $additionalData, $request);
self::logErrorStatic($message, $actionType, $statusCode, $additionalData, $request);
self::logCrudStatic($operation, $model, $modelId, $additionalData, $request);
self::logAuthStatic($message, $actionType, $additionalData, $request);
```

### Method 3: Manual Events (Full Control)

**When to use**: For complex scenarios requiring custom data structure.

```php
use App\Events\UserActivityEvent;

// Basic usage
event(new UserActivityEvent(
    auth()->id(),                    // User ID
    [                               // Activity data
        'title' => 'Custom Action',
        'status' => 'success',
        'status_code' => 200,
        'message' => 'Custom operation completed',
        'action_type' => 'custom_operation',
    ],
    request(),                      // Request object
    [                               // Additional data
        'custom_field' => 'value',
        'metrics' => ['time' => '2.3s']
    ]
));
```

## Configuration

### Middleware Configuration

#### Skip Specific Routes
Modify `LogUserActivityMiddleware.php`:

```php
private function logActivity($request, $response)
{
    $skipRoutes = [
        'api/health',
        'storage/',
        'favicon.ico',
        '.css', '.js', '.png', '.jpg',
        // Add your custom routes to skip
        'admin/logs',
        'debug',
    ];
    
    // ... rest of method
}
```

#### Custom Activity Types
Modify the `getActivityType()` method:

```php
private function getActivityType($request)
{
    $method = $request->getMethod();
    $path = $request->getPathInfo();
    
    // Custom mappings
    if (str_contains($path, '/admin/')) {
        return [
            'title' => 'Admin Panel Access',
            'message' => "Admin accessed {$path}",
            'type' => 'admin_access',
        ];
    }
    
    // ... default mappings
}
```

### Database Log Retention

Add to your `UserLogModel` or create a command:

```php
// Clean old logs (older than 90 days)
UserLogModel::where('created_at', '<', now()->subDays(90))->delete();
```

## Examples

### Example 1: E-commerce Order Processing

```php
class OrderController extends Controller
{
    use LogsUserActivity;
    
    public function store(Request $request)
    {
        DB::beginTransaction();
        
        try {
            $order = Order::create($request->validated());
            
            // Log CRUD operation
            $this->logCrud('create', 'Order', $order->id, [
                'total_amount' => $order->total,
                'items_count' => $order->items->count()
            ]);
            
            // Process payment
            $payment = $this->processPayment($order);
            
            // Manual event for payment
            event(new UserActivityEvent(
                auth()->id(),
                [
                    'title' => 'Payment Processed',
                    'status' => 'success',
                    'status_code' => 200,
                    'message' => "Payment of {$order->total} processed successfully",
                    'action_type' => 'payment_processing',
                ],
                $request,
                [
                    'order_id' => $order->id,
                    'payment_method' => $payment->method,
                    'transaction_id' => $payment->transaction_id
                ]
            ));
            
            DB::commit();
            
            return response()->json(['order' => $order]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Log error
            $this->logError(
                "Order creation failed: {$e->getMessage()}",
                'order_creation',
                500,
                ['error_type' => get_class($e)]
            );
            
            throw $e;
        }
    }
}
```

### Example 2: User Authentication

```php
class AuthController extends Controller
{
    use LogsUserActivity;
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Log successful authentication
            $this->logAuth(
                "User {$user->email} logged in successfully",
                'login',
                [
                    'login_method' => 'email_password',
                    'remember_me' => $request->has('remember')
                ]
            );
            
            return redirect()->intended('/dashboard');
        }
        
        // Log failed authentication attempt
        event(new UserActivityEvent(
            null, // No user ID for failed attempts
            [
                'title' => 'Login Attempt Failed',
                'status' => 'error',
                'status_code' => 401,
                'message' => "Failed login attempt for email: {$request->email}",
                'action_type' => 'login_failed',
            ],
            $request,
            [
                'attempted_email' => $request->email,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]
        ));
        
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
}
```

### Example 3: API with Combined Logging

```php
class ApiController extends Controller
{
    use LogsUserActivity;
    
    /**
     * This method demonstrates all three logging approaches
     */
    public function complexOperation(Request $request)
    {
        // 1. Middleware automatically logs the API request
        
        // 2. Manual event for operation start
        $operationId = uniqid();
        event(new UserActivityEvent(
            auth()->id(),
            [
                'title' => 'Complex API Operation Started',
                'status' => 'info',
                'status_code' => 200,
                'message' => 'Starting complex data processing operation',
                'action_type' => 'api_operation_start',
            ],
            $request,
            [
                'operation_id' => $operationId,
                'start_time' => microtime(true),
                'request_size' => strlen(json_encode($request->all()))
            ]
        ));
        
        try {
            // Process data
            $results = $this->processComplexData($request->all());
            
            // 3. Trait logging for success
            $this->logSuccess(
                "Complex operation completed successfully",
                'api_complex_operation',
                [
                    'operation_id' => $operationId,
                    'records_processed' => count($results),
                    'execution_time' => microtime(true) - microtime(true)
                ]
            );
            
            return response()->json(['results' => $results]);
            
        } catch (\Exception $e) {
            // 4. Combined error logging
            $this->logError(
                "Complex operation failed: {$e->getMessage()}",
                'api_complex_operation',
                500,
                ['operation_id' => $operationId]
            );
            
            // Additional manual error event
            event(new UserActivityEvent(
                auth()->id(),
                [
                    'title' => 'Critical API Operation Failure',
                    'status' => 'critical',
                    'status_code' => 500,
                    'message' => "Critical failure in operation {$operationId}",
                    'action_type' => 'api_critical_error',
                ],
                $request,
                [
                    'operation_id' => $operationId,
                    'exception_class' => get_class($e),
                    'stack_trace' => $e->getTraceAsString()
                ]
            ));
            
            return response()->json(['error' => 'Operation failed'], 500);
        }
    }
}
```

## Best Practices

### 1. Choose the Right Method

| Scenario | Recommended Method | Reason |
|----------|-------------------|---------|
| Page views, navigation | Middleware | Automatic, no code changes needed |
| CRUD operations | Trait methods | Clean, standardized logging |
| Business logic events | Manual events | Full control over data structure |
| Error handling | Trait + Manual | Trait for simple errors, manual for complex |
| Authentication events | Trait methods | Built-in auth logging methods |

### 2. Data Structure Guidelines

```php
// Good: Structured, searchable data
[
    'user_id' => 123,
    'order_id' => 456,
    'amount' => 99.99,
    'payment_method' => 'credit_card'
]

// Avoid: Unstructured strings
[
    'details' => 'User 123 paid $99.99 for order 456 with credit card'
]
```

### 3. Performance Considerations

```php
// Use queued events for heavy operations
// In EventServiceProvider.php
protected $listen = [
    UserActivityEvent::class => [
        LogUserActivity::class . '@shouldQueue',
    ],
];

// Or implement ShouldQueue in the listener
class LogUserActivity implements ShouldQueue
{
    // ...
}
```

### 4. Sensitive Data Handling

```php
// Don't log sensitive information
$this->logSuccess('Password changed successfully', 'password_change', [
    'user_id' => $user->id,
    // Don't include: 'new_password' => $newPassword
]);

// Log metadata instead
$this->logSuccess('Credit card updated', 'payment_method_update', [
    'card_last_four' => '****' . substr($cardNumber, -4),
    // Don't include: 'card_number' => $cardNumber
]);
```

## Troubleshooting

### Common Issues

#### 1. Events Not Being Logged

**Problem**: Events are fired but not logged to database.

**Solutions**:
```bash
# Check if event is registered
php artisan event:list

# Clear cache
php artisan config:clear
php artisan cache:clear

# Check listener exists
php artisan make:listener LogUserActivity --event=UserActivityEvent
```

#### 2. Middleware Not Working

**Problem**: Automatic logging not happening.

**Check**:
- Middleware is registered in `Kernel.php`
- Routes have the middleware applied
- User is authenticated

```php
// Debug middleware
public function handle(Request $request, Closure $next)
{
    \Log::info('Middleware triggered for: ' . $request->path());
    
    $response = $next($request);
    
    if (auth()->check()) {
        \Log::info('User authenticated, logging activity');
        $this->logActivity($request, $response);
    } else {
        \Log::info('User not authenticated, skipping log');
    }
    
    return $response;
}
```

#### 3. Database Connection Issues

**Problem**: Logging fails due to database errors.

**Solution**: Add error handling in listener:

```php
public function handle(UserActivityEvent $event)
{
    try {
        UserLogModel::create([...]);
    } catch (\Exception $e) {
        // Fallback to file logging
        \Log::channel('activity')->error('Failed to log to database', [
            'error' => $e->getMessage(),
            'user_id' => $event->userId,
            'activity' => $event->activity
        ]);
    }
}
```

### Debug Mode

Add this to your `.env` for debugging:

```env
LOG_LEVEL=debug
LOG_CHANNEL=stack
```

Create a debug route:

```php
Route::get('/debug-logging', function() {
    if (!app()->environment('local')) {
        abort(403);
    }
    
    // Test manual event
    event(new UserActivityEvent(auth()->id(), [
        'title' => 'Debug Test',
        'message' => 'Testing logging system',
        'action_type' => 'debug'
    ]));
    
    return 'Event fired - check logs table';
});
```

## Performance Optimization

### 1. Queue Events

```php
// In your listener
class LogUserActivity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public function handle(UserActivityEvent $event)
    {
        // This will be processed in background
        UserLogModel::create([...]);
    }
}
```

### 2. Batch Logging

```php
// Collect logs and insert in batches
class BatchLogUserActivity
{
    protected static $logBatch = [];
    
    public function handle(UserActivityEvent $event)
    {
        self::$logBatch[] = [
            'user_id' => $event->userId,
            'log_details' => json_encode($event->activity),
            'created_at' => now(),
        ];
        
        // Insert batch when it reaches certain size
        if (count(self::$logBatch) >= 100) {
            UserLogModel::insert(self::$logBatch);
            self::$logBatch = [];
        }
    }
}
```

### 3. Log Rotation

Create a scheduled command:

```php
// In console/Kernel.php
protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        // Keep only last 30 days of logs
        UserLogModel::where('created_at', '<', now()->subDays(30))->delete();
    })->daily();
}
```

### 4. Selective Middleware

```php
// Apply logging only to specific routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    // Only log admin activities
    Route::middleware(['log.activity'])->prefix('admin')->group(function () {
        Route::resource('users', UserController::class);
    });
});
```

---

## Quick Reference

### Trait Methods Cheat Sheet

```php
// Success logging
$this->logSuccess('Operation completed', 'operation_type');

// Error logging  
$this->logError('Operation failed', 'operation_type', 500);

// CRUD logging
$this->logCrud('create', 'ModelName', $id);

// Auth logging
$this->logAuth('User logged in', 'login');

// Custom logging
$this->logActivity([
    'title' => 'Custom Title',
    'status' => 'success',
    'message' => 'Custom message',
    'action_type' => 'custom'
]);
```

### Manual Event Template

```php
event(new UserActivityEvent(
    auth()->id(),           // User ID
    [                      // Activity data
        'title' => '',
        'status' => '',     // success, error, info, warning
        'status_code' => 200,
        'message' => '',
        'action_type' => ''
    ],
    request(),             // Request object
    []                     // Additional data
));
```

This documentation covers all aspects of the user activity logging system. For additional support or custom implementations, refer to the example files created in your project.
