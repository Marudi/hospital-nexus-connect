<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/**
 * AuditFilter Class
 * 
 * Automatically logs access to sensitive resources
 */
class AuditFilter implements FilterInterface {
    /**
     * Before filter - logs access attempts
     */
    public function before(RequestInterface $request, $arguments = null) {
        $logger = new \App\Libraries\AuditLogger();
        
        $resourceType = $arguments[0] ?? 'unknown';
        $resourceId = $request->getUri()->getSegment(3) ?? 'none';
        
        // Don't log static resource access
        $path = $request->getUri()->getPath();
        if (preg_match('/\.(css|js|jpg|jpeg|png|gif|ico|woff|ttf|svg)$/i', $path)) {
            return;
        }
        
        $logger->log("{$resourceType}_access_attempt", $resourceId, [
            'method' => $request->getMethod(),
            'uri' => (string)$request->getUri()
        ]);
    }
    
    /**
     * After filter - could log response status codes
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // Optionally log response status
        if ($response->getStatusCode() >= 400) {
            $logger = new \App\Libraries\AuditLogger();
            
            $resourceType = $arguments[0] ?? 'unknown';
            $resourceId = $request->getUri()->getSegment(3) ?? 'none';
            
            $logger->log("{$resourceType}_access_error", $resourceId, [
                'method' => $request->getMethod(),
                'uri' => (string)$request->getUri(),
                'status_code' => $response->getStatusCode()
            ]);
        }
    }
} 