<?php $this->load->view('includes/home-navbar'); ?>
<?php $this->load->view('includes/home-sidenav'); ?>


<div class="container row">
    <div class="col s1"></div>
    <div class="col s11">
        <blockquote class="color-primary-green">
            <h5 class="color-black">Multiple Topics</h5>
        </blockquote>
        <?php // echo form_open_multipart("Student_scores/read_excel/" . $this->uri->segment(3)); ?>
        <form enctype="multipart/form-data" action="<?php echo base_url() . "Student_scores/read_excel/" . $this->uri->segment(3); ?>" method="POST">
            <ul class="collection"  style="margin-bottom: 5%;">
                <li class="collection-item" id="li_s1" style="padding: 5%; margin-bottom: 1%;">
                    <div class="row  ">
                        <h5 class="valign-wrapper">Step
                            <i class="material-icons" style="padding-left: 1%;">filter_1</i>
                            <a class="tooltipped" data-position="bottom" data-delay="50" data-html="true" data-tooltip="*CELL 1A: 'student_number' or 'student number'<br>*CELL 1B: 'score' or 'scores'<br>*The system only reads the columns A and B<br>*Use other columns as guide (full name of student)">
                                <i class="material-icons right">help</i>
                            </a>
                        </h5>
                        <blockquote class="color-primary-green">
                            <h6 class="color-black">
                                Upload Student Info Using Excel with column of
                                <i class="color-primary-green">STUDENT_NUMBER</i> and <i class="color-primary-green">SCORE</i>
                            </h6>
                        </blockquote>

                        <!--produces error message-->
                        <blockquote class="color-red">
                            <?php if (isset($error_message)): ?>
                                <h6><b>ERROR:</b></h6>
                                <?php foreach ($error_message as $err): ?>
                                    <h6 class="color-red">
                                        <?php echo $err; ?>
                                    </h6>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </blockquote>
                    </div>
                    <div class="row">
                        <div class="col s2"></div>
                        <div class="col s8">

                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file" id="input_excel" name="excel">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>

                        </div>
                        <div class="col s2"></div>
                    </div>
                </li>
                <li class="collection-item white" id="li_s2" style="padding: 5%; margin-bottom: 1%; display: none;">
                    <div class="row">
                        <h5 class="valign-wrapper">Step
                            <i class="material-icons" style="padding-left: 1%;">filter_2</i>
                        </h5>
                        <blockquote class="color-primary-green">
                            <h6 class="color-black">
                                Specify the Total Score, Passing Score and Type of Score Source
                            </h6>
                        </blockquote>

                        <div class="col s1"></div>
                        <div class="col s9">
                            <div class="row">
                                <div class="input-field col s2 div_input">
                                    <input placeholder="" id="input_ts" name="total_score" type="number" min="1" class="validate" required>
                                    <label for="input_ts">Total Score</label>
                                </div>
                                <div class="input-field col s2 div_input">
                                    <input placeholder="" id="input_ps" name="passing_score" type="number" min="1" class="validate" required>
                                    <label for="input_ps">Passing Score</label>
                                </div>
                                <div class="input-field col s2"></div>

                                <div class="input-field col s6">
                                    <div class="col s10 div_input">
                                        <select id="select_ss" name="type_of_score" required>
                                            <option value="" disabled selected>Choose Type</option>
                                            <option value="1">Long Quiz</option>
                                            <option value="2">Short Quiz</option>
                                            <option value="3">Seatwork</option>
                                            <option value="4">Exam</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="add_ss_div">
                                <button type="button" class="right btn waves-light waves-effect bg-primary-green" id="btn_submit_ss">Next</button>
                            </div>

                        </div>
                        <div class="col s2"></div>
                    </div>
                </li>
                <li class="collection-item white" id="li_s3" style="padding: 5%; margin-bottom: 1%;  display: none;">
                    <div class="row  ">
                        <h5 class="valign-wrapper">Step
                            <i class="material-icons" style="padding-left: 1%;">filter_3</i>

                        </h5>
                        <blockquote class="color-primary-green">
                            <h6 class="color-black">
                                Select the coverage of your score source.
                            </h6>
                        </blockquote>

                        <div class="col s2"></div>
                        <div class="col s8">
                            <blockquote class="color-primary-green">
                                <h6 class="color-black"><b>Selected Topics :</b></h6>
                            </blockquote>
                            <div class="row">
                                <div class="col s4"></div>
                                <div class="col s4"  id="show_list">

                                </div>
                                <div class="col s4"></div>
                            </div>
                            <div class="row">
                                <div class="col s4"></div>
                                <div class="col s4">
                                    <button class="btn bg-primary-green center waves-effect waves-light modal-trigger" type="button"  href="#modal_topics"  type="submit">Topics</button>
                                </div>
                                <div class="col s4"></div>
                            </div>
                        </div>
                        <div class="col s2"></div>
                    </div>

                </li>
                <li class="collection-item white" id="li_s4" style="padding: 5%; margin-bottom: 1%;  display: none;">
                    <div class="row  ">
                        <h5 class="valign-wrapper">Step
                            <i class="material-icons" style="padding-left: 1%;">filter_4</i>

                        </h5>
                        <blockquote class="color-primary-green">
                            <h6 class="color-black">
                                Submit
                            </h6>
                        </blockquote>
                        <div class="col s4"></div>
                        <div class="col s4">
                            <button class="btn bg-primary-green center waves-effect waves-light" type="submit">IMPORT SCORES</button>
                        </div>
                        <div class="col s4"></div>

                    </div>
                </li>
            </ul>

            <!-- Modal Structure -->
            <div id="modal_topics" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <blockquote class="color-primary-green">
                        <h4 class="color-black">Topic List</h4>
                    </blockquote>
                    <?php
                    $active_enrollment = $this->Crud_model->fetch("enrollment", array("enrollment_is_active" => 1));
                    $active_enrollment = $active_enrollment[0];
                    // fetch course
                    $course = $this->Crud_model->fetch("course", array("enrollment_id" => $active_enrollment->enrollment_id, "course_department" => $info['user']->fic_department));
                    // fetch subjects
                    ?>
                    <div class="row">
                        <?php if ($course): ?>
                            <?php foreach ($course as $key => $value): ?>
                                <?php
                                $subjects = $this->Crud_model->fetch("subject", array("course_id" => $value->course_id));
                                // fetch topic
                                ?>
                                <?php if ($subjects): ?>
                                    <?php foreach ($subjects as $key => $i_value): ?>
                                        <?php
                                        // $topic = $this->Crud_model->fetch("topic", array("subject_id" => $i_value->subject_id, "topic_done" => 0));
                                        $topic = $this->Crud_model->fetch("topic", array("subject_id" => $i_value->subject_id));
                                        ?>
                                        <?php if ($topic): ?>
                                            <?php $count = 1; ?>
                                            <?php foreach ($topic as $key => $j_value): ?>
                                                <?= $count%4 == 0 ? "<div class='row'>": '' ?>
                                                    <div class="col s3">
                                                        <p><input type="checkbox" value="<?= $j_value->topic_id ?>" class="filled-in topic_list_c" name="topic_list[]" id="<?= $j_value->topic_id ?>" />
                                                            <label id="lbl_t_<?= $j_value->topic_id ?>" for="<?= $j_value->topic_id ?>"><?= $j_value->topic_name ?></label>
                                                        </p>
                                                    </div>
                                                    <?= $count%4 == 0 ? "</div>": '' ?>
                                                    <?php $count = $count + 1; ?>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" type="button" id="btn_add_topic" class="modal-action modal-close waves-effect waves-light btn bg-primary-green ">Agree</a>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            var o_ex = false;
            window.onbeforeunload = function () {
                if (o_ex == true) {
                    return 'Leave the exam? This exam will not be recorded if you leave.';
                }
            }


            $("#btn_add_ss").click(function (event) {
                if ($("#add_ss_div").css('display') == "none") {
                    $(this).html("remove");
                    $("#add_ss_div").fadeIn('slow', function () {
                        $("#add_ss_div").css('display', 'block');
                    });
                } else {
                    $(this).html("add_circle");
                    $("#add_ss_div").fadeOut('slow', function () {
                        $("#add_ss_div").css('display', 'none');
                    });
                }
            });

        // onchange file input

        $("#input_excel").change(function (event) {
            /* Act on the event */
            if ($("#input_excel").val() != "") {
                // console.log(true);
                o_ex = true;
                $('#li_s2').fadeIn('fast', function () {
                    $("#li_s2").css('display', 'block');
                });
            } else {
                $('#li_s2').fadeOut('fast', function () {
                    $("#li_s2").css('display', 'none');
                });
                $('#li_s3').fadeOut('fast', function () {
                    $("#li_s3").css('display', 'none');
                });
            }
        });


        // Add topic to list
        $("#btn_add_topic").click(function (event) {
            var data_html = "";
            $('.topic_list_c:checkbox:checked').each(function () {
                var sThisVal = (this.checked ? $(this).attr("id") : "");
                var label = $("#lbl_t_" + sThisVal).html();
                data_html += "*" + label + "<br>";
            });
            $("#show_list").html(data_html);

            if ($("#show_list").html() == "") {
                $toast = '<span>Must Choose Topic</span>';
                Materialize.toast($toast, 2000);

                $('#li_s4').fadeOut('fast', function () {
                    $("#li_s4").css('display', 'none');
                });
            } else {
                $('#li_s4').fadeIn('fast', function () {
                    $("#li_s4").css('display', 'block');
                });
            }
        });

        $("#btn_submit_ss").click(function (event) {

            $total_s = parseInt($("#input_ts").val());
            $passing_s = parseInt($("#input_ps").val());
            $select = $("#select_ss").val();

            if ($passing_s > $total_s) {
                $toast = '<span>Passing Score must be less than Total Score</span>';
                Materialize.toast($toast, 2000);
            } else if (!$total_s || !$passing_s || $select == null) {
                $toast = '<span>All values must not be null</span>';
                Materialize.toast($toast, 2000);
            } else {
                $('#li_s3').fadeIn('fast', function () {
                    $("#li_s3").css('display', 'block');
                });
            }

        });
        $("#input_ts").change(function (event) {
            $total_s = parseInt($("#input_ts").val());
            $passing_s = parseInt($("#input_ps").val());
            $select = $("#select_ss").val();
            if ($passing_s > $total_s) {
                $toast = '<span>Passing Score must be less than Total Score</span>';
                Materialize.toast($toast, 2000);
                $('#li_s3').fadeOut('fast', function () {
                    $("#li_s3").css('display', 'none');
                });
            } else if (!$total_s) {
                $toast = '<span>Total Score must not be null</span>';
                Materialize.toast($toast, 2000);
                $('#li_s3').fadeOut('fast', function () {
                    $("#li_s3").css('display', 'none');
                });
            }
        });
        $("#input_ps").change(function (event) {

            $total_s = parseInt($("#input_ts").val());
            $passing_s = parseInt($("#input_ps").val());
            $select = $("#select_ss").val();

            if ($passing_s > $total_s) {
                $toast = '<span>Passing Score must be less than Total Score</span>';
                Materialize.toast($toast, 2000);
                $('#li_s3').fadeOut('fast', function () {
                    $("#li_s3").css('display', 'none');
                });
            } else if (!$passing_s) {
                $toast = '<span>Passing Score must not be null</span>';
                Materialize.toast($toast, 2000);
                $('#li_s3').fadeOut('fast', function () {
                    $("#li_s3").css('display', 'none');
                });
            }

        });


        /*==========================================
         =            jQuery Animate Css            =
         ==========================================*/

         $.fn.extend({
            animateCss: function (animationName, callback) {
                var animationEnd = (function (el) {
                    var animations = {
                        animation: 'animationend',
                        OAnimation: 'oAnimationEnd',
                        MozAnimation: 'mozAnimationEnd',
                        WebkitAnimation: 'webkitAnimationEnd',
                    };

                    for (var t in animations) {
                        if (el.style[t] !== undefined) {
                            return animations[t];
                        }
                    }
                })(document.createElement('div'));

                this.addClass('animated ' + animationName).one(animationEnd, function () {
                    $(this).removeClass('animated ' + animationName);

                    if (typeof callback === 'function')
                        callback();
                });

                return this;
            },
        });

         /*=====  End of jQuery Animate Css  ======*/


     });
 </script>