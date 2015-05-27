@extends('layouts.admin_default')
@section('pageContainer')
<div class="pageheader">
    <h2><i class="fa fa-home"></i> Dashboard <span>Subtitle goes here...</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li>
                {{Config::get('app.title')}}
            </li>
        </ol>
    </div>
</div>
<div class="contentpanel">
    <div class="panel panel-default">
        {{Form::open(array('url' => 'question/verify', 'method' => 'post', 'class' => 'form-horizontal form-bordered', 'id' => 'submit_form', 'autocomplete' => 'off'))}}
        <div class="panel-heading">
            <div class="panel-btns"></div>
            <h4 class="panel-title">General information</h4>
            <p></p>
            <div id="panelSuccess" class="alert alert-success alert-dismissable" style="display:none;">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">
                    &times;
                </button>
                <i class="fa fa-check-circle"></i><strong>Success!</strong>
                <p>
                    The question has been saved/updated successfully.
                </p>
            </div>
            <div id="panelFail" class="alert alert-danger alert-dismissable" style="display:none;">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">
                    &times;
                </button>
                <i class="fa fa-times-circle"></i><strong>Error!</strong>
                <p>
                    The information has not been saved/updated. Please correct the errors.
                </p>
            </div>
        </div>
        <div class="panel-body panel-body-nopadding">
            <div class="form-group">
                <label class="col-sm-3 control-label">Email <span class="asterisk">*</span></label>
                <div class="col-sm-6">
                    <input type="text" id="email" name="email" placeholder="Required" class="form-control" />
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Image <span class="asterisk">*</span></label>
                <div class="col-sm-7">
                    <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
                        <!-- Redirect browsers with JavaScript disabled to the origin page -->
                        <noscript>
                            <input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/">
                        </noscript>
                        <div id="f_image_add">
                            <div id="panelAdd" style="display:block;">
                                <button type="button" class="btn btn-default btn-xs image-modal-ajax" id="image-modal-ajax"
                                data-toggle="modal" data-url="{{URL::route('modals/addImage') }}">
                                    <i class="fa fa-plus"></i> Add Image... <span class="help-block"></span>
                                </button>
                            </div>
                            <div id="panelPreview" style="display:none;">
                                <div id="f_image_preview">
                                    <img id="f_img" src=''/>
                                </div>
                                <div id="f_image_delete">
                                    <button type="button" class="btn btn-default btn-xs delete-asset-front" data-toggle="modal">
                                        <i class="fa fa-minus"></i> Delete Image
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <span class="help-block">Please select the your image</span>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" id="total_questions" value="{{ $total_questions }}" />
                <table class="table table-hover table-striped" border="0">
                    <thead>
                        <tr>
                            <th width="25%"></th>
                            <th width="5%">A</th>
                            <th width="5%">B</th>
                            <th width="0.5%">C</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $question)
                        <tr>
                            <td width="25%">
                            <input type="hidden" id="question_{{ $question['key'] }}" name="correctval[]" value="{{ $question['correct'] }}" />
                            <label class="col-sm-3 control-label">{{ $question['title'] }}<span class="asterisk">*</span></label></td>
                            <td width="5%">
                            <input type="checkbox" class="check_{{ $question['key'] }}_a" id="answer_{{ $question['key'] }}_a" name="monthlyTransSummaryYN_a[]" value="{{ $question['a_a'] }}"/>
                            </td>
                            <td width="5%">
                            <input type="checkbox" class="check_{{ $question['key'] }}_b" id="answer_{{ $question['key'] }}_b" name="monthlyTransSummaryYN_b[]" value="{{ $question['a_b'] }}"/>
                            </td>
                            <td width="0.5%">
                            <input type="checkbox" class="check_{{ $question['key'] }}_c" id="answer_{{ $question['key'] }}_c" name="monthlyTransSummaryYN_c[]" value="{{ $question['a_c'] }}"/>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <button class="btn btn-primary">
                            Submit
                        </button>
                        &nbsp;
                        <button class="btn btn-default">
                            Cancel
                        </button>
                    </div>
                </div>
            </div><!-- panel-footer -->
            {{ Form::close() }}
        </div><!-- panel -->
    </div>
    <a id="info"/>
    <div id="full-width" class="modal container fade" tabindex="-1"></div>
    @endsection
    @section('javaScript')
    <!-- BEGIN UPLOADER -->
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    {{HTML::script('assets/js/jquery_uploader/vendor/jquery.ui.widget.js') }}
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    {{HTML::script('http://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js')}}
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    {{HTML::script('http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js')}}
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation
    {{HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js')}} -->
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    {{HTML::script('assets/js/jquery_uploader/jquery.iframe-transport.js') }}
    <!-- The basic File Upload plugin -->
    {{HTML::script('assets/js/jquery_uploader/jquery.fileupload.js') }}
    <!-- The File Upload processing plugin -->
    {{HTML::script('assets/js/jquery_uploader/jquery.fileupload-process.js') }}
    <!-- The File Upload image preview & resize plugin -->
    {{HTML::script('assets/js/jquery_uploader/jquery.fileupload-image.js') }}
    <!-- The File Upload audio preview plugin -->
    {{HTML::script('assets/js/jquery_uploader/jquery.fileupload-audio.js') }}
    <!-- The File Upload video preview plugin -->
    {{HTML::script('assets/js/jquery_uploader/jquery.fileupload-video.js') }}
    <!-- The File Upload validation plugin -->
    {{HTML::script('assets/js/jquery_uploader/jquery.fileupload-validate.js') }}
    <!-- BEGIN END -->

    <script>
        jQuery(document).ready(function() {
            App.init();
            UIExtendedModals.init();
            FormValidation.init();
        });

        var FormValidation = function() {

            var handleValidation1 = function() {
                // for more info visit the official plugin documentation:
                var form1 = $('#submit_form');
                var error1 = $('.alert-danger', form1);
                //var success1 = $('.alert-success', form1);
                form1.validate({
                    errorElement : 'span', //default input error message container
                    errorClass : 'help-block', // default input error message class
                    focusInvalid : false, // do not focus the last invalid input
                    ignore : "",
                    rules : {
                        email : {
                            required : true,
                            email : true
                        },
                    },

                    invalidHandler : function(event, validator) {//display error alert on form submit
                        //success1.hide();
                        error1.show();
                        App.scrollTo(error1, -200);
                    },

                    highlight : function(element) {// hightlight error inputs
                        $(element).closest('.form-group').addClass('has-error');
                        // set error class to the control group
                    },

                    unhighlight : function(element) {// revert the change done by hightlight
                        $(element).closest('.form-group').removeClass('has-error');
                        // set error class to the control group
                    },

                    success : function(label) {
                        label.closest('.form-group').removeClass('has-error');
                        // set success class to the control group
                    },

                    submitHandler : function(form) {
                        error1.hide();
                        // form.submit();
                        doSubmit();
                    }
                });
            }
            return {
                //main function to initiate the module
                init : function() {
                    handleValidation1();
                }
            };
        }();

        $(".delete-asset-front").click(function() {
            $('#panelAdd').css("display", "block");
            $('#panelPreview').css("display", "none");
            // alert("The paragraph was clicked.");
        });

        //$(".btn-primary").click(function() {
        function doSubmit() {
            var checkedValue_a = $('.check_1:checked').val();
            var checkedValue_b = $('.check_2:checked').val();
            var checkedValue_c = $('.correct').val();
            var correctval = $('.check_3:checked').val();
            var email = $('#email').val();

            cnt = $('#total_questions').val();
            quiz = "";
            for ( i = 0; i < cnt; i++) {
                a = $('#answer_' + i + '_a').val();
                b = $('#answer_' + i + '_b').val();
                c = $('#answer_' + i + '_c').val();
                r = $('#question_' + i).val();

                c_a = $('.check_' + i + '_a:checked').val();
                c_b = $('.check_' + i + '_b:checked').val();
                c_c = $('.check_' + i + '_c:checked').val();

                s = c_a + "|" + c_b + "|" + c_c;
                question = "a:" + a + ",b:" + b + "," + "c:" + c + ",r:" + r + ",s:" + s;

                quiz += question;
                if (i < cnt - 1)
                    quiz += "=";
            }
            // alert(quiz);
            var sendInfo = {
                quiz : quiz,
                email : email,
            };
            // window.open("question/verify/" + quiz);

            $.ajax({
                type : "POST",
                url : "question/verify",
                data : sendInfo,
                success : function(response) {
                    $('#panelSuccess').css("display", "block");
                    $('#panelFail').css("display", "none");
                    // alert(response.email);
                    // alert("");
                    // Redirect::route("mail/request");
                    // alert(response.correct_value);
                    // $('#info').html("OK! Data [" + allVals + "] Sent with Response:" + response);
                },
                error : function(e) {
                    $('#panelFail').css("display", "block");
                    $('#panelSuccess').css("display", "none");
                    // alert("=======");
                    // $('#info').html("OH NOES! Data[" + allVals + "] Not sent with Error:" + e);
                }
            });
        }
        //});

    </script>
    @endsection

