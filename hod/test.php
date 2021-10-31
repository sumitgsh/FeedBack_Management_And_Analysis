<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset=UTF-8>
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin=anonymous>

    <script src=//code.jquery.com/jquery-3.3.1.slim.min.js
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin=anonymous>
    </script>
    <script src=//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin=anonymous>
    </script>

    <script src=//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin=anonymous>
    </script>

    <script src=//code.jquery.com/jquery-3.5.1.slim.js integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM="
        crossorigin=anonymous></script>

    <title>Document</title>
</head>

<body>
    <div>
        <div>
            <div></div>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Duration Hours</th>
                            <th>Exam Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <th scope="row">1 </th>
                            <td>Computer</td>
                            <td>255 Hours</td>
                            <td>25-04-2020 </td>
                            <td><a href="javascript:;" class="addAttr" data-toggle="modal" data-target="#addModal"
                                    data-id="1" data-name="Computer" data-duration="255" data-date="27-04-2020">
                                    Edit</a></td>
                        </tr>
                        <tr>
                            <th scope="row">2 </th>
                            <td>Data Science</td>
                            <td>300 Hours</td>
                            <td>27-04-2020 </td>
                            <td><a href="javascript:;" class="addAttr" data-toggle="modal" data-target="#addModal"
                                    data-id="2" data-name="Data Science" data-date="27-04-2020" data-duration="300">
                                    Edit</a></td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div></div>
        </div>
    </div>





    <script>
    $('.addAttr').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var duration = $(this).data('duration');
        var date = $(this).data('date');

        $('#id').val(id);
        $('#name').val(name);
        $('#duration').val(duration);
        $('#date').val(date);
    });
    </script>
    <div id="addModal" tabindex="-1" class="modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div role="document">
            <div>
                <div>
                    <h5 id="exampleModalLabel">Modal Title </h5>
                    <button type=button data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">

                    <div>

                        <div>
                            <label for="exampleInputEmail1">Course Id</label>
                            <input type=text id="id" name=id required>
                        </div>
                        <div>
                            <label for="exampleInputEmail1">Enter Course Name</label>
                            <input type=text id="name" name=name required>
                        </div>
                        <div>
                            <label for="exampleInputEmail1">Enter Course Duration <small> (In hours)</small> </label>
                            <input type=text id="duration" name=duration value="" required>
                        </div>
                        <div>
                            <label for="exampleInputEmail1">Date </label>
                            <input type=text id="date" name=date value="" required>
                        </div>
                    </div>
                    <div>
                        <button type=button data-dismiss="modal">Close</button>
                        <button type=submit>Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>