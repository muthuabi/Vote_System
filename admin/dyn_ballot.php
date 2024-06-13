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
    <header>
        <?php include_once('includes/navbar.php') ?>
    </header>
    <main class="content-wrapper">
        <div id="ballot_head">
            <b>Student Council Election (2024-25) </b>
            <div>
                <strong id="live-blink"></strong><strong id="live">live</strong>
            </div>
        </div>
        <table class="table">
            <thead>
            
            </thead>
            <tbody id="ballot_all">
                  
            </tbody>
         
        </table>
</main>
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
                    const pos_arr=[];
                    data.data.forEach(values => {
                        // console.log(data);
                        values.vote = (values.vote ? values.vote : 0);
                        if (document.querySelector(`#can${values.candidate_id}`)) {
                            // document.querySelector(`#can${values.candidate_id} #candidate_id`).innerHTML=values.candidate_id;
                            // document.querySelector(`#can${values.candidate_id} #candidate_name`).innerHTML=values.name;
                            // document.querySelector(`#can${values.candidate_id} #post_name`).innerHTML=values.post;
                            document.querySelector(`#can${values.candidate_id} #vote`).innerHTML = values.vote;
                            document.querySelector(`#can${values.candidate_id} #vote_status`).innerHTML = (data.max_post_data[values.post_id].max_candidate_id==values.candidate_id)?'<img src="../assets/icons/up-arrow.svg" class="svg-icon" />':'<img src="../assets/icons/down-arrow.svg" class="svg-icon" />';
                        }
                        else {
                            if(!pos_arr.includes(values.post_id)){
                                table_ballot_all.innerHTML+=`<br><tr class='common_post'><th id='common_post' style='text-align:left;text-transform:uppercase' colspan='5'>${values.post} ${(values.post_shift=='Both')?'':'('+values.post_shift+')'}</th></tr>`;
                                pos_arr.push(values.post_id);
                            }
                            table_ballot_all.innerHTML += `
            <tr class='' id=${'can' + values.candidate_id}><td id='candidate_id' >${values.candidate_id}</td><td id='candidate_name' style='text-transform:uppercase'>${values.name}</td><td id='regno'>${values.regno}</td><td id='vote_data'><b id='vote'>${values.vote}</b>  <span id='vote_status'${(data.max_post_data[values.post_id].max_candidate_id==values.candidate_id)?' class=up_vote ><img src="../assets/icons/up-arrow.svg" class="svg-icon" />':' class=down_vote><img src="../assets/icons/down-arrow.svg" class="svg-icon" />'}</span></td></tr>
         
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