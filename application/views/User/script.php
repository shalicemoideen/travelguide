<script>
////***For disable submit buttons*****///

$("#user_name").on('click',function(){
    $(".submit").attr("disabled", "disabled");
    });
	
////***For disable submit buttons*****///
  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }

$(document).ready(function () {
    var flashVal = $('#flash_response').val();
    if (flashVal) {
        var flashData = $.parseJSON(flashVal);
        var options = {
            'title': '',
            'style': flashData.type === 'success' ? 'success' : 'error',
            'message': flashData.text,
            'icon': flashData.type === 'success' ? 'fas fa-check' : 'fas fa-times'
        };
        var n1 = new notify(options);
        n1.show();
        setTimeout(function () { n1.hide(); }, 5000);
    }
});
  var param = '';
  var arMonth = {'2':'Supervisor','3':'Accountant','4':'employees'};
  var $customerList=[ {'columnName':'customer_name','label':'Customer'} ];

function confirmUpdate(id){
    var conf = confirm("Do you want to Edit details?");
    if(conf){
        $('#EditUser').modal();
        $.ajax({
        url:"<?php echo base_url();?>index.php/User/get_data",
        type: 'POST',
       data:{id:id},
        dataType: 'json',
        success:
        function(data)
        {
             //alert(data['id']);
               document.getElementById('Id').value=data['id'];
               document.getElementById('Shop_name').value=data['shop_name'];
               document.getElementById('Address').value=data['shop_address'];
               document.getElementById('Tin_no').value=data['tin_no'];
               document.getElementById('Phone_number').value=data['phone_no'];
               document.getElementById('User_name').value=data['user_name'];
               document.getElementById('Password').value=data['admin_password'];
               document.getElementById('Admin_email').value=data['admin_email'];
               
        },
        error:function(e){
        console.log("error");
        }
      
      });
      
       
    }
    //var product_id = $("#product_id"+i).val();
    //alert(id);
   // var i++;
}

function EditUser(){
  var id = $('#Id').val();
  var shop_name = $('#Shop_name').val();
  var address =$("#Address").val();
  var tin_no = $("#Tin_no").val();
  var phone_number = $("#Phone_number").val();
  var admin_email = $("#Admin_email").val();
  var user_name = $("#User_name").val();
  var password = $("#Password").val();
  
  if(id) {
      
 if(shop_name == ""){
          
          $('#response').val("Please");
        var data = {"text":"Deleted successfully","type":"success","layout":"topRight"};
        if(data){
            var options = $.parseJSON(data);
        noty(options);
        }
       
      }
     else {
     $.ajax({
       url:"<?php echo base_url();?>index.php/User/editUpdate",
       
            data:{id:id,                  
        shop_name:shop_name,                  
        address:address,                  
        tin_no:tin_no,
        phone_number:phone_number,                  
        admin_email:admin_email,                  
        user_name:user_name,
        password:password
             },
                                        
           method:"POST",
            datatype:"json",
            success:function(data){
                var options = $.parseJSON(data);
                noty(options);
                location.reload();
            },
        error:function(e){
        console.log("error");
        }

      });
      }
  }
}


$(document).on('change','#adwork', function(e){
   if(e.target.checked){
     $('#category').show();
   }
});

////***Checking Username name already existing*****///

$("#user_name").change(function(){
var user_name = $('#user_name').val();
var user_id = $('#user_id').val();
// alert(customer_name);
if(user_name){
if(user_id == ''){
    $.ajax({
            url:"<?php echo base_url()?>index.php/User/checkUsername",
            type: 'POST',
            data: {value:user_name},
            dataType: 'json',
            success:
            function(data)
            {
			// alert(customer_name);
                if(data){
                    var Data1="User Name Already Exist";
                    $('#user_name').val('');
                    $('#user_name').focus();
                    $('#user_name_alert').html(Data1);
                    $('#user_name_alert').show();
                    $(".submit").attr("disabled", "disabled");
                    
                }
                else{
                    $('#user_name_alert').hide();
                    $('.submit').removeAttr('disabled');
                }
            },
            error:function(e){
            console.log("error");
            }
            });
        }
   if(user_id){
        $.ajax({
            url:"<?php echo base_url()?>index.php/User/checkEditUsername",
            type: 'POST',
            data: {value:user_name,user_id:user_id},
            dataType: 'json',
            success:
            function(data)
            {
                if(data){
                    var Data1="User Name Already Exist";
                    $('#user_name').val('');
                    $('#user_name').focus();
                    $('#user_name_alert').html(Data1);
                    $('#user_name_alert').show();
                    $(".submit").attr("disabled", "disabled");
                    
                }
                else{
                    $('#user_name_alert').hide();
                    $('.submit').removeAttr('disabled');
                }
            },
            error:function(e){
            console.log("error");
            }
            });
        }
   
   }
});

////***Checking User name already existing*****///

////***File Saving Toggle*****///
$(document).ready(function () {
    $('#btn_toggle_file_saving').on('click', function () {
        var $btn = $(this);
        var currentValue = $btn.data('current');
        var isStopped = (currentValue === 'Y');

        $('#fileSavingModalTitle').text(isStopped ? 'Confirm Enable' : 'Confirm Stop');
        $('#fileSavingModalMsg').text(isStopped ? 'Do you want to enable force stop meta leads?' : 'Do you want to stop meta leads?');
        $('#fileSavingConfirmModal').modal('show');
    });

    $('#btnFileSavingConfirmYes').on('click', function () {
        $('#fileSavingConfirmModal').modal('hide');

        var $btn = $('#btn_toggle_file_saving');
        var currentValue = $btn.data('current');

        $.ajax({
            url: '<?php echo base_url(); ?>index.php/User/toggle_file_saving',
            type: 'POST',
            data: { current_value: currentValue },
            dataType: 'json',
            success: function (res) {
                if (res.status) {
                    var newValue = res.new_value;
                    var isStopped = (newValue === 'Y');

                    $btn.data('current', newValue);

                    if (isStopped) {
                        $btn.removeClass('btn-success').addClass('btn-danger').text('Force Stopped (Click to Enable meta leads)');
                    } else {
                        $btn.removeClass('btn-danger').addClass('btn-success').text('Meta leads Enabled (Click to Stop)');
                    }
                }
            },
            error: function () {
                alert('Failed to update file saving status.');
            }
        });
    });
});
////***File Saving Toggle*****///
  
</script>