<!DOCTYPE html>
<html>
<head>
    <title>New Booking Request</title>
</head>
<body>
    <h1>New Booking Request</h1>
    
    <p>Hello {{ $host->name }},</p>
    
    <p>You have received a new booking request for your space <strong>{{ $space->name }}</strong>.</p>
    
    <h2>Booking Details:</h2>
    <ul>
        <li><strong>Date:</strong> {{ date('F j, Y', strtotime($booking->start_datetime)) }}</li>
        <li><strong>Time:</strong> {{ date('g:i A', strtotime($booking->start_datetime)) }} - {{ date('g:i A', strtotime($booking->end_datetime)) }}</li>
        <li><strong>Number of Attendees:</strong> {{ $booking->num_attendees }}</li>
        <li><strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}</li>
        <li><strong>Your Payout:</strong> ${{ number_format($booking->host_payout, 2) }}</li>
    </ul>
    
    <p>Please log in to your TeamRoom account to approve or reject this booking.</p>
    
    <a href="{{ route('host.stats', $host->slug) }}" style="display: inline-block; padding: 10px 20px; background-color: #000000; color: white; text-decoration: none; border-radius: 5px;">View Booking Details</a>
    
    <p>Thank you for using TeamRoom!</p>
</body>
</html>