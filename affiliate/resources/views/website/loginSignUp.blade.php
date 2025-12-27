<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Zakwan Affiliate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #0f172a;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      color: white;
      overflow: hidden;
    }

    header {
      background-color: #1f2937;
      height: 50px;
      padding: 0 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .site-name,
    .login-text {
      font-size: 1rem;
      color: white;
    }

    .login-text {
      cursor: pointer;
      text-decoration: none;
    }

    .center-wrapper {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: calc(100vh - 50px);
      overflow: hidden;
    }

    .center-message {
      font-size: 1.5rem;
      font-weight: 600;
      padding: 20px;
      opacity: 0;
      transform: translateY(20px);
      animation: fadeSlideIn 1.2s ease-out forwards;
      animation-delay: 0.5s;
      text-align: center;
    }

    .styled-table {
      width: 300px;
      margin: 20px auto 0;
      text-align: center;
      background-color: #1e293b;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
      border: 1px solid #334155; /* Outer border */
      border-collapse: collapse; /* Merge cell borders */
    }

    .styled-table th {
      width: 50%;
      padding: 15px;
      color: white;
      border: 1px solid #475569; /* Inner cell borders */
      font-size: 16px;
    }

    @keyframes fadeSlideIn {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 600px) {
      .center-message {
        font-size: 1.3rem;
      }
    }
    a {
        text-decoration: none;
        color:#fff
    }
  </style>
</head>
<body>
  <header style="height: 50px;">
    <!-- <div class="site-name">Zakwan Affiliate</div>
    <a href="#" class="login-text">Login</a> -->
  </header>

  <div class="center-wrapper">
    <div class="center-message">
      <!-- Welcome to Zakwan Affiliate -->
       Welcome to Zakwan Business Career Program

      <table class="styled-table">
        <tbody>
          <tr>
            <th><a href="{{url('/')}}/login">Sign In</a></th>
            <th><a href="{{url('/')}}/registration">Create Account</a></th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
