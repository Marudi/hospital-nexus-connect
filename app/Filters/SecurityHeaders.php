<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/**
 * SecurityHeaders Filter
 * 
 * Adds security headers to all responses for enhanced security
 */
class SecurityHeaders implements FilterInterface {
    /**
     * Before filter - not used for headers
     */
    public function before(RequestInterface $request, $arguments = null) {
        // No actions needed before the controller executes
    }
    
    /**
     * After filter - adds security headers to the response
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // Add security headers
        $response->setHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->setHeader('X-XSS-Protection', '1; mode=block');
        $response->setHeader('X-Content-Type-Options', 'nosniff');
        
        // Only set HSTS in production for HTTPS
        if (ENVIRONMENT === 'production' && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $response->setHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }
        
        // Content Security Policy - can be adjusted based on needs
        $response->setHeader('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'");
        
        $response->setHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Permissions Policy (formerly Feature Policy)
        $response->setHeader('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
        
        return $response;
    }
} 