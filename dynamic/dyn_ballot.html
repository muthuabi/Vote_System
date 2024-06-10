<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src='../assets/bootstrap/js/jquery.min.js'></script>
    <script src='../assets/bootstrap/js/bootstrap.bundle.min.js'></script>
    <link rel="stylesheet" href="../assets/css-js/styles.css">
    <script src='../assets/css-js/script.js'></script>
    <script src="../assets/css-js/head_script.js"></script>
</head>

<body>
    <div class="container">
        <h2>SXC VOTE BALLOT</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Post</th>
                    <th>Vote</th>
                </tr>
            </thead>
            <tbody id="ballot_all">

            </tbody>
        </table>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", (main) => {
        const table_ballot_all = document.getElementById("ballot_all");
        function fetch_ballot() {
            $.ajax({
                url: '../util_classes/Ballot.php?ballot=BALLOT_ALL',
                method: 'GET',
                dataType: 'json'
            })
                .done(function (data) {
            
                    data.data.forEach(values => {
                        values.vote = (values.vote ? values.vote : 0);
                        if (document.querySelector(`#can${values.candidate_id}`)) {
                            // document.querySelector(`#can${values.candidate_id} #candidate_id`).innerHTML=values.candidate_id;
                            // document.querySelector(`#can${values.candidate_id} #candidate_name`).innerHTML=values.name;
                            // document.querySelector(`#can${values.candidate_id} #post_name`).innerHTML=values.post;
                            document.querySelector(`#can${values.candidate_id} #vote`).innerHTML = values.vote;
                        }
                        else {
                            table_ballot_all.innerHTML += `
            <tr id=${'can' + values.candidate_id}><td id='candidate_id'>${values.candidate_id}</td><td id='candidate_name'>${values.name}</td><td id='post_name'>${values.post}</td><td id='vote'>${values.vote}</td></tr>
            `;
                        }
                    })
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    console.error("Request failed:", textStatus, errorThrown);
                })
        }
        fetch_ballot();
        setInterval(() => { fetch_ballot() }, 3000);
    });
</script>

</html>