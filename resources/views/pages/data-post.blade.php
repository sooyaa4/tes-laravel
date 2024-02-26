<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Post</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>

<body class="align-items-center py-4 bg-light">

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Post List</h1>
                <table class="table table-striped" id="postTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari endpoint API akan ditampilkan di sini -->
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body post-detail-container">
                <!-- Detail post akan ditampilkan di sini -->
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '{{ url('api/post/only/get') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    _token: CSRF_TOKEN
                },
                success: function(data) {
                    var tbody = $('#postTable tbody');
                    tbody.empty();

                    // Memasukkan data dari API ke dalam tabel
                    $.each(data.data.postLists, function(index, post) {
                        var row = $('<tr>');
                        row.append($('<td>').text(post.id));
                        row.append($('<td>').text(post.title));
                        row.append($('<td>').text(post.category));
                        row.append($('<td>').text(post.author.name));
                        var imageElement = $('<img>').attr('src', post.image).addClass(
                            'img-fluid').attr('alt', 'Post Image');
                        var imageColumn = $('<td>').append(imageElement);
                        row.append(imageColumn)
                        var detailButton = $('<button>').addClass('btn btn-primary view-detail btn-sm')
                            .attr('data-post', JSON.stringify(post));
                        var icon = $('<i>').addClass('fas fa-eye');
                        detailButton.append(icon);
                        var buttonColumn = $('<td>').append(detailButton);
                        row.append(buttonColumn);

                        tbody.append(row);
                    });

                    // Menampilkan detail post saat tombol diklik
                    $(document).on('click', '.view-detail', function() {
                        var post = $(this).data('post');
                        var detailHtml = '<h2>Post Detail</h2>';
                        detailHtml += '<p>ID: ' + post.id + '</p>';
                        detailHtml += '<p>Title: ' + post.title + '</p>';
                        detailHtml += '<p>Tags: ' + post.detail.tags + '</p>';
                        detailHtml += '<p>Description: ' + post.detail.desc + '</p>';
                        $('.post-detail-container').html(detailHtml);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
</body>

</html>
