<!DOCTYPE html>
<html>
<head>
    <title>Your Claim Created</title>
</head>
<body>
    <h1>Your Claim has been Created</h1>
    <p>Title: {{ $claim->title }}</p>
    <p>Description: {{ $claim->description }}</p>
    <p>Status: {{ $claim->status }}</p>
    <p>Thank you for your submission!</p>
</body>
</html>
