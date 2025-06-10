<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js"
        integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Bootstrap CSS (optional but recommended) -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Document</title>
    <style>
        .custom_select {
            margin: 20px 0px !important;
        }

        .select2-search__field {

            height: 47px !important;
        }

        .select2-container--default .select2-selection--multiple {
            border-radius: 6px !important;
            border: 1px solid rgb(230, 234, 236) !important;
            /* overflow-y: scroll; */
        }

        .select2-container--default.select2-container--focus.select2-container--open {
            box-shadow: 0 0 0 5px rgba(21, 156, 228, 0.4);
            /* Customize this */
            border-radius: 4px;
        }

        .select2-selection--multiple {
            min-height: 60px !important;
            max-height: 60px !important;
            overflow-y: scroll !important;
            overflow-x: hidden;
        }

        #users_table tbody th {
            background-color: black;

        }

        th {
            border-left: 1px solid rgb(26, 14, 14);
        }

        td {
            border: 1px solid beige;
            text-align: center;
        }

        body {
            position: relative;
        }

        .loader {
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.401);
            position: absolute;
            top: 0;
            left: 0;
            z-index: 9999999999;
        }


        .userImage {
            border-radius: 50%;
            transition: all 0.5s ease;
        }

        .userImage:hover {
            cursor: pointer;
            border-radius: 5%;
            transform: scale(1.2);
        }

        #update_hobbies_error {
            color: red;
            position: absolute;
            bottom: -20px;
        }

        .min-loader h1 {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 4px solid rgb(172, 172, 174);
            border-left: 4px solid blue;
            animation: spinner 1s infinite;
        }

        @keyframes spinner {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="loader">
        <div style="height: 100vh;" class="d-flex min-loader justify-content-center align-items-center ">
            <h1></h1>
        </div>
    </div>

    <div class=" my-5 d-flex justify-content-center align-items-center container">
        <div class="text-center d-flex justify-content-center align-items-center"
            style="width:100%; box-shadow: 10px -2px 10px rgb(61 172 47 / 11%); padding: 30px; background-color: rgb(250, 251, 251); ">
            <div style="width:100%; box-shadow: 10px -2px 10px rgb(0 0 0 / 4%); padding: 30px; background-color: rgb(250, 251, 251);"
                class="d-flex justify-content-center align-items-center">

                <form id="insert-form" class="row  ">
                    <h1 class="text-uppercase text-center my-5">Insert User</h1>

                    @csrf
                    <div class="col-12 col-md-4 col-lg-4  my-2 form-floating ">
                        <input type="text" id="name" class="form-control" name="name" placeholder="Name"
                            autocomplete="off" />
                        <label for="name" class="px-4 text-uppercase">name</label>
                        <span id="name_error" class=" mx-1 text-danger d-block text-start" name="name_error"></span>
                    </div>
                    <div class="col-12 col-md-4 my-2 form-floating">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                            autocomplete="off" />
                        <label for="email" class="px-4 text-uppercase">EMAIL</label>
                        <span id="email_error" class=" mx-1 text-danger d-block text-start"></span>
                    </div>
                    <div class="col-12 col-md-4 my-2 form-floating">
                        <input type="text" id="password" class="form-control" name="password" placeholder="password"
                            autocomplete="off" />
                        <label class="px-4 text-uppercase">password</label>
                        <span id="password_error" class="mx-1 text-danger d-block text-start"></span>

                    </div>
                    <div class="col-12 my-2 col-md-4 form-floating col-md-4">
                        <input type="text" class="form-control" id="conPassword" name="con_password" autocomplete="off"
                            placeholder="confirm Password" />
                        <label for="conPassword" class="px-4 text-uppercase">Confirm PASSWOrd</label>
                        <span id="con_password_error" class=" mx-1 text-danger d-block text-start"></span>
                    </div>
                    <div class="col-12 col-md-4 d-flex my-2 justify-content-start align-items-center ">
                        <label class=" gap-2 d-block">
                            <div class="d-flex flex-wrap gap-2 d-block">Gender:
                                <input class="form-check" type="radio" name="gender" id="male" value="male"><label
                                    for="male">Male</label>
                                <input class="form-check" type="radio" name="gender" id="female" value="female"><label
                                    for="female">Female</label>
                                <input class="form-check" type="radio" name="gender" id="others" value="others"><label
                                    for="others">Others</label>
                            </div>
                            <span id="gender_error" class="mx-1 text-danger d-block text-start"></span>
                        </label>
                    </div>
                    <div class="col-12 col-md-4 d-flex my-2  justify-content-start align-items-center">
                        
                        <label class=""> 
                            <div class="d-flex flex-wrap gap-2">Hobbies:
                            <input class="form-check" type="checkbox" name="hobbies[]" id="games" value="games"><label
                                for="games">Games</label>
                            <input class="form-check" type="checkbox" name="hobbies[]" id="reading"
                                value="reading"><label for="reading"> Reading</label>
                            <input class="form-check" type="checkbox" name="hobbies[]" id="coding" value="coding"><label
                                for="coding">Coding</label>
                            <input class="form-check" type="checkbox" name="hobbies[]" id="travel" value="travel"><label
                                for="travel">travel</label>
    </div>
     <span id="hobbies_error" class="text-start d-block text-danger"></span>
                        </label>
                       
                    </div>
                    <div class="col-12 col-md-4 my-3 form-floating" style="height: 45px;">
                        <select class="form-select form-control  my-select custom_select" id="course"
                            multiple="multiple" name="course[]" style="width: 100%; height: 100%; overflow-y: scroll;">
                            <option value="bca">bca</option>
                            <option value="mca">mca</option>
                            <option value="bba">bba</option>
                            <option value="ba">ba</option>
                            <option value="bcom">bcom</option>
                            <option value="bcom">ma</option>
                            <option value="bcom">mca</option>
                        </select>
                        <span id="course_error" class="text-danger mx-1 d-block text-start"></span>
                    </div>

                    <div class="col-12 col-md-4 mt-4 mb-3">
                        <select id="state" class="form-select p-3" name="state">
                            <!-- <option value="">Choose State</option>
                            <option value="karnataka">karnataka</option>
                            <option value="Andra Pradesh">Andra Pradesh</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Tamilnadu">Tamilnadu</option> -->

                           {{-- <?php foreach($states as $state){ ?>
                             <option value="<?php echo $state['id'] ?>"><?php echo $state['name'] ?></option>
                            <?php }?> 
                           --}}
                            <option value="">Choose State</option>

                            @foreach($states as $state)
                            <option value="{{$state->id}}">{{$state->state}}</option>
                            @endforeach

                        </select>
                        <span id="state_error" class="text-danger mx-1 d-block text-start"></span>
                    </div>

                    <div class="col-12 col-md-4 form-floating ">
                        <input type="file" class="form-control" name="file" id="file">
                        <label for="file" class="mx-3">Image</label>
                        <span id="file_error" class="text-danger mx-1 d-block text-start"></span>
                    </div>
                    <div style="width: 100%;" class="d-flex justify-content-center align-items-center my-5">
                        <button id="button" class="text-center btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- ------------------------------- -->
    <div class="row" style="width: 100%;">
        <div class="col-md-6">
            <div id="chart"></div>
        </div>
        <div class="col-md-6">
            <div id="chart2"></div>
        </div>
    </div>
    <div class="p-2">
        <table class="table mt-5 " style="width: 100%;" id="users_table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Image</th>
                    <th>name</th>
                    <th>email</th>
                    <th>course</th>
                    <th>gender</th>
                    <th>state</th>
                    <th>hobbies</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>



    <div class="modal fade my-5 modal-xl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">User Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-floating row my-5" id="update_form">
                        <div class="form-floating" hidden>
                            <input disabled id="edit-id" hidden class="form-control" />
                        </div>
                        <div class="col-4 form-floating my-2">
                            <input type="text" placeholder="name" class="form-control" id="edit-name" name="name" />
                            <label for="edit-name" class="px-4 text-uppercase">name</label>
                            <span id="update_name_error" class="text-danger"></span>
                        </div>
                        <div class="col-4 form-floating my-2">
                            <input type="text" placeholder="email" class="form-control" id="edit-email" name="email" />
                            <label for="edit-email" class="px-4 text-uppercase">email</label>
                            <span id="update_email_error" class="text-danger"></span>
                        </div>
                        <div class="col-4">
                            <select id="edit-state" name="state" class="form-select p-3 my-2" name="state">
                                <!-- <option value="karnataka">karnataka</option>
                                <option value="Andra Pradesh">Andra Pradesh</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Tamilnadu">Tamilnadu</option> -->
                                @foreach($states as $state)
                                <option value="{{$state->id}}">{{$state->state}}</option>
                                 @endforeach
                            </select>
                           

                        </div>
                        <div class="col-4  form-floating my-2 ">
                            <select aria-label=" Multiple Size 3 " select example" class="form-select position-relative"
                                name="course" style="width:100%" id="edit-course" multiple>
                            </select>

                            <span id="update_course_error" class="text-danger"></span>
                        </div>

                        <div class="col-12 d-flex justify-content-start align-items-center  position-relative my-4">
                            <label class="d-flex gap-2"> Hobbies:
                                <input class="form-check" type="checkbox" name="hobbies" id="edit_games"
                                    value="games"><label for="edit_games">Games</label>

                                <input class="form-check" type="checkbox" name="hobbies" id="edit_reading"
                                    value="reading"><label for="edit_reading">Reading</label>

                                <input class="form-check" type="checkbox" name="hobbies" id="edit_coding"
                                    value="coding"><label for="edit_coding">Coding</label>

                                <input class="form-check" type="checkbox" name="hobbies" id="edit_travel"
                                    value="travel"><label for="edit_travel">travel</label>
                            </label>
                            <span id="update_hobbies_error" class="text-danger"></span>
                        </div>

                        <div class="col-6 col-md-6 d-flex justify-content-start align-items-center ml-2 ">
                            <label class=" gap-2 d-block">
                                <div class="d-flex flex-wrap gap-2 d-block">Gender:
                                    <input class="form-check" type="radio" class="edit-gender" name="gender"
                                        id="edit_male" value="male"><label for="edit_male">Male</label>
                                    <input class="form-check" type="radio" class="edit-gender" name="gender"
                                        id="edit_female" value="female"><label for="edit_female">female</label>
                                    <input class="form-check" type="radio" class="edit-gender" name="gender"
                                        id="edit_others" value="others"><label for="edit_others">others</label>
                                </div>
                                <span id="gender_error" class="mx-1 text-danger d-block text-start"></span>
                            </label>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save-changes" aria-label="Close">Save
                            changes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close"
                            id="delete-user">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery (MUST come first) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


        <!-- jQuery Validation Plugin -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
            integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->

        <!-- <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script> -->
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"> -->
        <!-- Responsive Extension JS -->
        <!-- <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script> -->




        <script>

            //email validate regex

            $.validator.addMethod('emailRegex', function (value, element) {
                return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/i.test(value)
            }, "Please enter valid email address")


            console.log(typeof jQuery);
            $(".loader").hide();
            $(document).ready(function () {
                $('#course').select2({
                    placeholder: "Select courses"
                });

                $('#edit-course').select2({
                    placeholder: "Select courses",
                    dropdownParent: $('#exampleModal')
                })
                getuserrecords();

                //update form validation

                $("#update_form").validate({
                    rules: {
                        name: "required",
                        email: {
                            required: true,
                            emailRegex: true
                        },
                        course: "required",
                        hobbies: "required"


                    },
                    messages: {
                        name: "Name is required",
                        email: {
                            required: "Email is required",
                            emailRegex: "Enter valid email"
                        },
                        course: "choose course",
                        hobbies: "choose hobbies"
                    },

                    errorPlacement: function (error, element) {
                        console.log(element)
                        console.log(error)
                        if (element.attr("name") == "name") {
                            error.appendTo('#update_name_error');
                        }
                        else if (element.attr("name") == "email") {
                            error.appendTo('#update_email_error')
                        }
                        else if (element.attr("name") === "course") {
                            error.appendTo("#update_course_error")
                        } else if (element.attr("name") === "hobbies") {
                            error.appendTo('#update_hobbies_error')
                        }
                        else {
                            error.insertAfter(element);
                        }
                    },
                });

                //update user details

                $('#save-changes').click(function (e) {
                    if ($('#update_form').valid()) {
                        const id = $("#edit-id").val()
                        const name = $("#edit-name").val()
                        const email = $("#edit-email").val()
                        const course = $('#edit-course').val()
                        const state = $('#edit-state').val()
                        const games = $('#edit_games').val()
                        const coding = $('#edit_coding').val()
                        const travel = $('#edit_travel').val()
                        const reading = $('#edit_reading').val()
                        const male = $('#edit_male').val()
                        const gender = $('input[name="gender"]:checked').val();


                        const hobbies = {}
                        if ($('#edit_games').is(':checked')) {
                            hobbies.games = games
                        }
                        if ($('#edit_coding').is(':checked')) {
                            hobbies.coding = coding
                        }
                        if ($('#edit_travel').is(':checked')) {
                            hobbies.travel = travel
                        }
                        if ($('#edit_reading').is(':checked')) {
                            hobbies.reading = reading;
                        }

                        const data = {
                            id: id,
                            name: name,
                            email: email,
                            course: course,
                            state: state,
                            hobbies: hobbies,
                            gender: gender,
                            '_token': '{{ csrf_token() }}'
                        }
                        console.log(id, name, email, course)
                        $.ajax({
                            url: '/update_form',
                            method: 'post',
                            data: data,
                            success: function (response) {
                                let modalEle = document.querySelector('.modal')
                                console.log(modalEle)
                                const modal = bootstrap.Modal.getInstance(modalEle)
                                if (modal) {
                                    modal.hide()
                                } else {
                                    new bootstrap.Modal(modalEle).hide()
                                }
                                alert("upated successfully")
                                getuserrecords()
                            }
                        })
                    }
                })

                //delet user

                $('#delete-user').click(function () {
                    const id = $('#edit-id').val()
                    console.log("delete id :", id)
                    let confirmResult = confirm(`are you sure you want to delete ${id}`)
                    if (confirmResult) {
                        const data = {
                            id: id,
                            '_token': '{{ csrf_token() }}'

                        }
                        $.ajax({
                            url: '/delete_user',
                            method: "delete",
                            data: data,
                            success: function (response) {
                                alert("deleted successfully");
                                getuserrecords()
                            }
                        })
                    }
                })

                //insert validation
                $("#insert-form").validate({
                    rules: {
                        name: "required",
                        email: {
                            required: true,
                            emailRegex: true
                        },
                        password: "required",
                        con_password: {
                            "required": true,
                            equalTo: "#password"
                        },
                        course: "required",
                        gender: "required",
                        state: "required",
                        file: "required",
                        "course[]": {
                            required: true,
                        },
                        "hobbies[]": "required"
                    },
                    messages: {
                        name: "Name is required",
                        email: {
                            required: "Email is required",
                            emailRegex: "Enter valid email"
                        },
                        password: "password is required",
                        con_password: {
                            required: "confirm password is required",
                            equalTo: "passwords do not match"
                        },
                        course: "choose course",
                        gender: "select gender",
                        state: "select state",
                        file: "choose file",
                        hobbies: "please select hobbies"
                    },

                    errorPlacement: function (error, element) {
                        if (element.attr("name") == "name") {
                            error.appendTo('#name_error');
                        }
                        else if (element.attr("name") == "email") {
                            error.appendTo('#email_error');
                        } else if (element.attr("name") === "password") {
                            error.appendTo('#password_error')
                        } else if (element.attr("name") === "con_password") {
                            error.appendTo("#con_password_error")
                        }
                        else if (element.attr("name") === "course[]") {
                            error.appendTo("#course_error")
                        } else if (element.attr("name") === "gender") {
                            error.appendTo("#gender_error")
                        }
                        else if (element.attr("name") === "file") {
                            error.appendTo("#file_error")
                        } else if (element.attr("name") === "state") {
                            error.appendTo("#state_error")
                        } else if (element.attr("name") === "hobbies[]") {
                            error.appendTo('#hobbies_error')
                        }
                        else {
                            error.insertAfter(element);
                        }
                    },
                });

                //inserting data

                $('#insert-form').submit(function (e) {

                    console.log("submit")
                    e.preventDefault();
                    console.log($("#insert-form"));

                    if ($("#insert-form").valid()) {
                        let form = $('#insert-form')[0];
                        let formData = new FormData(form)
                        console.log("formdata ", formData)
                        $(".loader").show();

                        $.ajax({
                            type: "post",
                            url: "insert2",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                $(".loader").hide();
                                console.log(data)
                                $("#insert-form")[0].reset();
                                $('#course').val(null).trigger('change')
                                alert("inserted successfully");
                                getuserrecords()
                            },
                            error: function (error) {
                                $(".loader").hide();
                                console.log(error.responseText)
                            }
                        })
                    }
                });
                getGraphData()
            })

            //get all user details
            function getuserrecords_w() {
                $.ajax({
                    url: "users",
                    method: "get",
                    success: function (data) {
                        // console.log("hello user")
                        console.log(data)
                        let tbody = $('#tablebody');
                        tbody.html('')
                        data.forEach((element) => {
                            tbody.append(
                                `<tr>
                            <td class="text-center border-2" >${element.name}</td>
                            <td class="text-center border-2" >${element.email}</td>
                            <td class="text-center border-2" >${element.course}</td>
                            <td class="text-center border-2" style="cursor:pointer" >
                            <i class="fa-solid fa-eye  " data-bs-toggle="modal" data-bs-target="#exampleModal"
                            onclick="get_info(${element.id});"
                            ></i>
                            </td>
                            </tr>`
                            )
                        });
                    },
                    error: function (e) {
                        console.log(e.responseText)
                    }
                })
            }

            //get user by id

            function get_info(id) {
                let data = {
                    id: id,
                    _token: '{{ csrf_token() }}'
                };
                $.ajax({
                    url: 'get_user_by_id',
                    type: 'post',
                    data: data,
                    success: function (resp) {
                        let parse = JSON.parse(resp)
                        console.log(parse)
                        $('#edit-id').val(parse[0].id);
                        $('#edit-name').val(parse[0].name);
                        $('#edit-email').val(parse[0].email);
                        $('#edit-state').val(parse[0].state);
                        let gender = $('edit-gender').val(parse[0].gender)
                        console.log(parse[0].gender)
                        if (parse[0].gender === "male") {
                            $('#edit_male').val(parse[0].gender).prop('checked', true)
                        } else if (parse[0].gender === "female") {
                            $('#edit_female').val(parse[0].gender).prop('checked', true)
                        } else {
                            $('#edit_others').val(parse[0].gender).prop('checked', true)
                        }
                        let hobbies = parse[0].hobbies?.split(",")
                        console.log(hobbies)
                        hobbies?.forEach(item => {
                            $(`#edit_${item}`).prop('checked', true)
                        })
                        let courseEle = $('#edit-course');
                        let userCourse = parse[0].course;
                        userCourse = userCourse.split(',');
                        console.log(userCourse);
                        courseEle.empty()
                        let courses = ['mca', 'bba', 'ba', 'bca', 'bcom']
                        courses.forEach(item => {
                            courseEle.append(
                                `<option value="${item}">
                              ${item}
                             </option>`
                            )
                        })
                        courseEle.val(userCourse);
                    }
                })
            }

            //get all users storing data in data tables

            function getuserrecords() {
                // If DataTable is already initialized, destroy it
                if ($.fn.DataTable.isDataTable('#users_table')) {
                    $('#users_table').DataTable().destroy();
                }
                // Reinitialize the DataTable
                $('#users_table').DataTable({
                    responsive: true,
                    autoWidth: false,
                    paging: true,
                    searching: true,
                    info: true,
                    scrollX: true,
                    ajax: {
                        url: 'users',
                        dataSrc: 'data'
                    },
                    "columns": [
                        {
                            "data": "id",
                            "title": "#"
                        },
                        {
                            "data": "name",
                            "title": "Name"
                        },
                        {
                            "data": "email",
                            "title": "Email Address"
                        },
                        {
                            "data": "course",
                            "title": "Courses"
                        },
                        {
                            "data": "gender",
                            "title": "gender"
                        },
                        {
                            "data": "userstate",
                            "title": "state"
                        },
                        {
                            "data": "hobbies",
                            "title": "hobbies"
                        },
                        {
                            "data": "filePath",
                            "title": "user Image",
                            render: function (data, type, row) {
                                console.log(data)
                                console.log(type)
                                console.log(row)
                                var imageUrl = '/assets/img/' + data
                                return `<img src=${imageUrl} height="50" width="50" alt="student image" class='userImage'>`
                            }
                        },
                        {
                            "data": "id",
                            render: function (data, full, row) {
                                var date = data.id;
                                return '<button data-bs-toggle="modal" data-bs-target="#exampleModal" type="submit" class="btn btn-danger" onclick="get_info(\'' + data + '\')"><i class="fa-solid fa-eye"></i></button>';
                            },
                            "title": "Action"
                        },
                    ],
                    columnDefs: [{
                        "width": "1%",
                        "targets": 0,
                        "orderable": true,
                        "className": "dt-center",
                        "searching": false
                    },
                    {
                        "targets": 1,
                        "width": "1%",
                        "className": "dt-center"
                    },
                    {
                        "targets": 2,
                        "width": "1%",
                        "className": "dt-center"
                    },
                    {
                        "targets": 3,
                        "width": "1%",
                        "className": "dt-center"
                    },
                    {
                        "targets": 4,
                        "width": "1%",
                        "className": "dt-center"
                    },
                    {
                        "targets": 5,
                        "width": "1%",
                        "className": "dt-center"
                    },
                    {
                        "targets": 6,
                        "width": "1%",
                        "className": "dt-center"
                    },
                    {
                        "targets": 7,
                        "width": "1%",
                        "className": "dt-center"
                    },
                    {
                        "targets": 8,
                        "width": "1%",
                        "className": "dt-center"
                    },
                    ],
                });
            }

            //graph data courses

            function getGraphData() {
                console.log("hello")
                $.ajax({
                    url: '/courses_data',
                    method: "post",
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (data) {
                        let parse = JSON.parse(data)
                        let active = parse.filter(elem => elem.stats == 'active');
                        let names = active.map(item => item.course_name)
                        let courseData = active.map(item => item.course)

                        //inactive
                        let inactive = parse.filter(elem => elem.stats == 'inactive');
                        let inActiveNames = inactive.map(item => item.course_name)
                        let inActivecourseData = inactive.map(item => item.course)
                        console.log("inactive", inactive)


                        let chartData = {
                            data: courseData,
                            names: names
                        }
                        let chartData2 = {
                            data: inActivecourseData,
                            names: inActiveNames

                        }
                        loadChart(chartData)
                        loadChart2(chartData2)
                    }
                })
            }

            //courses active
            function loadChart(data) {
                console.log(data)
                var options = {
                    series: [{
                        name: 'active Memebers',
                        data: data.data
                    }],
                    chart: {
                        height: 350,
                        type: 'bar',
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 5,
                            dataLabels: {
                                position: 'top', // top, center, bottom
                            },
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function (val) {
                            return val + "";
                        },
                        offsetY: -20,
                        style: {
                            fontSize: '12px',
                            colors: ["#304758"]
                        }
                    },

                    xaxis: {
                        categories: data.names,
                        position: 'bottom',
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        crosshairs: {
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    colorFrom: '#D8E3F0',
                                    colorTo: '#BED1E6',
                                    stops: [0, 100],
                                    opacityFrom: 0.4,
                                    opacityTo: 0.5,
                                }
                            }
                        },
                        tooltip: {
                            enabled: true,
                        }
                    },
                    yaxis: {
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false,
                        },
                        labels: {
                            show: false,
                            formatter: function (val) {
                                return val + "%";
                            }
                        }
                    },
                };

                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            }


            //courses active
            function loadChart2(data) {
                console.log("chart2 ", data)
                var options = {
                    series: [{
                        name: 'inactive members',
                        data: data.data
                    }],
                    chart: {
                        height: 350,
                        type: 'bar',
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 10,
                            dataLabels: {
                                position: 'top', // top, center, bottom
                            },
                        }

                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function (val) {
                            return val;
                        },
                        offsetY: -20,
                        style: {
                            fontSize: '12px',
                            colors: ["#e74032"]
                        }
                    },

                    xaxis: {
                        categories: data.names,
                        position: 'bottom',
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        crosshairs: {
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    colorFrom: '#e74032',
                                    colorTo: '#e74032',
                                    stops: [0, 100],
                                    opacityFrom: 0.4,
                                    opacityTo: 0.5,
                                }
                            }
                        },
                        tooltip: {
                            enabled: true,
                        }
                    },
                    colors: ['#bb2d3b'],
                    yaxis: {
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false,
                        },
                        labels: {
                            show: false,
                            formatter: function (val) {
                                return val;
                            }
                        }

                    },

                };

                var chart = new ApexCharts(document.querySelector("#chart2"), options);
                chart.render();

            }

        </script>
</body>

</html>