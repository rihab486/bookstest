<style>
        .box {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            background-color: #fff;
        }
        .box-header {
            margin-bottom: 20px;
        }
    </style>

<div class="container-fluid py-5 mb-5">
    <div class="container">
        <div class="text-center mx-auto pb-5 wow fadeIn" style="max-width: 600px;">
            <h5 class="text-primary">Welcome on Your Account</h5>
            <h1><?php echo $_SESSION['firstname']; ?></h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Books List</h4>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>IdBook</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="books-list">
                                <!-- Content will be loaded here dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var userId = <?php echo json_encode($_SESSION['iduser']); ?>;

        function loadBooks() {
            $.ajax({
                url: "../server/index.php",
                method: 'GET',
                data: {
                    action: 'allBooks',
                    user_id: userId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.results && response.results.length > 0) {
                        let booksHtml = '';
                        response.results.forEach(book => {
                            booksHtml += `<tr>
                                            <td>${book.id}</td>
                                            <td>${book.name}</td>
                                            <td>${book.price}</td>
                                            <td><button data-id="${book.id}" class="btn btn-danger btn-sm delete-btn">Delete</button></td>
                                          </tr>`;
                        });
                        $('#books-list').html(booksHtml);

                        // Attach click event for delete buttons
                        $('.delete-btn').on('click', function() {
                            var bookId = $(this).data('id');
                            $.ajax({
                                url: "../server/index.php",
                                method: 'POST',
                                data: {
                                    action: 'deletebook',
                                    user_id:userId,
                                    book_id: bookId
                                },
                                success: function(response) {
                                    console.log('succes delete',response);
                                    if (response.success) {
                                        loadBooks(); // Reload the book list
                                    } else {
                                        alert('Failed to delete the book. Please try again.');
                                    }
                                },
                                error: function(error) {
                                    alert('An error occurred while deleting the book.');
                                    console.log('Error:', error);
                                }
                            });
                        });
                    } else {
                        $('#books-list').html('<tr><td colspan="4">No books found.</td></tr>');
                    }
                },
                error: function(error) {
                    $('#books-list').html('<tr><td colspan="4">An error occurred while fetching the books.</td></tr>');
                }
            });
        }

        // Initial load of books
        loadBooks();
    });
</script>


