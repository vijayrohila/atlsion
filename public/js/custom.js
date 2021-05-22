$(function () {
    if ($('#country-list').length > 0) {
        $('#country-list').DataTable({
            processing: true,
            serverSide: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            "lengthMenu": [ [10, 25, 50, 100,500,-1], [10, 25, 50,100, 500,"All"] ],
            ajax: base_url + "/country/create",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'fee', name: 'fee'},
                {data: 'tax', name: 'tax'},              
                {data: 'total', name: 'total'},
                {data: 'currency', name: 'currency'}, 
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    }

    if ($('#sub-admin-list').length > 0) {
        $('#sub-admin-list').DataTable({
            processing: true,
            serverSide: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            "lengthMenu": [ [10, 25, 50, 100,500,-1], [10, 25, 50,100, 500,"All"] ],
            ajax: base_url + "/sub-admin/create",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'mobile', name: 'mobile'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    }

    if ($('#product-list').length > 0) {
        $('#product-list').DataTable({
            processing: true,
            serverSide: true,            
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            "lengthMenu": [ [10, 25, 50, 100,500,-1], [10, 25, 50,100, 500,"All"] ],
            ajax: base_url + "/product/create",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'question', name: 'question'},
                {data: 'image', name: 'image', orderable: false, searchable: false},
                {data: 'start_date', name: 'start_date'},
                {data: 'end_date', name: 'end_date'},                
                {data: 'action', name: 'action', orderable: false, searchable: false}               
            ]
        });
    }

    if ($('#player-list').length > 0) {
        $('#player-list').DataTable({
            processing: true,
            serverSide: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            "lengthMenu": [ [10, 25, 50, 100,500,-1], [10, 25, 50,100, 500,"All"] ],
            ajax: base_url + "/player/create",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'mobile', name: 'mobile'},
                {data: 'pay_through', name: 'pay_through', orderable: false, searchable: false},
                {data: 'score', name: 'score', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false}               
            ]
        });
    }

    if ($('#winner-list').length > 0) {
        $('#winner-list').DataTable({
            processing: true,
            serverSide: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            "lengthMenu": [ [10, 25, 50, 100,500,-1], [10, 25, 50,100, 500,"All"] ],
            ajax: base_url + "/winner-list",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'mobile', name: 'mobile'},
                {data: 'pay_through', name: 'pay_through', orderable: false, searchable: false},
                {data: 'score', name: 'score', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false}               
            ]
        });
    }
   
       
});

