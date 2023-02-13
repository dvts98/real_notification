<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container">
    <nav class="navbar navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Php Real Notifications</a>

        <div class="dropdown">
          <a class='nav-link dropdown-toggle btn btn-danger' href='#' id='navbarDropdownAbout' role='button' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class="bi bi-bell-fill count"></i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
              <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
            </svg></a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">

          </ul>
        </div>
      </div>
    </nav>
    <br>
    <form method="post" id="message_form">
      <div class="form-group">
        <label>Enter Title</label>
        <input type="text" name="tittle" id="title" class="form-control">
      </div>
      <div class="form-group">
        <label>Enter Message</label>
        <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <input type="submit" name="submit" id="post" class="btn btn-primary" value="Submit Message">
      </div>
    </form>

  </div>

  <script>
    $(document).ready(function() {

      function showUnreadNotification(option = '') {
        $.ajax({
          url: 'fetch.php',
          method: 'POST',
          data: {
            option: option
          },
          dataType: 'json',
          success: function(data) {
            $('.dropdown-menu').html(data.notifications);
            if (data.unreadnotification > 0) {
              $('.count').html(data.unreadnotification);
            }
          }
        });

      }
      showUnreadNotification();

      $('#message_form').on('submit', function(event) {
        event.preventDefault();
        if ($('#tittle').val() != '' && $('#message').val() != '') {
          var formData = $(this).serialize();
          $.ajax({
            url: 'insert.php',
            method: 'POST',
            data: formData,
            success: function(data) {
              $('#message_form')[0].reset();
              showUnreadNotification();
            }
          });
        } else {
          alert('Hey You Need To Fill Both Field!!');
        }
      });
    });
    $(document).on('click', '.dropdown-toggle', function() {
      $('.count').html('');
    });
    setInterval(function() {
      showUnreadNotification();
    }, 5000);
  </script>

</body>

</html>