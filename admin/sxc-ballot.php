<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ballot</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src='../assets/bootstrap/js/jquery.min.js'></script>
    <script src='../assets/bootstrap/js/bootstrap.bundle.min.js'></script>
    <link rel="stylesheet" href="../assets/css-js/styles.css">
    <script src='../assets/css-js/script.js'></script>
    <script src="../assets/css-js/head_script.js"></script>
</head>
<body>
    <div class="container">
        <header>
            <?php include_once('includes/navbar.php'); ?>
        </header>
        <main class="content-wrapper">
            <?php include_once('../util_classes/Ballot.php') ?>
            <table class="table">
                <thead>
                <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Example</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <table class="table">
        <thead>

        </thead>
        <tbody>
    <script>
      
                $.ajax({
                    url: '',
                    method: 'GET',
                    dataType: 'json'
                })
                .done(function(data) {
                    $('#result').html(`<p>Title: ${data.title}</p><p>Body: ${data.body}</p>`);
                    console.log("Request succeeded:", data);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    $('#result').html(`<p>Error: ${textStatus}</p>`);
                    console.error("Request failed:", textStatus, errorThrown);
                })
                .always(function() {
                    console.log("Request completed");
                });
         
    
    </script>
            
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