$(function(){

    $("#add-user").validate(); 

    $("#add-product").validate({
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            
            if ($("input[name='option']").length > 0) {
                let check = 0;
                $("input[name='option']").each(function() {
                    if($(this).prop("checked") == true){
                        check = 1;
                    }
                });
                if (check == 1) {     

                     var formData = new FormData(this);
                     $(this).submit(); 
                    // $.ajax({
                    //         url: base_url + "/product",
                    //         type: 'POST',
                    //         data:formData,
                    //         dataType: "json",
                    //         cache:false,
                    //         contentType: false,
                    //         processData: false,
                    //         beforeSend: function () {
                    //             $("#loading").show();
                    //         },
                    //         complete: function () {
                    //             $("#loading").hide();
                    //         },
                    //         success: function (result) {
                    //             if (result.status == "success") {                            
                    //                 toastr.success(result.message, 'Success');                                    
                    //                 //window.location.href = base_url+"/product"; 
                    //             } else {
                    //                 toastr.error(result.message, 'Error');
                    //             }                    
                    //         }
                    //     });                     
                } else {
                    $("#loading").hide();
                    toastr.error("Please select the Answer of Question", 'Error');
                }
                
            } else {
                $("#loading").hide();
                toastr.error("Please add question option first", 'Error');
            }
        }
    }); 

    $("#update-product").validate({
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            
            if ($("input[name='option']").length > 0) {
                let check = 0;
                $("input[name='option']").each(function() {
                    if($(this).prop("checked") == true){
                        check = 1;
                    }
                });
                if (check == 1) {                    
                    var formData = new FormData(this);
                    $(this).submit();
                    // $.ajax({
                    //         url: base_url + "/product",
                    //         type: 'POST',
                    //         data:formData,
                    //         dataType: "json",
                    //         cache:false,
                    //         contentType: false,
                    //         processData: false,
                    //         beforeSend: function () {
                    //             $("#loading").show();
                    //         },
                    //         complete: function () {
                    //             $("#loading").hide();
                    //         },
                    //         success: function (result) {
                    //             if (result.status == "success") {                            
                    //                 toastr.success(result.message, 'Success');                                    
                    //                 //window.location.href = base_url+"/product"; 
                    //             } else {
                    //                 toastr.error(result.message, 'Error');
                    //             }                    
                    //         }
                    //     });                     
                } else {
                    $("#loading").hide();
                    toastr.error("Please select the Answer of Question", 'Error');
                }
                
            } else {
                $("#loading").hide();
                toastr.error("Please add question option first", 'Error');
            }
        }
    });

     
    if($("#change-password").length > 0){
        $("#change-password").validate({
            rules: {
                    password:{
                        maxlength:20
                    },
                    password_confirmation : {
                            maxlength : 20,
                            equalTo : "#password"
                    }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
              $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
              $(element).removeClass('is-invalid');
            }
        }); 
    }

    if($("#add-admin").length > 0){
        $("#add-admin").validate({
            rules: {
                    password:{
                        maxlength:20
                    },
                    password_confirmation : {
                            maxlength : 20,
                            equalTo : "#password"
                    }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
              $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
              $(element).removeClass('is-invalid');
            }
        }); 
    }

    if($("#add-content").length > 0) {
        $("#add-content").validate({
            ignore: [],
            rules: { 
                contact_us:{
                     required: function() 
                    {
                     CKEDITOR.instances.contact_us.updateElement();
                    }
                },
                about_us:{
                     required: function() 
                    {
                     CKEDITOR.instances.about_us.updateElement();
                    }
                },
                term_condition:{
                     required: function() 
                    {
                     CKEDITOR.instances.term_condition.updateElement();
                    }
                },
                privacy_policy:{
                     required: function() 
                    {
                     CKEDITOR.instances.privacy_policy.updateElement();
                    }
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
              $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
              $(element).removeClass('is-invalid');
            }
        }); 
    }

    $("#add-country").validate({                
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }        
    });

    $("body").on('click', '.delete', function (event) {
        let obj = $(this);
        swal({
            title: "Are you sure you want to delete?",
            text: "",
            icon: "warning",
            buttons: ["Cancel", "Yes"],
        }).then((willDelete) => {
            if (willDelete) {
                let id = $(this).attr("id");
                //alert(id);
                let table = $(this).attr("data-table");
                $.ajax({
                    url: base_url+"/"+table+"/"+id,
                    type: 'delete',
                    //data: {id: id},
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    beforeSend: function () {
                        //obj.ladda().ladda('start');
                    },
                    complete: function () {
                        //obj.ladda().ladda('stop');
                    },
                    success: function (result) {
                        if (result.status == "success") {
                            $("#"+table+"-list").DataTable().ajax.reload();
                            toastr.success(result.message, 'Success');
                        } else {
                            toastr.error(result.message, 'Error');
                        }
                    }
                });
            }
        });
    }); 

    var index = $(".get-answer").length;

    $("body").on('click', '#add-option', function (event) {
        let option = $.trim($("#option").val());
        //index = $(".get-answer").length;
        if (!option) {
            toastr.error("Option field is required", 'Error');
            return false;
        }

        var html = `<p id="remove`+index+`"><input type="radio" id="option`+index+`" name="option" value="`+option+`" data-id="`+index+`" class="get-answer">
                    <label for="option`+index+`">`+option+`</label>
                    <button type="button" class="remove btn btn-danger" style="float:right" id="`+index+`">
                    <i class="fa fa-times" aria-hidden="true"></i></button></p>`;
        $("#list-option").append(html);  

        var html2 = `<p id="hide`+index+`">
                        <input type="hidden" name="select[`+index+`][option]" value="`+option+`">
                        <input type="hidden" name="select[`+index+`][answer]" value="0" class="option-answer">                    
                    </p>`;

        $("#list-answer").append(html2);            

        index++;   

        $("#option").val("");  
    });
    
    $("body").on('click', '.remove', function (event) {
        let index = $(this).attr("id");
        $("#remove"+index).remove();
        $("#hide"+index).remove();
    });

    $("body").on('click', '.get-answer', function (event) {
        let index = $(this).attr("data-id");
        $(".option-answer").val("0");
        $("input[name='select["+index+"][answer]']").val("1");
    });
    

});

$(function () {
    $("body").on('keypress', 'input[type=number]', function (e) {
        e = e || window.event;
        var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
        var charStr = String.fromCharCode(charCode);
        if (!charStr.match(/^[0-9]+$/))
        e.preventDefault();
    });

    $('.mySelect2').select2({
      selectOnClose: true
    });

    if($('#contact_us').length > 0){
        CKEDITOR.replace('contact_us');
        CKEDITOR.replace('about_us');
        CKEDITOR.replace('term_condition');
        CKEDITOR.replace('privacy_policy');
    }
})


$( function() {

    $(".datepicker").datepicker({dateFormat:"yy-mm-dd",maxDate:0});

    $("#date").datepicker({dateFormat:"yy-mm-dd"});

    var dateFormat = "yy-mm-dd",
      from = $( "#start" )
        .datepicker({
          minDate: 0,
          dateFormat:"yy-mm-dd",
          //changeMonth: true,
          //numberOfMonths: 3
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#end" ).datepicker({
        defaultDate: "+1w",
        dateFormat:"yy-mm-dd",
        //changeMonth: true,
        //numberOfMonths: 3
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
});

$( function() {
    var dateFormat = "yy-mm-dd",
      from = $( "#start_date" )
        .datepicker({
          //minDate: 0,
          dateFormat:"yy-mm-dd",
          //changeMonth: true,
          //numberOfMonths: 3
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#end_date" ).datepicker({
        defaultDate: "+1w",
        dateFormat:"yy-mm-dd",
        //changeMonth: true,
        //numberOfMonths: 3
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      } 
      return date;
    }
});
