# User Activity Logging API Reference

## Event Class: UserActivityEvent

### Constructor
```php
public function __construct($userId, $activity, $request = null, $additionalData = [])
```

**Parameters:**
- `$userId` (int|null): ID of the user performing the action
- `$activity` (array): Activity details structure
- `$request` (Request|null): Laravel request object (defaults to current request)
- `$additionalData` (array): Additional context data

### Activity Structure
```php
[
    'title' => 'string',           // Required: Human-readable title
    'status' => 'string',          // Required: success|error|info|warning|critical
    'status_code' => 200,          // Required: HTTP status code
    'message' => 'string',         // Required: Detailed message
    'action_type' => 'string',     // Required: Categorization slug
]
```

---

## Trait: LogsUserActivity

### Instance Methods

#### logSuccess()
```php
protected function logSuccess(
    string $message, 
    string $actionType = 'action', 
    array $additionalData = []
): void
```

**Example:**
```php
$this->logSuccess('User profile updated', 'profile_update', [
    'fields_changed' => ['name', 'email']
]);
```

#### logError()
```php
protected function logError(
    string $message, 
    string $actionType = 'action', 
    int $statusCode = 500, 
    array $additionalData = []
): void
```

**Example:**
```php
$this->logError('Payment processing failed', 'payment', 422, [
    'error_code' => 'INSUFFICIENT_FUNDS',
    'amount' => 99.99
]);
```

#### logCrud()
```php
protected function logCrud(
    string $operation,     // 'create', 'read', 'update', 'delete'
    string $model,         // Model name
    mixed $modelId = null, // Model ID
    array $additionalData = []
): void
```

**Example:**
```php
$this->logCrud('create', 'Order', $order->id, [
    'total_amount' => $order->total,
    'items_count' => $order->items->count()
]);
```

#### logAuth()
```php
protected function logAuth(
    string $message, 
    string $actionType = 'authentication', 
    array $additionalData = []
): void
```

**Example:**
```php
$this->logAuth('Two-factor authentication enabled', '2fa_enabled', [
    'method' => 'app',
    'backup_codes_generated' => true
]);
```

### Static Methods
All instance methods have static equivalents with `Static` suffix:

```php
self::logSuccessStatic($message, $actionType, $additionalData, $request);
self::logErrorStatic($message, $actionType, $statusCode, $additionalData, $request);
self::logCrudStatic($operation, $model, $modelId, $additionalData, $request);
self::logAuthStatic($message, $actionType, $additionalData, $request);
```

---

## Middleware: LogUserActivityMiddleware

### Configuration

#### Skip Routes
```php
// In LogUserActivityMiddleware.php
private $skipRoutes = [
    'api/health',
    'storage/',
    'favicon.ico',
    '.css', '.js', '.png', '.jpg', '.jpeg', '.gif', '.svg',
    // Add custom routes to skip
];
```

#### Custom Activity Types
```php
// In getActivityType() method
private function getActivityType($request)
{
    $method = $request->getMethod();
    $path = $request->getPathInfo();
    
    // Custom logic
    if (str_contains($path, '/api/v1/')) {
        return [
            'title' => 'API Call',
            'message' => "API {$method} request to {$path}",
            'type' => 'api_call',
        ];
    }
    
    // Default mappings...
}
```

### Middleware Usage

#### Global (All Routes)
```php
// In app/Http/Kernel.php
protected $middleware = [
    \App\Http\Middleware\LogUserActivityMiddleware::class,
];
```

#### Route Groups
```php
Route::middleware(['auth', 'log.activity'])->group(function () {
    // Routes that should be logged
});
```

#### Exclude from Specific Routes
```php
Route::get('/no-logging', [Controller::class, 'method'])
    ->withoutMiddleware(['log.activity']);
```

---

## Database Schema

### user_logs Table Structure
```sql
CREATE TABLE user_logs (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT NULL,
    last_seen TIMESTAMP NULL,
    log_details JSON NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    INDEX idx_user_id (user_id),
    INDEX idx_created_at (created_at),
    INDEX idx_last_seen (last_seen)
);
```

### Log Details JSON Structure
```json
{
    "title": "User Creation Successful",
    "status": "success",
    "status_code": 201,
    "message": "User 'john_doe' created successfully",
    "action_type": "user_creation",
    "ip": "192.168.1.1",
    "time": "2025-07-08 10:30:45",
    "referer": "https://example.com/users",
    "request_url": "https://example.com/api/users",
    "method": "POST",
    "user_agent": "Mozilla/5.0...",
    "additional_data": {
        "created_user_id": 123,
        "user_name": "john_doe",
        "has_social_links": true
    }
}
```

---

## Query Examples

### Retrieve Recent Activities
```php
use App\Modules\Management\UserManagement\User\Models\UserLogModel;

// Recent activities for specific user
$userLogs = UserLogModel::where('user_id', 123)
    ->latest()
    ->limit(50)
    ->get();

// Recent activities by action type
$authLogs = UserLogModel::whereJsonContains('log_details->action_type', 'authentication')
    ->latest()
    ->get();

// Error logs only
$errorLogs = UserLogModel::whereJsonContains('log_details->status', 'error')
    ->latest()
    ->get();

// Activities within date range
$todayLogs = UserLogModel::whereDate('created_at', today())
    ->get();
```

