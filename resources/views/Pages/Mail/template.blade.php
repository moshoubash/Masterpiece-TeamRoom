<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .field {
            margin-bottom: 15px;
        }
        .label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Contact Form Submission</h2>
        <div class="field">
            <label class="label">Name:</label>
            <p>{{ $data['name'] }}</p>
        </div>
        <div class="field">
            <label class="label">Email:</label>
            <p>{{ $data['email'] }}</p>
        </div>
        <div class="field">
            <label class="label">Subject:</label>
            <p>{{ $data['subject'] }}</p>
        </div>
        <div class="field">
            <label class="label">Message:</label>
            <p>{{ $data['message'] }}</p>
        </div>
    </div>
</body>
</html>