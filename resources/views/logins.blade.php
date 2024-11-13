<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Netflix Login/Signup</title>
  <style>
    /* General Body Styling */
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-image: url('https://springboard-cdn.appadvice.com/wp-content/appadvice-v2-media/2016/11/Netflix-background_860c8ece6b34fb4f43af02255ca8f225.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    /* Dark Overlay */
    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.6); /* Dark transparent overlay */
      z-index: 1;
    }

    /* Form Container */
    .container {
      position: relative;
      z-index: 2; /* Ensures it appears above the overlay */
      background-color: rgba(0, 0, 0, 0.75);
      padding: 40px;
      font-family:'Courier New', Courier, monospace;
      width: 100%;
      max-width: 400px;
      border-radius: 10px;
      text-align: center;
    }

    /* Netflix Logo */
    .logo img {
      width: 150px;
      margin-bottom: 20px;
    }

    /* Form Elements */
    h1 {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    input[type="email"], input[type="password"] {
      width: 100%;
      padding: 15px;
      margin: 10px 0;
      background: #333;
      border: none;
      border-radius: 5px;
      color: #fff;
      font-size: 16px;
    }

    .btn {
      width: 100%;
      padding: 15px;
      background-color: #e50914;
      border: none;
      color: white;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
      border-radius: 5px;
      margin-top: 20px;
    }

    .btn:hover {
      background-color: #f40612;
    }

    .options {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .options a {
      color: #b3b3b3;
      text-decoration: none;
      font-size: 14px;
    }

    .options a:hover {
      text-decoration: underline;
    }

    .signup-link {
      margin-top: 20px;
      font-size: 16px;
      color: #b3b3b3;
    }

    .signup-link a {
      color: #fff;
      text-decoration: none;
      font-weight: bold;
    }

    .signup-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <!-- Dark overlay for better text readability -->
  <div class="overlay"></div>

  <!-- Form Container -->
  <div class="container">
    <!-- Netflix Logo -->
    <div class="logo">
      <img src="https://samrat-karak.github.io/Netflix_clone_landingpage/Netflix_transparent_background.png" alt="Netflix Logo">
    </div>

    <!-- Login Form -->
    <form method="POST" action="{{ route('authenticate') }}">
      @csrf

      <!-- Email -->
      <div class="input-wrapper">
          <input type="email" name="email" class="input-field" placeholder="Email" required value="{{ old('email') }}">
          @error('email')
              <div class="text-danger">{{ $message }}</div>
          @enderror
      </div>

      <!-- Password -->
      <div class="input-wrapper">
          <input type="password" name="password" class="input-field" placeholder="Password" required>
          @error('password')
              <div class="text-danger">{{ $message }}</div>
          @enderror
      </div>

      <!-- Login Button -->
      <button type="submit" class="btn btn-login">Login</button>

      <!-- Don't have an account? -->
      <div class="sign-up">
          <span>Don't have an account? </span><a href="{{ route('signup') }}">Sign Up</a>
      </div>
  </form>
  
 

    <!-- Sign Up Link -->
    
  </div>

</body>
</html>
