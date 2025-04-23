/**
 * Class Filters
 */
public $aliases = [
    'csrf'     => \CodeIgniter\Filters\CSRF::class,
    'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
    'honeypot' => \CodeIgniter\Filters\Honeypot::class,
    'auth'     => \App\Filters\Auth::class,
    'audit'    => \App\Filters\AuditFilter::class,
    'securityHeaders' => \App\Filters\SecurityHeaders::class,
];

/**
 * List of filter aliases that are always
 * applied before and after every request.
 */
public $globals = [
    'before' => [
        // 'honeypot',
        'csrf',
        'securityHeaders' => ['except' => []]
    ],
    'after' => [
        'toolbar',
        // 'honeypot',
    ],
];

/**
 * List of filter aliases that works on a
 * particular HTTP method (GET, POST, etc.).
 */
public $methods = [];

/**
 * List of filter aliases that should run on any
 * before or after URI patterns.
 */
public $filters = [
    'audit:patient' => [
        'before' => [
            'patients/*',
        ]
    ],
    'audit:medication' => [
        'before' => [
            'medications/*',
        ]
    ],
    'audit:appointment' => [
        'before' => [
            'appointments/*',
        ]
    ],
    'audit:billing' => [
        'before' => [
            'billing/*',
        ]
    ],
    'audit:user' => [
        'before' => [
            'users/*',
        ]
    ],
]; 