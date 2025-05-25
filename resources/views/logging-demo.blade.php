<!DOCTYPE html>
<html>
<head>
    <title>Laravel Logging Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Laravel Logging Demo</h1>
        <p>Click the buttons below to test different logging features. Check your log files in <code>storage/logs/</code></p>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Log Levels Demo</h5>
                        <p>Test all 8 log levels</p>
                        <button class="btn btn-primary" onclick="testEndpoint('/logging-demo/levels')">Test Log Levels</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Contextual Logging</h5>
                        <p>Test logging with context data</p>
                        <button class="btn btn-success" onclick="testEndpoint('/logging-demo/contextual')">Test Contextual</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Performance Logging</h5>
                        <p>Test performance monitoring</p>
                        <button class="btn btn-info" onclick="testEndpoint('/logging-demo/performance')">Test Performance</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Exception Logging</h5>
                        <p>Test exception handling</p>
                        <button class="btn btn-warning" onclick="testEndpoint('/logging-demo/exceptions')">Test Exceptions</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Security Logging</h5>
                        <p>Test security event logging</p>
                        <button class="btn btn-danger" onclick="testEndpoint('/logging-demo/security')">Test Security</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Channel Logging</h5>
                        <p>Test different log channels</p>
                        <button class="btn btn-secondary" onclick="testEndpoint('/logging-demo/channels')">Test Channels</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Structured Logging</h5>
                        <p>Test structured logging for analytics</p>
                        <button class="btn btn-dark" onclick="testEndpoint('/logging-demo/structured')">Test Structured</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            <h3>Response:</h3>
            <pre id="response" class="bg-light p-3"></pre>
        </div>
    </div>

    <script>
        function testEndpoint(url) {
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('response').textContent = JSON.stringify(data, null, 2);
                })
                .catch(error => {
                    document.getElementById('response').textContent = 'Error: ' + error.message;
                });
        }
    </script>
</body>
</html>