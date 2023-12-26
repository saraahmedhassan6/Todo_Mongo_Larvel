<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/img/icon8.png" sizes="32x32">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>To Do List</title>

    <style>
        body {

            background-image: url('{{ asset('assets/img/bg2.JPG') }}');
        }

        section {
            min-height: 150px;
            max-height: 600px;
            min-width: 200px;
            max-width: 580px;
            overflow-y: auto;
            margin: 80px auto;
            margin-top: 40px;
            margin-bottom:0px; 
            background-color: white;
            border-radius: 50px;
        }

        .Summer {
            color: #b5838d;
            font-size: 60px;
            font-weight: bold;
            font-family: Georgia;
            text-align: center;
            margin-bottom: 8px;
            margin-top: 20px;
        }

        .Todo {
            color: #f08080;
            font-size: 25px;
            font-weight: bold;
            font-family: Courier;
            text-align: center;
            margin-bottom: 25px;
        }

        #form3 {
            width: 380px;
            height: 30px;
            margin-left: 40px;
            border: 0;
            border-bottom: 1px solid gray;
            border-radius: 10px;
        }

        .Add {
            width: 78px;
            height:40px;
            margin-left: 40px;
            margin-top: 15px;
            background-color: #f08080;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: 0;
            border-radius: 50px;

        }

        .Add:hover {

            background-color: #f2e9e4;
            color: black;
            cursor: pointer;

        }

        .spanList {
            color: #3a5a40;
            font-size: 20px;
            font-weight: bold;
            font-family: Comic Sans MS;
            margin-right: 10px;

        }

        .delete {
            background-color: white;
            border: 0;
            font-size: 20px;
            font-weight: bold;
            color: gray;
        }

        .delete:hover {

            color: black;
            cursor: pointer;
        }

        .edit {
            background-color: white;
            border: 0;
            font-size: 20px;
            font-weight: bold;
            color: gray;
        }

        .edit:hover {
            color: black;
            cursor: pointer;
        }



        .item-text.completed {
            text-decoration: line-through;
            color: gray;
        }
    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 30px;">
                        <div class="card-body p-5">


                            <p class="mb-3 Summer">Summer!</p>
                            <p class="mb-3 Todo">To do List</p>

                            <form class="d-flex justify-content-center align-items-center mb-4" method="post"
                                action="{{ route('AddList') }}">
                                @csrf
                                <div class="form-outline flex-fill">
                                    <input type="text" id="form3" name="Descr"
                                        class="form-control form-control-lg" required />
                                    <button type="submit" class="btn btn-primary btn-lg ms-2 Add">Add</button>
                                </div>

                            </form>

                            <ul type="none">
                                <table>
                                    @foreach ($items as $item)
                                        <tr style="height:50px;width:100%">
                                            <td style="width: 100%">
                                                <input class="form-check-input me-2 checkbox-item" type="checkbox"
                                                    value="" aria-label="..." />
                                                <span class="item-text spanList">{{ $item->Descr }}</span>
                                            </td>
                                            <td style="width:10px;text-align:right">
                                                <form action="{{ route('DeleteList', ['id' => $item->_id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm delete">X</button>
                                                </form>
                                            </td>

                                            <td>
                                              <a class="modal-effect btn btn-sm btn-info edit"
                                                data-effect="effect-scale" data-id="{{ $item->_id }}"
                                                data-descr_list="{{ $item->Descr }}" data-toggle="modal"
                                                href="#exampleModal2" title="Edit">
                                                <i class="fas fa-edit"></i>
                                              </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </ul>

                        </div>
                        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">List Edit</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('UpdateList') }}" method="post" autocomplete="off"
                                            enctype="multipart/form-data">
                                            {{ method_field('patch') }}
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="List">List</label>
                                                <input type="hidden" name="id" id="id" value="">
                                                <input type="text" class="form-control" id="descr_list"
                                                    name="descr_list"
                                                    style="border: 0;
                                                    border-bottom: 1px solid gray;
                                                    border-radius: 10px;">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" style="background-color: #f08080;color: white;border:0px;border-radius:30px ">Confirm</button>
                                                <button type="button" class="btn btn-secondary" style="border:0px;border-radius:30px"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>





    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var descr_list = button.data('descr_list')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #descr_list').val(descr_list);
        })
    </script>




    <script>
        $(document).ready(function() {
            $('.checkbox-item').on('change', function() {
                var listItem = $(this).closest('tr');
                var itemText = listItem.find('.item-text');

                if ($(this).prop('checked')) {
                    itemText.addClass('completed');
                } else {
                    itemText.removeClass('completed');
                }
            });
        });
    </script>





</body>

</html>
