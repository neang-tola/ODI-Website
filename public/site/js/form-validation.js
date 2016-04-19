$(document).ready(function() {
    $('#frm_submitcv').bootstrapValidator({
        container: 'tooltip',
//        trigger: 'blur',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        fields: {
            fullName: {
                validators: {
                    stringLength: {
                        enabled: false,
                        min: 4,
                        message: 'The full name at less 5 characters'
                    },
                    notEmpty: {
                        message: 'The full name is required field'
                    }
                }
            },
            gender: {
                validators: {
                    notEmpty: {
                        message: 'The gender is required field'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required field'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            position: {
                validators: {
                    notEmpty: {
                        message: 'The Current Position is required field'
                    }
                }
            },
            phoneNumber: {
                validators: {
                    notEmpty: {
                        message: 'The Phone Number is required field'
                    }
                }
            },
            applyFor: {
                validators: {
                    notEmpty: {
                        message: 'Apply for is required field'
                    }
                }
            },
            salaryExpect: {
                validators: {
                    notEmpty: {
                        message: 'Salary Expected is required field'
                    },
                    integer: {
                        message: 'Allow only number input'
                    }
                }
            },
            cvfiles: {
                validators: {
                    notEmpty: {
                        message: 'CV file is required field'
                    },
                    file: {
                        //extension: 'doc,docx,pdf,zip,rtf',
                        //type: 'application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/rtf,application/zip',
                        extension: 'doc,docx,pdf',
                        type: 'application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        maxSize: 2048*1024,
                        message: 'Please choose a pdf or doc file with a size less than 2M.'
                    }
                }
            }
        }
    });


    $('#frm_training_register').bootstrapValidator({
        container: 'tooltip',
        excluded: ':disabled',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        fields: {
            fullName: {
                validators: {
                    stringLength: {
                        enabled: false,
                        min: 4,
                        message: 'The full name at less 5 characters'
                    },
                    notEmpty: {
                        message: 'The full name is required field'
                    }
                }
            },
            organization: {
                validators: {
                    notEmpty: {
                        message: 'The organization is required field'
                    }
                }
            },
            trainingTitle: {
                validators: {
                    notEmpty: { 
                        message: 'The Training Title is required field'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required field'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            position: {
                validators: {
                    notEmpty: {
                        message: 'The Current Position is required field'
                    }
                }
            },
            contactNumber: {
                validators: {
                    notEmpty: {
                        message: 'The Phone Number is required field'
                    }
                }
            },
            numberPaticipant: {
                validators: {
                    notEmpty: {
                        message: 'Number Paticipant is required field'
                    }
                }
            }
        }
    });
});

$('body').on('change', '#file', function(){
    var doc = $(this).val();
    if(doc == ''){
        $('.file-upload-input').css('border', '1px solid red');
        $('.custom-file-upload').attr('title', 'CV is required field');
        $('.custom-file-upload').attr('data-original-title', 'CV is required field');
        $('.custom-file-upload').tooltip('show');
    }else{
        var img_size = $("#file")[0].files[0].size;
        var extension= $("#file").val().split(".").pop();
        var msg = '';
        if(img_size > 2097152){ msg = 'Maximum image upload size 2MB.'; }
        if(checkExtension(extension) == false){  msg = 'Allow only extension doc, docx, and pdf';   }
        
        if(msg == ''){
            $('.custom-file-upload').removeAttr('style');
            $('.custom-file-upload').attr('title', '');
            $('.custom-file-upload').attr('data-original-title', '');
        }else{
            $('.custom-file-upload').attr('title', msg);
            $('.custom-file-upload').attr('data-original-title', msg);
            $('.custom-file-upload').tooltip('show');
        }
    }
});

function checkExtension(extension)
{
    if(extension == "doc" || extension == "docx" || extension == "pdf")
    {
        return true;
    }else{
        return false;
    }
}