### Advanced JSON Queries
```php
// Logs with specific message pattern
$paymentLogs = UserLogModel::whereJsonContains('log_details->action_type', 'payment')
    ->where('log_details->status', 'success')
    ->get();

// Logs with additional data
$logsWithOrderId = UserLogModel::whereJsonContains('log_details->additional_data->order_id', 456)
    ->get();

// Logs by IP address
$ipLogs = UserLogModel::whereJsonContains('log_details->ip', '192.168.1.1')
    ->get();
```

---

## Action Type Categories

### Recommended Action Types

#### Authentication
- `login` - User login
- `logout` - User logout
- `password_change` - Password updated
- `2fa_enabled` - Two-factor auth enabled
- `2fa_disabled` - Two-factor auth disabled
- `registration` - New user registration

#### CRUD Operations
- `crud_create` - Record created
- `crud_read` - Record viewed
- `crud_update` - Record updated
- `crud_delete` - Record deleted

#### Business Logic
- `payment_processing` - Payment processed
- `order_creation` - Order created
- `email_sent` - Email sent
- `file_upload` - File uploaded
- `export_data` - Data exported
- `import_data` - Data imported

#### Admin Actions
- `admin_access` - Admin panel access
- `user_promotion` - User role changed
- `system_settings` - Settings modified
- `backup_created` - Backup created

#### API Operations
- `api_call` - API endpoint accessed
- `api_key_generated` - API key created
- `webhook_triggered` - Webhook fired

---

## Status Codes & Types

### Status Types
- `success` - Operation completed successfully
- `error` - Operation failed
- `info` - Informational message
- `warning` - Warning condition
- `critical` - Critical system event

### HTTP Status Code Mapping
```php
// Success operations
200 => 'success',   // OK
201 => 'success',   // Created
204 => 'success',   // No Content

// Client errors
400 => 'error',     // Bad Request
401 => 'warning',   // Unauthorized
403 => 'warning',   // Forbidden
404 => 'error',     // Not Found
422 => 'error',     // Validation Error

// Server errors
500 => 'critical',  // Internal Server Error
503 => 'critical',  // Service Unavailable
```

---

## Performance Optimization

### Queued Event Processing
```php
// Make listener queueable
class LogUserActivity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;
    
    public $queue = 'activity_logs';
    public $delay = 0;
    public $timeout = 60;
    
    public function handle(UserActivityEvent $event)
    {
        UserLogModel::create([...]);
    }
}
```

### Batch Processing
```php
// Process multiple logs at once
class BatchLogProcessor
{
    private static $batch = [];
    private static $batchSize = 100;
    
    public static function add($logData)
    {
        self::$batch[] = $logData;
        
        if (count(self::$batch) >= self::$batchSize) {
            self::flush();
        }
    }
    
    public static function flush()
    {
        if (!empty(self::$batch)) {
            UserLogModel::insert(self::$batch);
            self::$batch = [];
        }
    }
}
```

### Index Optimization
```sql
-- For user-specific queries
CREATE INDEX idx_user_logs_user_activity ON user_logs(user_id, created_at);

-- For action type queries
CREATE INDEX idx_user_logs_action_type ON user_logs((log_details->>'$.action_type'));

-- For status queries
CREATE INDEX idx_user_logs_status ON user_logs((log_details->>'$.status'));
```

---

## Error Handling

### Event Listener Error Handling
```php
public function handle(UserActivityEvent $event)
{
    try {
        UserLogModel::create([...]);
    } catch (\Exception $e) {
        // Fallback logging
        \Log::channel('activity_errors')->error('Failed to log activity', [
            'user_id' => $event->userId,
            'activity' => $event->activity,
            'error' => $e->getMessage()
        ]);
        
        // Don't re-throw to avoid breaking main application flow
    }
}
```

### Graceful Degradation
```php
// In your application code
try {
    $this->logSuccess('Operation completed');
} catch (\Exception $e) {
    // Continue execution even if logging fails
    \Log::warning('Activity logging failed: ' . $e->getMessage());
}
```

---

## Testing

### Unit Test Example
```php
use App\Events\UserActivityEvent;
use Illuminate\Support\Facades\Event;

class ActivityLoggingTest extends TestCase
{
    public function test_user_activity_is_logged()
    {
        Event::fake();
        
        $user = User::factory()->create();
        $this->actingAs($user);
        
        // Trigger some action
        $response = $this->post('/api/users', [
            'name' => 'Test User'
        ]);
        
        // Assert event was dispatched
        Event::assertDispatched(UserActivityEvent::class, function ($event) use ($user) {
            return $event->userId === $user->id 
                && $event->activity['action_type'] === 'user_creation';
        });
    }
}
```

This API reference provides complete technical details for implementing and customizing the user activity logging system.
