function validateData() {
if($("#fldCatDiscount").val() < 0){

       swal("There was an error", 
             "The field discount must be more 0 or more.. ", 
             "error");
            return false;  

    }else if($("#fldCatDiscount").val() == ""){

       swal("There was an error", 
             "The field discount is required", 
             "error");
            return false;  

    }else if ($("#fldCatName").val() == "") { 

        swal("There was an error", 
             "The field category name is required", 
             "error");    
        return false;

    }else if ($("#fldCatName").val() == "" && $("#fldCatDiscount").val() == "") {

        swal("ERROR", 
             "There isn't information in the form, try again", 
             "error");
    
        return false;

    } else {
        swal("", "", "success");
        return true;
    }
}       

function Validate(ctl, event) {
    event.preventDefault();
    swal({
        title: "Are you sure you want to save this information?",
        text: "Check the information before saving!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Save",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    
        function (isConfirm) {
            
            if (isConfirm) {
                if (validateData()) {
                    
                    $("#CategoryForm").submit();
                    isConfirm.closeOnConfirm = true
                }                 
            } else {
                swal("Canceled", "You didn't save!", "error");
            }
        });
}
