<b>APP_NAME</b> : {{ env('APP_NAME') }} <br><hr>
<b>APP_ENV</b> : {{ env('APP_ENV') }} <br><hr>
<b>APP_DEBUG</b> : {{ env('APP_DEBUG') }} <br><hr>
<b>APP_URL</b> : {{ env('APP_URL') }} <br><hr>

<b>LOG_CHANNEL</b> : {{ env('LOG_CHANNEL') }} <br><hr>

<b>DB_CONNECTION</b> : {{ env('DB_CONNECTION') }} <br><hr>
<b>DB_HOST</b> : {{ env('DB_HOST') }} <br><hr>
<b>DB_PORT</b> : {{ env('DB_PORT') }} <br><hr>
<b>DB_DATABASE</b> : {{ env('DB_DATABASE') }} <br><hr>


<b>BROADCAST_DRIVER</b> : {{ env('BROADCAST_DRIVER') }} <br><hr>
<b>CACHE_DRIVER</b> : {{ env('CACHE_DRIVER') }} <br><hr>
<b>QUEUE_CONNECTION</b> : {{ env('QUEUE_CONNECTION') }} <br><hr>
<b>SESSION_DRIVER</b> : {{ env('SESSION_DRIVER') }} <br><hr>
<b>SESSION_LIFETIME</b> : {{ env('SESSION_LIFETIME') }} <br><hr>

<b>REDIS_HOST</b> : {{ env('REDIS_HOST') }} <br><hr>
<b>REDIS_PASSWORD</b> : {{ env('REDIS_PASSWORD') }} <br><hr>
<b>REDIS_PORT</b> : {{ env('REDIS_PORT') }} <br><hr>

<b>MAIL_DRIVER</b> : {{ env('MAIL_DRIVER') }} <br><hr>
<b>MAIL_HOST</b> : {{ env('MAIL_HOST') }} <br><hr>
<b>MAIL_PORT</b> : {{ env('MAIL_PORT') }} <br><hr>
<b>MAIL_USERNAME</b> : {{ env('MAIL_USERNAME') }} <br><hr>
<b>MAIL_ENCRYPTION</b> : {{ env('MAIL_ENCRYPTION') }} <br><hr>
<b>MAIL_FROM_ADDRESS</b> : {{ env('MAIL_FROM_ADDRESS') }} <br><hr>
<b>MAIL_FROM_NAME</b> : {{ env('MAIL_FROM_NAME') }} <br><hr>

<b>AWS_ACCESS_KEY_ID</b> : {{ env('AWS_ACCESS_KEY_ID') }} <br><hr>
<b>AWS_SECRET_ACCESS_KEY</b> : {{ env('AWS_SECRET_ACCESS_KEY') }} <br><hr>
<b>AWS_DEFAULT_REGION</b> : {{ env('AWS_DEFAULT_REGION') }} <br><hr>
<b>AWS_BUCKET</b> : {{ env('AWS_BUCKET') }} <br><hr>

<b>PUSHER_APP_ID</b> : {{ env('PUSHER_APP_ID') }} <br><hr>
<b>PUSHER_APP_KEY</b> : {{ env('PUSHER_APP_KEY') }} <br><hr>
<b>PUSHER_APP_SECRET</b> : {{ env('PUSHER_APP_SECRET') }} <br><hr>
<b>PUSHER_APP_CLUSTER</b> : {{ env('PUSHER_APP_CLUSTER') }} <br><hr>

<b>MIX_PUSHER_APP_KEY</b> : {{ env('MIX_PUSHER_APP_KEY') }} <br><hr>
<b>MIX_PUSHER_APP_CLUSTER</b> : {{ env('MIX_PUSHER_APP_CLUSTER') }} <br><hr>

<b>SMS_API</b> : {{ env('SMS_API') }} <br><hr>
<b>SMS_TO</b> : {{ env('SMS_TO') }} <br><hr>
<b>SMS_FROM</b> : {{ env('SMS_FROM') }} <br><hr>

<b>DEFAUlT_PASS</b> : {{ config('app.default_pass') }} <br><hr>
<b>USE_GENERATED_PASS</b> : {{ config('app.use_generated_pass') }} <br><hr>