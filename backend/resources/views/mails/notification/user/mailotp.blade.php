

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AddressGuru | OTP Verification</title>
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    }
    .email-container {
      max-width: 600px;
      margin: 30px auto;
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      overflow: hidden;
      border: 1px solid #eee;
    }
    .header {
      background-color: #ff6600;
      padding: 25px 15px;
      text-align: center;
      color: #fff;
    }
    .header img {
      width: 150px;
      margin-bottom: 10px;
    }
    .content {
      padding: 30px;
      color: #333;
      line-height: 1.6;
    }
    .content h2 {
      color: #ff6600;
      margin-bottom: 10px;
      font-size: 22px;
    }
    .otp-box {
      background-color: #fff5ec;
      border: 2px dashed #ff6600;
      border-radius: 8px;
      text-align: center;
      font-size: 22px;
      font-weight: bold;
      letter-spacing: 2px;
      padding: 15px;
      margin: 20px 0;
      color: #333;
    }
    .footer {
      background-color: #fafafa;
      text-align: center;
      padding: 20px;
      font-size: 13px;
      color: #666;
      border-top: 1px solid #eee;
    }
    .footer a {
      color: #ff6600;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="header">
      <img src="http://www.addressguru.in/images/logopng.png" alt="AddressGuru Logo" />
      <h1>AddressGuru</h1>
    </div>
    <div class="content">
      <h2>Verify Your Email Address</h2>
      <p>Hello,</p>
      <p>Thank you for joining <strong>AddressGuru</strong>! To complete your verification process, please use the one-time password (OTP) below. This OTP is valid for the next 2 minutes.</p>

      <div class="otp-box">
       {{ $details->otp }}
      </div>

      <p>If you didn’t request this verification, you can safely ignore this email.</p>

      <p>Thanks & Regards,<br>
      <strong>Team AddressGuru</strong></p>
    </div>
    <div class="footer">
      <p>&copy; {{ date('Y') }} AddressGuru. All rights reserved.</p>
      <p><a href="https://addressguru.sg">www.addressguru.sg</a></p>
    </div>
  </div>
</body>
</html>
