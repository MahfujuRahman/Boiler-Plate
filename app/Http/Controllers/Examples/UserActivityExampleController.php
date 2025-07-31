<?php

namespace App\Http\Controllers\Examples;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\UserActivityEvent;
use App\Traits\LogsUserActivity;

class UserActivityExampleController extends Controller
{
    use LogsUserActivity;

    /**
     * Example 1: Using Middleware (Automatic)
     * The middleware will automatically log this request
     */
    public function automaticLogging()
    {
        // No manual logging needed - middleware handles it automatically
        return response()->json([
            'message' => 'This activity is logged automatically by middleware',
            'method' => 'Middleware (Automatic)'
        ]);
    }

    /**
     * Example 2: Using Trait Methods (Easy & Clean)
     */
    public function traitLogging(Request $request)
    {
        try {
            // Some business logic here...
            $data = ['example' => 'data'];

            // Using trait - Success logging
            $this->logSuccess('User operation completed successfully', 'example_operation', [
                'data' => $data
            ]);

            // Using trait - CRUD logging
            $this->logCrud('create', 'ExampleModel', 123, [
                'additional_info' => 'some extra data'
            ]);

            // Using trait - Authentication logging
            $this->logAuth('User performed secure operation', 'secure_operation');

            return response()->json([
                'message' => 'Operation successful - logged using trait',
                'method' => 'Trait Methods'
            ]);

        } catch (\Exception $e) {
            // Using trait - Error logging
            $this->logError('Operation failed: ' . $e->getMessage(), 'example_operation', 500, [
                'error_details' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Operation failed - error logged using trait',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Example 3: Using Manual Events (Full Control)
     */
    public function manualLogging(Request $request)
    {
        // Manual event - Before operation
        event(new UserActivityEvent(
            auth()->id(),
            [
                'title' => 'Manual Operation Started',
                'status' => 'info',
                'status_code' => 200,
                'message' => 'User initiated manual operation',
                'action_type' => 'manual_operation_start',
            ],
            $request,
            [
                'operation_id' => uniqid(),
                'start_time' => now()->toDateTimeString(),
                'user_ip' => $request->ip()
            ]
        ));

        try {
            // Some business logic here...
            $result = ['processed' => true, 'id' => 456];

            // Manual event - Success with detailed data
            event(new UserActivityEvent(
                auth()->id(),
                [
                    'title' => 'Manual Operation Completed',
                    'status' => 'success',
                    'status_code' => 201,
                    'message' => 'Manual operation completed successfully with custom logging',
                    'action_type' => 'manual_operation_complete',
                ],
                $request,
                [
                    'result' => $result,
                    'processing_time' => '0.5s',
                    'records_affected' => 10,
                    'custom_metrics' => [
                        'performance_score' => 95,
                        'efficiency_rating' => 'A+'
                    ]
                ]
            ));

            return response()->json([
                'message' => 'Operation successful - logged manually with full control',
                'method' => 'Manual Events',
                'result' => $result
            ]);

        } catch (\Exception $e) {
            // Manual event - Error with extensive details
            event(new UserActivityEvent(
                auth()->id(),
                [
                    'title' => 'Manual Operation Failed',
                    'status' => 'critical_error',
                    'status_code' => 500,
                    'message' => 'Critical failure in manual operation: ' . $e->getMessage(),
                    'action_type' => 'manual_operation_error',
                ],
                $request,
                [
                    'exception_type' => get_class($e),
                    'error_code' => $e->getCode(),
                    'stack_trace' => $e->getTraceAsString(),
                    'system_state' => [
                        'memory_usage' => memory_get_usage(true),
                        'peak_memory' => memory_get_peak_usage(true)
                    ]
                ]
            ));

            return response()->json([
                'message' => 'Operation failed - error logged manually with extensive details',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Example 4: Combined Approach (All Methods)
     */
    public function combinedLogging(Request $request)
    {
        // Method 1: Middleware logs this automatically

        // Method 2: Manual event for specific business logic
        event(new UserActivityEvent(
            auth()->id(),
            [
                'title' => 'Combined Logging Demo',
                'status' => 'info',
                'status_code' => 200,
                'message' => 'Demonstrating combined logging approaches',
                'action_type' => 'demo_combined',
            ],
            $request
        ));

        // Method 3: Trait for CRUD operations
        $this->logCrud('read', 'DemoModel', 789, [
            'demo_type' => 'combined_approach'
        ]);

        // Method 4: Trait for custom success
        $this->logSuccess('All logging methods demonstrated successfully', 'demo_complete');

        return response()->json([
            'message' => 'All logging methods demonstrated',
            'methods_used' => [
                'Middleware (automatic)',
                'Manual events (custom)',
                'Trait CRUD logging',
                'Trait success logging'
            ]
        ]);
    }

    /**
     * Example 5: Static Usage (For Actions/Services)
     */
    public static function staticLogging($request)
    {
        // Using trait static methods
        self::logSuccessStatic(
            'Static operation completed',
            'static_operation',
            ['operation_id' => 'static_001'],
            $request
        );

        // Manual event in static context
        event(new UserActivityEvent(
            auth()->check() ? auth()->id() : null,
            [
                'title' => 'Static Method Execution',
                'status' => 'success',
                'status_code' => 200,
                'message' => 'Static method executed successfully',
                'action_type' => 'static_execution',
            ],
            $request,
            ['execution_context' => 'static_method']
        ));
    }
}
