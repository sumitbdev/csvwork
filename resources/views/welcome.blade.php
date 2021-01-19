<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sumit b Test App</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
    

    .display-none{
        display:none !important;
    }



table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}


</style>
    </head>
    <body>

        <div id="loading" class="display-none">
         <p id="loading-text" style="color:#fff">Loading..</p>
        </div>

        <div class="container">

          <div class="row" style="min-height: 150px;"></div>
        </div>

        <div class="container">

          <div class="row">
            <div class="col-md-4" >
                    
              </div>

              <div class="col-md-4" >
                    <div class="div-border" id="form-cont">
                        <form method="post" action="#" id="form-upload">
                          <!-- <div class="form-group">
                            <label for="exampleFormControlFile1">Select A Csv File</label>
                            <input type="file" name="file" class="form-control-file" id="select-file">
                          </div> -->
                          <input value="1,2,4,6,7,7" name="csvdata" />
                          <div class="form-group">
                            
                            <button class="btn btn-success">submit</button>
                            
                          </div>
                        </form>
                    </div>
              </div>

              <div class="col-md-4 ">
                
              </div>


          </div>
           <div class="row " style="margin-top: 50px"></div>
           <div class="row">
            <div class="col-md-2" >
                    
              </div>

              <div class="col-md-8" >
                    <div class="div-border table-cont">
                    <table class="display-none" id="table-cont"></table>
                    </div>
              </div>

              <div class="col-md-2 ">
                

              </div>

              

          </div>

        </div>


        <script type="text/javascript">

            $( document ).ready(function() {
              
            });



            $(document).on("change","#select-file",function(){
             
              var fileExtension = ['csv'];
              if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $(this).val("");
                alert("Please select acsv file");
              }

            });

            $(document).on("submit","#form-upload",function(e){
              e.preventDefault();
              if($("#select-file").val() != ""){
                var formData = new FormData(this);
                console.log(formData);
                $("#loading").removeClass("display-none");
                $.ajax({
                    url: "{{ url('/api/csv_data_upload') }}",
                    type: 'POST',
                    data: formData,
                    success: function (data) {
                        $("#table-cont").append(data.data).removeClass("display-none");
                        $("#loading").addClass("display-none");
                    },
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
              }else{
                alert("Please slect a csv file");
              }

            });
            


        </script>



    </body>



</html>
