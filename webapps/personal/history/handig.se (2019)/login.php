<?php
include("inc/initiate.php");
session_start();

if(isset($_POST['submit'])) {
  if($_POST['user'] == "albin" && $_POST['pass'] == "handig") {
    $_SESSION['admin'] = true;
  } else {
    $_msg = "Inloggning misslyckades";
  }
}

if(!isset($_SESSION['admin'])) {
?>

<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="../public/css/admin-login.css" />
</head>
<body>

    <div class="header">
      <div>Albin<span>Händig</span></div>
    </div>

    <div class="login">
      <form action="" method="post">
        <input type="text" placeholder="Användarnamn" name="user"><br>
        <input type="password" placeholder="Lösenord" name="pass"><br>
        <input type="submit" name="submit" value="Logga in">
      </form>
    </div>

</body>
</html>

<?php
} else if(isset($_SESSION['admin'])) {
?>

<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="public/css/admin.css" />
</head>
<body>

  <div class="top-bar">
    <h4>Albin Händig</h4>
    <?php
    if(isset($_POST['logout'])) {
      unset($_SESSION['admin']);
      session_destroy();
      relocate(BASEURL);
      exit;
    }
    ?>
    <form method="POST" class="logout">
      <input type="submit" name="logout" value="Logga ut" />
    </form>
  </div>

  <div class="stats">

  </div>

  <div class="feature-items container">

    <div class="feature-item">
      <svg version="1.1" class="icon-category" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="32" viewBox="0 0 40 32">
        <path d="M38.5 0h-12c-0.825 0-1.977 0.477-2.561 1.061l-14.879 14.879c-0.583 0.583-0.583 1.538 0 2.121l12.879 12.879c0.583 0.583 1.538 0.583 2.121 0l14.879-14.879c0.583-0.583 1.061-1.736 1.061-2.561v-12c0-0.825-0.675-1.5-1.5-1.5zM31 12c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3-1.343 3-3 3z"></path>
        <path d="M4 17l17-17h-2.5c-0.825 0-1.977 0.477-2.561 1.061l-14.879 14.879c-0.583 0.583-0.583 1.538 0 2.121l12.879 12.879c0.583 0.583 1.538 0.583 2.121 0l0.939-0.939-13-13z"></path>
      </svg>

        <h2 class="settings-btn">Inställningar</h2>

        <svg class="icon-zigzag" id="Layer_1" x="0" y="0" viewBox="0 0 845.75 123" enable-background="new 0 0 845.75 123" xml:space="preserve">
          <polyline class="zigzag zigzag-one" fill="none" stroke="#FCFFF7" stroke-width="25" stroke-miterlimit="10" points="841.5 113.75 702 9.75 562.51 113.75 423.01 9.75 283.51 113.75 144 9.75 4.5 113.75 "/>
        </svg>
        <p>Ta hand om alla inställningar för din hemsida</p>
    </div>

     <div class="feature-item">
        <svg version="1.1" class="icon-camera" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32">
          <path d="M9.5 19c0 3.59 2.91 6.5 6.5 6.5s6.5-2.91 6.5-6.5-2.91-6.5-6.5-6.5-6.5 2.91-6.5 6.5zM30 8h-7c-0.5-2-1-4-3-4h-8c-2 0-2.5 2-3 4h-7c-1.1 0-2 0.9-2 2v18c0 1.1 0.9 2 2 2h28c1.1 0 2-0.9 2-2v-18c0-1.1-0.9-2-2-2zM16 27.875c-4.902 0-8.875-3.973-8.875-8.875s3.973-8.875 8.875-8.875c4.902 0 8.875 3.973 8.875 8.875s-3.973 8.875-8.875 8.875zM30 14h-4v-2h4v2z"></path>
        </svg>

        <h2 class="images-btn">Bilder</h2>

        <svg class="icon-zigzag" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 845.75 123" enable-background="new 0 0 845.75 123" xml:space="preserve">
          <polyline class="zigzag zigzag-two" fill="none" stroke="#FCFFF7" stroke-width="25" stroke-miterlimit="10" points="841.5 113.75 702 9.75 562.51 113.75 423.01 9.75 283.51 113.75 144 9.75 4.5 113.75 "/>
        </svg>
        <p>Ladda upp dina bilder och beskär</p>
      </div>

  </div>

  <div class="settings-modal modal">
    <span class="modal-close">x</span>
    <div class="modal-content">
      <?php
        if (file_exists("inc/modules/settings.php")) {
          require ("inc/modules/settings.php");
        }
      ?>
    </div>
  </div>

    <div class="images-modal modal">
    <span class="modal-close">x</span>
    <div class="modal-content">
      <?php
        if (file_exists("inc/modules/upload.php")) {
          require ("inc/modules/upload.php");
        }
      ?>
    </div>
  </div>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="public/js/lib/TweenMax.min.js"></script>
  <script src="public/js/admin.js"></script>
  <script src="public/js/bbcode.js"></script>

</body>
</html>

<?php
} else {
  include('page/404.php');
}
?>