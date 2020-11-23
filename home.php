<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/mystyle.css">
    <title>Demo - PHP webiste on GCP App Engine</title>
</head>
<body style="background: rgba(88, 164, 172, 100);">

    <?php
    require_once __DIR__ . '/vendor/autoload.php';

    use Google\Cloud\Datastore\DatastoreClient;
    $datastore = new DatastoreClient([
        'projectId' => 'nw-command-reference-dev'
    ]);
    $query = $datastore->query();
    $query->kind('visit');
    $res = $datastore->runQuery($query);
    $count = 1;
    foreach ($res as $per_entry) {
        $count = $per_entry['count'] + 1;
    }


    $key = $datastore->key('visit', 'single');
    $entity = $datastore->entity($key, [
        'count' => $count
    ]);
    $transaction = $datastore->transaction();
    if ($count == 1) {
        $transaction->insert($entity);
    } else {
        $transaction->update($entity, ['allowOverwrite' => true]);
    }
    $transaction->commit();


    ?>
    <nav class="nav nav-pills nav-fill justify-content-end" style="background: rgba(81, 156, 164, 100);">
        <a class="nav-item nav-link active" style="color:rgba(216, 219, 226, 100);font-size:1.5rem;font-family: Dosis;" href="/">Home</a>
        <a class="nav-item nav-link" style="color:rgba(216, 219, 226, 100);font-size:1.5rem;font-family: Dosis;" href="/prod">Prod</a>
        <a class="nav-item nav-link" style="color:rgba(216, 219, 226, 100);font-size:1.5rem;font-family: Dosis;" href="/php_files">PHP Files</a>
    </nav>
    <div class="row justify-content-center align-items-center">
        <p style="color:rgba(216, 219, 226, 100);font-size:5rem;font-family: Dosis;">This site is now being loaded </p>
    </div>

    <div class="row justify-content-center align-items-center">
        <p style="color:rgba(55, 63, 81, 100);font-size:25rem;font-family: Dosis;"><?php echo $count; ?><sup>
                <?php
                if ($count % 10 == 1 && (int)($count % 100 / 10) != 1) {
                    echo 'st';
                } elseif ($count % 10 == 2 && (int)($count % 100 / 10) != 1) {
                    echo 'nd';
                } elseif ($count % 10 == 3 && (int)($count % 100 / 10) != 1) {
                    echo 'rd';
                } else {
                    echo 'th';
                }
                ?></sup></p>
    </div>
    <div class="row justify-content-center align-items-center">
        <p style="color:rgba(216, 219, 226, 100);font-size:5rem; font-family: Dosis;">times. </p>
    </div>
    <div class="row justify-content-center align-items-center">
        <p style="color:rgba(216, 219, 226, 100);font-size:1.5rem;font-family: Dosis;"> The demo for hosting - <a href="#">here.</a></p>
    </div>


    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>