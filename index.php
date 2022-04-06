<?php
    session_start();
    if(isset($_SESSION['UserName']) && isset($_SESSION['Password'])){
?>
<!doctype html>
<head>
    
    <title>Show data</title>

    <link rel="stylesheet" type="text/css" href="styles.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js.js"></script>
   
</head>

<body>
   <div class="content"> 
    <h1>People here</h1>                    
                <table id="people_table" class="table table-striped">  
                    <thead bgcolor="#6cd8dc">
                        <tr class="table-primary">
                            <th width="5%">ID</th>
                            <th width="15%">Name</th>
                            <th width="20%">Phone number</th>
                            <th width="25%">E-mail</th> 
                            <th width="35%">message</th>
                            <th scope="col" width="5%">Edit</th>
                            <th scope="col" width="5%">Delete</th>
                        </tr>
                    </thead>
                </table>
            </br>
                <div align="right">
                    <a  class="btn btn-success btn-lg pind" href="logout.php"> Logout</a>
                    <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-lg pind">Add new</button>

                </div>
   </div>               
 </body>
 </html>


<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="people_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add new</h4>
                </div>
                <div class="modal-body">
                    <label>Your Name</label>
                    <input type="text" placeholder="write the name plz" name="names" id="names" class="form-control" />
                    <br />
                    <label>Enter Phone Number </label>
                    <input type="text" placeholder="write the number plz" name="numbers" id="numbers" class="form-control" />
                    <br /> 
                    <label>Enter E-mail</label>
                    <input type="text"placeholder="write the Emial plz" name="emails" id="emails" class="form-control" />
                    <br /> 
                    <label>Enter Your message </label>
                    <input type="text"placeholder="write the message plz" name="message" id="message" class="form-control" />
                    <br />
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="people_id" id="people_id" />
                    <input type="hidden" name="operation" id="operation" />
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Add" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php 
    }else{
        header("Location: login.php? you must login first pro ^_^");
    }
?>