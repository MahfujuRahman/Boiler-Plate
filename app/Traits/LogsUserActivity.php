<?php

namespace App\Traits;

use App\Events\UserActivityEvent;

trait LogsUserActivity
{
    /**
     * Log user activity (instance method)
     */
    protected function logActivity($activity, $additionalData = [])
    {
        $userId = auth()->check() ? auth()->id() : null;
        
        if ($userId) {
            event(new UserActivityEvent($userId, $activity, request(), $additionalData));
        }
    }

    /**
     * Log user activity (static method)
     */
    protected static function logActivityStatic($activity, $additionalData = [], $request = null)
    {
        $userId = auth()->check() ? auth()->id() : null;
        
        if ($userId) {
            event(new UserActivityEvent($userId, $activity, $request ?: request(), $additionalData));
        }
    }

    /**
     * Log successful activity (instance method)
     */
    protected function logSuccess($message, $actionType = 'action', $additionalData = [])
    {
        $this->logActivity([
            'title' => ucfirst($actionType) . ' Successful',
            'status' => 'success',
            'status_code' => 200,
            'message' => $message,
            'action_type' => $actionType,
        ], $additionalData);
    }

    /**
     * Log successful activity (static method)
     */
    protected static function logSuccessStatic($message, $actionType = 'action', $additionalData = [], $request = null)
    {
        self::logActivityStatic([
            'title' => ucfirst($actionType) . ' Successful',
            'status' => 'success',
            'status_code' => 200,
            'message' => $message,
            'action_type' => $actionType,
        ], $additionalData, $request);
    }

    /**
     * Log error activity (instance method)
     */
    protected function logError($message, $actionType = 'action', $statusCode = 500, $additionalData = [])
    {
        $this->logActivity([
            'title' => ucfirst($actionType) . ' Failed',
            'status' => 'error',
            'status_code' => $statusCode,
            'message' => $message,
            'action_type' => $actionType,
        ], $additionalData);
    }

    /**
     * Log error activity (static method)
     */
    protected static function logErrorStatic($message, $actionType = 'action', $statusCode = 500, $additionalData = [], $request = null)
    {
        self::logActivityStatic([
            'title' => ucfirst($actionType) . ' Failed',
            'status' => 'error',
            'status_code' => $statusCode,
            'message' => $message,
            'action_type' => $actionType,
        ], $additionalData, $request);
    }

    /**
     * Log info activity (instance method)
     */
    protected function logInfo($message, $actionType = 'action', $additionalData = [])
    {
        $this->logActivity([
            'title' => ucfirst($actionType) . ' Info',
            'status' => 'info',
            'status_code' => 200,
            'message' => $message,
            'action_type' => $actionType,
        ], $additionalData);
    }

    /**
     * Log info activity (static method)
     */
    protected static function logInfoStatic($message, $actionType = 'action', $additionalData = [], $request = null)
    {
        self::logActivityStatic([
            'title' => ucfirst($actionType) . ' Info',
            'status' => 'info',
            'status_code' => 200,
            'message' => $message,
            'action_type' => $actionType,
        ], $additionalData, $request);
    }

    /**
     * Log authentication activity
     */
    protected function logAuth($message, $actionType = 'authentication', $additionalData = [])
    {
        $this->logActivity([
            'title' => 'Authentication Activity',
            'status' => 'success',
            'status_code' => 200,
            'message' => $message,
            'action_type' => $actionType,
        ], $additionalData);
    }

    /**
     * Log authentication activity (static)
     */
    protected static function logAuthStatic($message, $actionType = 'authentication', $additionalData = [], $request = null)
    {
        self::logActivityStatic([
            'title' => 'Authentication Activity',
            'status' => 'success',
            'status_code' => 200,
            'message' => $message,
            'action_type' => $actionType,
        ], $additionalData, $request);
    }

    /**
     * Log CRUD operations
     */
    protected function logCrud($operation, $model, $modelId = null, $additionalData = [])
    {
        $operations = [
            'create' => 'Created',
            'read' => 'Viewed',
            'update' => 'Updated',
            'delete' => 'Deleted',
        ];

        $title = $operations[$operation] ?? 'Modified';
        $message = "{$title} {$model}" . ($modelId ? " (ID: {$modelId})" : '');

        $this->logActivity([
            'title' => "{$title} {$model}",
            'status' => 'success',
            'status_code' => 200,
            'message' => $message,
            'action_type' => "crud_{$operation}",
        ], array_merge($additionalData, [
            'model' => $model,
            'model_id' => $modelId,
            'operation' => $operation,
        ]));
    }

    /**
     * Log CRUD operations (static)
     */
    protected static function logCrudStatic($operation, $model, $modelId = null, $additionalData = [], $request = null)
    {
        $operations = [
            'create' => 'Created',
            'read' => 'Viewed',
            'update' => 'Updated',
            'delete' => 'Deleted',
        ];

        $title = $operations[$operation] ?? 'Modified';
        $message = "{$title} {$model}" . ($modelId ? " (ID: {$modelId})" : '');

        self::logActivityStatic([
            'title' => "{$title} {$model}",
            'status' => 'success',
            'status_code' => 200,
            'message' => $message,
            'action_type' => "crud_{$operation}",
        ], array_merge($additionalData, [
            'model' => $model,
            'model_id' => $modelId,
            'operation' => $operation,
        ]), $request);
    }
}
