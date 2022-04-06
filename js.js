var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,5})+$/;

$(document).ready(function(){
    $('#add_button').click(function(){
        $('#people_form')[0].reset();
        $('.modal-title').text("Add people Details");
        $('#action').val("Add");
        $('#operation').val("Add");
    });
    
    var dataTable = $('#people_table').DataTable({
        "paging":true,
        "processing":true,
        "serverSide":true,
        "order": [],
        "info":true,
        
        "ajax":{
            url:"opreation.php",
            type:"POST"
            },
        "columnDefs":[
            {
                "targets":[0,3,4],
                "orderable":false,
            },
        ],    
    });

    $(document).on('submit', '#people_form', function(event){
        event.preventDefault();
        var names = $('#names').val();
        var numbers = $('#numbers').val();
        var emails = $('#emails').val();
        var message = $('#message').val();
        var messageError ="";
        var done= false;

        if(names ==null || names == ''){
            messageError +="please enter your name   \n ";
        }
        else if(! typeof names === 'string' || ! names instanceof String ){
            messageError +="please enter a valid name \n  ";
        }

        if(numbers == null || numbers ==''){
            messageError +="please enter your namber \n  ";    
        }else if(isNaN(numbers)){
            messageError +="please enter a valid  number \n  ";
        }

        if(emails == null || emails == ''){
            messageError +="please enter your email \n";
        }
        if(!emails.match(mailformat)){
            messageError +="please enter a valid  E-mail \n  ";
        }

        if(message == null || message == ''){
            messageError +="please enter your message \n  ";
        }
        
        if(!messageError==""){
            alert(messageError +"Please follow the instructions below");
            return false;
        }else{    
            $.ajax({
                url:"insert.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    $('#people_form')[0].reset();
                    $('#userModal').modal('hide');
                    dataTable.ajax.reload();
                }
            });
        }
        

        
    });
    
    $(document).on('click', '.update', function(){
        var people_id = $(this).attr("id");
        $.ajax({
            url:"getOne.php",
            method:"POST",
            data:{people_id:people_id},
            dataType:"json",
            success:function(data)
            {
                messageError='';
                if(data.names ==null || data.names == ''){
                    messageError +="please enter your name   \n ";
                }
                else if(! typeof data.names === 'string' || ! data.names instanceof String ){
                    messageError +="please enter a valid name \n  ";
                }
        
                if(data.numbers == null || data.numbers ==''){
                    messageError +="please enter your namber \n  ";    
                }else if(isNaN(data.numbers)){
                    messageError +="please enter a valid  number \n  ";
                }
        
                if(data.emails == null || data.emails == ''){
                    messageError +="please enter your email \n";
                }
                if(!data.emails.match(mailformat)){
                    messageError +="please enter a valid  E-mail \n  ";
                }
        
                if(data.message == null || data.message == ''){
                    messageError +="please enter your message \n  ";
                }
                if(!messageError==""){
                    alert(messageError +"Please follow the instructions below");
                    return false;
                }else{    
                $('#userModal').modal('show');
                $('#id').val(data.id);
                $('#names').val(data.names);
                $('#numbers').val(data.numbers);
                $('#emails').val(data.emails);
                $('#message').val(data.message);
                $('.modal-title').text("Edit people Details");
                $('#people_id').val(people_id);
                $('#action').val("Save");
                $('#operation').val("Edit");
                }
            }
        })
    });
    
    $(document).on('click', '.delete', function(){
        var people_id = $(this).attr("id");
        if(confirm("Are you sure you want to delete this people?"))
        {
            $.ajax({
                url:"delete.php",
                method:"POST",
                data:{people_id:people_id},
                success:function(data)
                {
                    dataTable.ajax.reload();
                }
            });
        }
        else
        {
            return false;   
        }
    });
    
    
});


